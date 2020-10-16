<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UserInvestment;
use App\UserInvestmentPayment;

class CheckUserInvestment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkuserinvestment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command checks if user investment has expired or user payment date has been reached';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // check if user investment has expired or user investment payment has been reached
        $current_date = Date('Y-m-d');

        // get user investments
        $user_investment_tbl = UserInvestment::where('isPaid', 1)->where('isActive', 1)->whereDate('date_count', $current_date)->get();

        // loop through found records
        foreach($user_investment_tbl as $user_investments) {
            // create new payout request
            $user_investment_payment = new UserInvestmentPayment();
            
            // add record
            $user_investment_payment->user_id               = $user_investments->user_id;
            $user_investment_payment->investment_id         = $user_investments->investment_id;
            $user_investment_payment->user_investment_id    = $user_investments->id;
            $user_investment_payment->payout_amount         = app('App\Http\Controllers\Helper')->calculateReturn($user_investments->amount, $user_investments->investment->percentage);
            $user_investment_payment->isActive              = 1;

            $save_payment_record = $user_investment_payment->save();

            // check if payment request record was saved
            if ($save_payment_record) {
                // payment request record saved - check if user investment has expired -  if not expired = increase date_count by 30 days
                if ($user_investments->date_count < $user_investments->end_date) {
                    // user scheduled for next payment round
                    $user_investments->update(['date_count' => app('App\Http\Controllers\Helper')->nextPaymentDate()]);
                    echo 'Date extended';
                } else if ($user_investments->date_count >= $user_investments->end_date) {
                    // user investment has expired//
                    $user_investments->update(['isActive' => 0]);
                }

            } else {
                // payment request record not saved
                echo 'Record not saved';
            }
        }

    }
}
