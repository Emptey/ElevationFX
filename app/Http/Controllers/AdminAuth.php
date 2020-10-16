<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Admin;

class AdminAuth extends Controller
{
    // gets admin login page
    public function getLogin () {
        return view('v1.admin.admin_auth.login');
    }

    // post admin login page
    public function postLogin (Request $request) {
        // validation
        $this->validate($request, [
            'email'     => 'email|required',
            'password'  => 'required|alpha-dash',
        ]);

        // authenticate admin
        if (\Auth::guard('admin')->attempt(['email'=> $request->email, 'password' => $request->password, 'isActive' => 1])) {
           return redirect()->route('admin-dashboard'); 
        } else {
            // record doesn't exist
            $notification = [
                'message' => 'Wrong email/password combination',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // logout admin
    public function getLogout () {
        \Auth::guard('admin')->logout();
        return redirect()->route('admin-login');
    }

}
