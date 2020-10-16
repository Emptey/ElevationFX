<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investment;

class Helper extends Controller
{
    // generates random number
    public function randomNumber () {
        $token = mt_rand(1000, 9000);
         return $token;
    }

    // number validation

    // de-activate
    public function de_activate() {
        return [
            'isActive' => 0,
        ];
    }

    // activate
    public function activate () {
        return [
            'isActive' =>1,
        ];
    }

    // calculate user return
    public function calculateReturn ($amount, $percentage) {
    //    return investment return
    return  ($amount/100) * $percentage;
    }

    // next investment payout date
    public function nextPaymentDate () {
        $current_date = Date('Y-m-d', strtotime('+ 30days'));
        return $current_date;
    }

    // user investment return counter
    public function userInvestmentCounter ($count, $duration) {
        $calc = ($count * 100) / $duration;

        // check user return payment percentage
        switch ($calc) {
            case 0:
                return '0%';
                break;
                
            case 5:
                return '5%';
                break;
            
            case 10:
                return '10%';
                break;

            case 15:
                return '15%';
                break;
            
            case 20:
                return '20%';
                break;

            case 25:
                return '25%';
                break;

            case 30:
                return '30%';
                break;

            case 35:
                return '35%';
                break;

            case 40:
                return '40%';
                break;

            case 45:
                return '45%';
                break;
            
            case 50:
                return '50%';
                break;

            case 55:
                return '55%';
                break;
            
            case 60: 
                return '60%';
                break;

            case 65:
                return '65%';
                break;
            
            case 70:
                return '70%';
                break;

            case 75:
                return '75%';
                break;

            case 80:
                return '80%';
                break;
            
            case 85:
                return '85%';
                break;

            case 90:
                return '90%';
                break;

            case 95:
                return '95%';
                break;

            case 100:
                return '100%';
                break;

            default:
                return '...';
                break;
        }
    }   

    // user investment end date
    public function endDate ($duration) {
        $duration = $this->duration($duration).'days';
        $end_date = Date('Y-m-d', strtotime("+ $duration"));
        
        return $end_date;
    }

    // investment date calculator
    public function duration ($duration) {
        $a_month = 30;
        $duration = $duration * $a_month;
        return $duration;
    }

    // reduce investment slot by purchased slot
    public function slotDeduction ($investment_id, $slot) {
        // get investment record
        $investment_tbl = Investment::where('id', $investment_id);

        // check if investment exist
        if ($investment_tbl->count() > 0) {
            // check if investment has slots
            if (!is_null( $investment_tbl->pluck('slot')->first() )  || !is_null( $investment_tbl->pluck('available_slot')->first() )) {
                // investment have slots - deduct purchased slot from available slot
                $new_slot = [
                    'available_slot' => $investment_tbl->pluck('available_slot')->first() - $slot,
                ];

                // update investment record
                $update_investment_tbl = $investment_tbl->update($new_slot);

                // check if update was successful
                if ($update_investment_tbl) {
                    //  update successful - check if available slot is filled
                    if ($investment_tbl->pluck('available_slot')->first() == 0) {
                        // investment slot filled - update investment record
                        $de_activate_investment = [
                            'isComplete' => 1,
                            'isActive' => 0,
                        ];

                        // update investment
                        $update_investment_tbl = $investment_tbl->update($de_activate_investment);

                        // check if investment was updated
                        if ($update_investment_tbl) {
                            // investment updated successful - notify user
                            $notification = [
                                'message' => 'Congratulations you\'ve successfully invested with us at ElevationFX',
                                'alert-type' => 'success',
                            ];

                            return redirect()
                                    ->route('get-user-investment')
                                    ->with($notification);

                        } else {
                            // investment update failed - notify user
                            $notification = [
                                'message' => 'An error has occured, please contact support.',
                                'alert-type' => 'error',
                            ];

                            return redirect()
                                    ->back()
                                    ->with($notification);
                        }

                    } else {
                        // slot not filled -  notify user of successful investment
                         // update successful
                        $notification = [
                            'message' => 'Congratulations you\'ve successfully invested with us at ElevationFX',
                            'alert-type' => 'success',
                        ];

                        return redirect()
                                ->route('get-user-investment')
                                ->with($notification);
                    }
                    
                } else {    
                    // update failed
                    $notification = [
                        'message' => 'Update has just failed, contact support',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->route('get-user-investment')
                            ->with($notification);
                }

            } else {
                // investment do not have slots but payment was successful
                $notification = [
                    'message' => 'Congratulations you\'ve successfully invested with us at ElevationFX',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('get-user-investment')
                        ->with($notification);
            }
        } else {
            // investment doesn't exist
            $notification = [
                'message' => 'Invalid request provided',
                'alert-type' => 'error',
            ];

            return redicrect()
                    ->back()
                    ->with($notification);
        }
    }
}
