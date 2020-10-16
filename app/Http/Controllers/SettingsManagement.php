<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class SettingsManagement extends Controller
{
    // index page
    public function index () {
        return view('v1.admin.dashboard.settings.index');
    }

    // change password
    public function changePassword (Request $request) {
        // validation
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        // check if passwords match
        if (\Hash::check($request->current_password, \Auth::guard('admin')->user()->password)) {
            // password match -  change password 
            $admin_tbl = Admin::where('id', \Auth::guard('admin')->user()->id);

            // check if admin record was found
            if ($admin_tbl->count() > 0) {
                // admin record found -change password
                $new_Admin_password = [
                    'password' => \Hash::make($request->password),
                ];

                // updtae password
                $update_admin = $admin_tbl->update($new_Admin_password);

                // check if record was updated
                if ($update_admin) {
                    // password updated successfully
                    $notification = [
                        'message' => 'Password changed successfully',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);

                } else {
                    // password update failed - notify user
                    $notification = [
                        'message' => 'Password update failed, try again',
                        'alert-type' => 'warning',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);

                }
            } else {
                // admin record not found - notify user
                $notification = [
                    'message' => 'An error has occured, try again',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);

            }
            
        } else {
            // password do not match - notify user
            $notification = [
                'message' => 'Invalid password password supplied',
                'alert-type' => 'warning',
            ];

            return redirect()
                    ->back()
                    ->with($notification);

        }
    }
}
