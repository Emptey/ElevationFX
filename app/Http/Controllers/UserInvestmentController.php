<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserInvestment;
use App\UserInvestmentPayment;
use App\Investment;

class UserInvestmentController extends Controller
{
    // index page
    public function index () {
        $user_investment_tbl = UserInvestment::where('user_id', \Auth::user()->id)
                                                ->whereDate('end_date', '>', Date('Y-m-d'))
                                                ->where('isActive', 1)
                                                ->where('isPaid', 1)
                                                ->orderBy('id', 'desc')
                                                ->get();

        $user_investment_payment_tbl = UserInvestmentPayment::where('user_investment_id', $user_investment_tbl->pluck('id')->first())->get();


        $investment_tbl = Investment::where('isActive', 1)
                                        ->where('isComplete', 0)
                                        ->where('id', '!=', $user_investment_tbl->pluck('investment_id')->first())
                                        ->get();

        $count = $user_investment_payment_tbl->count();


        return view('v1.user.dashboard.investment.index', ['user_investment' => $user_investment_tbl, 'other_investment' => $investment_tbl, 'payment_count' => $count]);
    }

    // investment payment page
    public function investmentPay ($id) {
        // decryption
        $id = \Crypt::decrypt($id);

        // validation
        if (preg_match('/[0-9]/', $id, $match)) {
            
            // check if user has provided bank details
            if (!is_null(\Auth::user()->user_bank)) {
                $investment_tbl = Investment::where('id', $id)->get();
                return view('v1.user.dashboard.investment.invest', ['investment' => $investment_tbl]);
            } else {
                // bank details not provided
                $notification = [
                    'message' => 'Kindly provide your bank details in settings first.',
                    'alert-type' => 'info',
                ];
                return redirect()
                        ->back()
                        ->with($notification);
            }

        } else {
            return redirect()
                    ->back();

        }
    }

    // verify investment payment
    public function verifyPayment ($id) {

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_4a8287a6e1cf5731b4deeb6b8cb2c265651c4683",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

    }

    // create a new user investment
    public function createUserInvestment (Request $request) {
        // validation
        $this->validate($request, [
            'id' => 'required|numeric',
            'investment_id' => 'required|numeric',
            'reference' => 'required',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // create new user investment
        $user_investment_tbl = new UserInvestment();

        // add record to db
        $user_investment_tbl->user_id = $request->id;
        $user_investment_tbl->investment_id = $request->investment_id;
        $user_investment_tbl->payment_reference_key = $request->reference;
        $user_investment_tbl->amount = $request->amount;
        $user_investment_tbl->slot = $request->slot;
        $user_investment_tbl->start_date = $request->start_date;
        $user_investment_tbl->date_count = $request->start_date;
        $user_investment_tbl->end_date = $request->end_date;
        $user_investment_tbl->isPaid = $request->isPaid;
        $user_investment_tbl->isActive = $request->isActive;

        // save user investment record
        $save_user_investment = $user_investment_tbl->save();

        // check if user investment is saved
        if ($save_user_investment) {
            return response()->json(['flag' => 1]);
        } else {
            return response()->json(['flag' => 0]);
        }
    }

    // verifies if user investment was successful
    public function verifyUserInvestment ($id) {
        // validatte payment reference
        if (is_numeric($id)) {
            // get stored record of investment
            $user_investment_tbl = UserInvestment::where('payment_reference_key', $id)->get();

            // check if record exist
            if ($user_investment_tbl->count() > 0) {
                // investment payment and record successful - check if investment has slot
                if ($user_investment_tbl->pluck('slot')->first() != Null) {
                    // get investment record
                    $investment_tbl = Investment::where('id', $user_investment_tbl->pluck('investment_id')->first());

                    // reduce investment available slot by purchased slot
                    $new_slot = $investment_tbl->pluck('available_slot')->first() - $user_investment_tbl->pluck('slot')->first();

                    // update investment record
                    $update_investment = $investment_tbl->update(['available_slot' => $new_slot]);

                    // check if update was successful
                    if ($update_investment) {
                        // update successful - check if investment available slot is filled
                        if ($investment_tbl->pluck('available_slot')->first() == 0) {
                            // slots filled - de-activate investment
                            $de_activate_investment = [
                                'isActive' => 0,
                                'isComplete' => 1,
                            ];

                            // update investment record
                            $update_investment = $investment_tbl->update($de_activate_investment);

                            // check if investment was successful
                            if ($update_investment) {
                                // update successful -  notify user of successful investment
                                $notification = [
                                    'message' => 'Congratulations you\'ve successfully invested with us at ElevationFX',
                                    'alert-type' => 'success',
                                ];
                
                                return redirect()
                                        ->route('get-user-investment')
                                        ->with($notification);
                            } else {
                                // update failed - notify user of error
                                $notification = [
                                    'message' => 'An error has occured during the transaction. Contact support',
                                    'alert-type' => 'error',
                                ];

                                return redirect()
                                        ->back()
                                        ->with($notification);
                            }

                        } else {
                            // investment slot not filled - notify user of a successful investment
                        }
                       
                    } else {
                        // update failed - notify user of error
                        $notification = [
                            'message' => 'An error has occured, please contact support',
                            'alert-type' => 'error',
                        ];

                        return redirect()
                                ->back()
                                ->with($notification);
                    }

                } else {
                    // investment doesn't have slot - notify user of a successful investment
                    $notification = [
                        'message' => 'Congratulations you\'ve successfully invested with us at ElevationFX',
                        'alert-type' => 'success',
                    ];
    
                    return redirect()
                            ->route('get-user-investment')
                            ->with($notification);
                }
                
            }
        } else {
            $notification = [
                'message' => 'Investment failed, please try again later',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->route('get-user-investment')
                    ->with($notification);
        }
    }
}
