<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\UserCourse;

class CheckCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkcourse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if user course subscription has expired';

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
        $current_date = Date('Y-m-d');
        $validate_subscription = UserCourse::whereDate('end_date', $current_date)->where('isPaid', 1);

        // check if course end_date is current date
        if ($validate_subscription->count() > 0) {
            // course record found
            $de_activate_subscription = app('App\Http\Controllers\Helper')->de_activate();

            // update record
            $update_course_record = $validate_subscription->update($de_activate_subscription);

            // check if de_activation was successfull
            if ($update_course_record) {
                // de-activation was succesful
            } else {
                // de-activation failed
            }
        } else {
            // no record found
        }
    }
}
