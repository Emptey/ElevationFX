<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investment;

class IndexPaymentController extends Controller
{
    // index user authentication for payment
    public function payInvestment ($id) {
        if (\Auth::check()) {

            // check if user has provided bank details
            if (!is_null(\Auth::user()->user_bank)) {
                // user provided bank detail
                return redirect()
                        ->route('index-investment-payment', $id);
            } else {
                // user haven't provided bank detail
                session()->put('url.intended', route('index-investment-payment', $id)); 
                return redirect()
                        ->route('get-user-settings');
            }
        } else {
            // setting intended url
            session()->put('url.intended', route('index-investment-payment', $id));

            return redirect()
                    ->route('get-user-login');
        }
        
    }

    // investment payment page
    public function payNow ($id) {
        $id = \Crypt::decrypt($id);

        // get investment record
        $investment_tbl = Investment::find($id);

        // check if investmet exist
        if ($investment_tbl->count() > 0) {
            // investment exist
            return view('v1.user.index_investment_payment', ['investment' => $investment_tbl]);
        } else {
            // investment doesn't exist
            $notification = [
                'message' => 'invaild investment provided',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // verify investment payment
     public function verifyInnvestmentPayment ($id) {

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

}
