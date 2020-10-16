<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserBank;

class UserProfileController extends Controller
{
    // index page
    public function index () {
        return view('v1.user.dashboard.profile.index');
    }

    // edit page
    public function edit () {
        return view('v1.user.dashboard.profile.edit');
    }

    // post edit page
    public function postEdit (Request $request) {
        // validation
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|regex:/^[a-zA-Z\s\0-9]*$/',
            'dob' => 'required|date',
        ]);

        // get user record
        $user_tbl = User::where('id', \Auth::user()->id);

        // check if user exist
        if ($user_tbl->count() > 0) {
            // user exist
            $new_info = [
                'full_name' => strtolower($request->name),
                'email' => strtolower($request->email),
                'phone' => $request->phone,
                'address' => strtolower($request->address),
                'dob' => $request->dob,
            ];

            // update user record
            $update_user_tbl = $user_tbl->update($new_info);

            // check if update was successsful
            if ($update_user_tbl) {
                // update successful
                $notification = [
                    'message' => 'Your profile has been updated successfully.',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('get-user-profile')
                        ->with($notification);

            } else {
                // update failed
                $notification = [
                    'message' => 'Profile not updated, try again.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);

            }

        } else {
            // user doesn't exit
            return redirect()
                    ->route('get-user-logout');
        }
    }

    // settings page
    public function settings () {
        return view('v1.user.dashboard.profile.settings');
    }

    // change password
    public function postChangePassword (Request $request) {
        // validation
        $this->validate($request, [
            'password' => 'required|alpha-dash',
            'new_password' => 'required|alpha-dash|min:6',
        ]);

        // get user record
        $user_tbl = User::where('id', \Auth::user()->id);

        // check if user exist
        if ($user_tbl->count() > 0) {
            // user exist - check db password match
            if (\Hash::check($request->password, $user_tbl->pluck('password')->first())) {
                // password match - store new password
                $new_password = [
                    'password' => \Hash::make($request->new_password),
                ];

                // update user record
                $update_user_tbl = $user_tbl->update($new_password);

                // check if user was successful
                if ($update_user_tbl) {
                    // update successful
                    $notification = [
                        'message' => 'Password changed successfully',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->route('get-user-profile')
                            ->with($notification);
                } else {
                    // update failed
                    $notification = [
                        'message' => 'An error has occured, try again.',
                        'alert-type' => 'error',
                    ];

                    return redirect()
                            ->back()
                            ->with('get-user-profile');
                }
            } else {
                // password don't match
                $notification = [
                    'message' => 'Current password incorrect, try again.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }
            
        } else {
            // user doesn't exist
            return redirect()
                    ->route('get-user-logout');
        }
    }

    // change bank details
    public function postChangeBank (Request $request) {
        // validation
        $this->validate($request, [
            'bank' => 'required|regex:/^[a-zA-Z\s\,]*$/',
            'account_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'account_number' => 'required|numeric|min:10',
        ]);

        // get user bank details
        $user_bank_tbl =  UserBank::where('user_id', \Auth::user()->id);

        // check if user exist
        if ($user_bank_tbl->count() > 0) {
            // user exist - change bank details
            $new_bank_details = [
                'bank_name' => strtolower($request->bank),
                'account_name' => strtolower($request->account_name),
                'account_number' => $request->account_number,
            ];

            // update user bank record
            $update_user_bank_tbl = $user_bank_tbl->update($new_bank_details);

            // check if update was successful
            if ($update_user_bank_tbl) {
                // update successful
                $notification = [
                    'message' => 'Bank details changed successfully.',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('get-user-profile')
                        ->with($notification);

            } else {
                // update failed
                $notification = [
                    'message' => 'An error has occured, try again.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }
        } else {
            // user doesn't have bank account - save bank details
            $user_bank_tbl = new UserBank();

            // add records
            $user_bank_tbl->user_id = \Auth::user()->id;
            $user_bank_tbl->bank_name = strtolower($request->bank_name);
            $user_bank_tbl->account_name = strtolower($request->account_name);
            $user_bank_tbl->account_number = $request->account_number;

            // save bank information
            $save_user_bank = $user_bank_tbl->save();

            // check if bank details was saved
            if ($save_user_bank) {
                // bank details saved -  check if there is an intended link
                if (!empty(session()->get('url.intended'))) {
                    return redirect()
                            ->intended(session()->get('url.intended'));
                } else {
                    // no intended link - redirect user to profile page
                    $notification = [
                        'message' => 'Bank details saved successfully.',
                        'alert-type' => 'success',
                    ];
    
                    return redirect()
                            ->route('get-user-profile')
                            ->with($notification);
                }

            } else {
                // bak details not saved
                $notification = [
                    'message' => 'An error has occured, please try again',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }

        }

    
    }
}
