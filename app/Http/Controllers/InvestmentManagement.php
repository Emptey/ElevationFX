<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investment;
use App\UserInvestmentPayment;

class InvestmentManagement extends Controller
{
    // index page
    public function index () {
        // get all investment record
        $investment_tbl = Investment::all();
        return view('v1.admin.dashboard.investment.index', ['investment' => $investment_tbl]);
    }

    // de-activate / activate investment
    public function modifyStatus ($id) {
        // decrypt id
        $id = \Crypt::decrypt($id);

        // fetch record
        $investment_tbl = Investment::where('id', $id);

        // check if investment exist
        if ($investment_tbl->count() > 0) {
            // investment exist - check if investment is Active
            if ($investment_tbl->pluck('isActive')->first() === 1) {
                // investment is Active - De-activate Investment
                $update_investment = $investment_tbl->update(app('App\Http\Controllers\Helper')->de_activate());

                // check if investment updated
                if ($update_investment) {
                    // update successful
                    $notification = [
                        'message' => 'Investment de-activated successfully',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);

                } else {
                    // update failed
                    $notification = [
                        'message' => 'Update failed, try again',
                        'alert-type' => 'error',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);
                }
            } else {
                // investment is De-activated - Activate Investment
                $update_investment = $investment_tbl->update(app('App\Http\Controllers\Helper')->activate());

                // check if update was successful
                if ($update_investment) {
                    // investment updated successful
                    $notification = [
                        'message' => 'Investment activated successfuly',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);
                } else {
                    // investment update failed
                    $notification = [
                        'Update failed, try again',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);
                }
            }

        } else {
            // investment doesn't exit - notify user
            $notification = [
                'message' => 'Investment doesn\'t exist',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // add investment
    public function addInvestment () {
        return view('v1.admin.dashboard.investment.add');
    }

    // post add investment
    public function postAddInvestment (Request $request) {
        // validation
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'description' => 'required|regex:/^[a-zA-Z\s]*$/',
            'price' => 'required|numeric',
            'percentage' => 'required|numeric',
            'duration' => 'required|numeric',
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
        ]);

        // create new investment
        $investment_tbl = new Investment();

        // add reocrds
        $investment_tbl->name  = strtolower($request->name);
        $investment_tbl->thumbnail = $request->thumbnail->hashName();
        $investment_tbl->price = $request->price;
        (!empty($request->slot) ? $investment_tbl->slot  = $request->slot : '');
        (!empty($request->slot) ? $investment_tbl->available_slot  = $request->slot : '');
        $investment_tbl->percentage = $request->percentage;
        $investment_tbl->duration = $request->duration;
        $investment_tbl->description = $request->description;

        // store image
        $storage_path = $request->file('thumbnail')->store('public/avatars');

        // check if thumbnail was uploaded
        if (!is_null($storage_path)) {
            // thumbnail uploaded - save investment
            $save_investment = $investment_tbl->save();

            // check if investment was saved
            if ($save_investment) {
                // investment saved
                $notification = [
                    'message' => 'Investment saved successfully',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('user-investment')
                        ->with($notification);
            } else {
                // investment not saved
                $notification = [
                    'message' => 'Investment not saved, try again',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }

        } else {
            // thumbnail upload failed
            $notification = [
                'message' => 'Thumbnail failed to upload, try again.',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);

        }

    }

    // edit investment
    public function editInvestment ($id) {
        // decrypt id
        $id = \Crypt::decrypt($id);

        // find investment record
        $investment_tbl = Investment::find($id);

        // check if investmen exist
        if ($investment_tbl->count() > 0) {
            // investment exist
            return view('v1.admin.dashboard.investment.edit', ['investment' => $investment_tbl]);
        } else {
            // investment doesn't exist
            $notification = [
                'message' => 'Investment doesn\'t exist',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // post edit investment
    public function postEditInvestment (Request $request) {
        // validation
        $this->validate($request, [
            'id' => 'required|numeric',
            'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'price' => 'required|numeric',
            'percentage' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);

        // find investment
        $investment_tbl = Investment::where('id', $request->id);

        // check if investment exist
        if ($investment_tbl->count() > 0) {
            // investment exist - edit record
            $new_record = [
                'name' => strtolower($request->name),
                'price' => $request->price,
                'slot' => (!empty($request->slot) ? $request->slot : Null ),
                'available_slot' => (!empty($request->slot) ? $request->slot : Null ),
                'percentage' => $request->percentage,
                'duration' => $request->duration,
            ];

            // update investment
            $update_investment = $investment_tbl->update($new_record);

            // check if update was successful
            if ($update_investment) {
                // investment updated
                $notification = [
                    'message' => 'Investment updated successfully',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('user-investment')
                        ->with($notification);

            } else {
                // investment faield
                $notification = [
                    'message' => 'Investment update failed, try again.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }

        } else {
            // investment doesn't exist
            $notification = [
                'message' => 'Investment doesn\'t exit',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
        
    }

    // view full investment record
    public function viewInvestment ($id) {
        // decrypt id
        $id = \Crypt::decrypt($id);

        // find investment
        $investment_tbl = Investment::find($id);

        // check if investment exist
        if ($investment_tbl->count() > 0) {
            // investment found
            return view('v1.admin.dashboard.investment.view', ['investment' => $investment_tbl]);
        } else {
            // investment not found - notify user
            $notification = [
                'message' => 'Investment not found.',
                'error' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // pay all investors
    public function payAll (Request $request) {
        // validation
        $this->validate($request, [
            'id' => 'numeric|required',
        ]);

        // get investment
        $investment_payment = UserInvestmentPayment::where('investment_id', $request->id)->where('isPaid', 0)->where('isActive', 1);

        // check if investment exist
        if ($investment_payment->count() > 0) {
            // investment exist - set investment as paid
            $update_investment_payment = $investment_payment->update(
                [
                    'isPaid' => 1,
                ]
            );
            
            // check if user investment is paid
            if ($update_investment_payment) {
                // investment updated
                $notification = [
                    'message' => 'User investment payment successful',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('user-investment')
                        ->with($notification);

            } else {
                // update failed
                $notification = [
                    'message' => 'User investment payment failed.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);

            }

        } else {
            // investment doesnt exist
            $notification = [
                'message' => 'Investment doesn\'t exist',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }

    }

    // pay individual user
    public function payUser ($id) {
        // decryption
        $id = \Crypt::decrypt($id);

        // find investment
        $investment_payment = UserInvestmentPayment::where('id', $id);

        // check if investment payment exist
        if ($investment_payment->count() > 0) {
            // investment payment exist
            $update_investment_payment = $investment_payment->update([
                'isPaid' => 1,
            ]);

            // check if update was successful
            if ($update_investment_payment) {
                // update successful
                $notification = [
                    'message' => 'User investment payment successful',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            } else {
                // update failed
                $notification = [
                    'message' => 'User investment payment failed.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }

        } else {
            // else investment doesn't exist
        }
    }
}
