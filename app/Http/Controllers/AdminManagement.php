<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminManagement extends Controller
{
    // index page
    public function index () {
        $admin_tbl = Admin::all();
        return view('v1.admin.dashboard.admin.index', ['admin' => $admin_tbl]);
    }

    // search admin
    public function searchAdmin (Request $request) {
        // validation
        $this->validate($request, [
            'search' => 'required|email',
        ]);

        // find admin record
        $admin_tbl = Admin::where('email', 'LIKE', '%'.$request->search.'%')->get();

        // check if admin record exist
        if ($admin_tbl->count() > 0) {
            // admin record found - return record
            return view('v1.admin.dashboard.admin.index', ['admin' => $admin_tbl]);
        } else {
            // admin record not found - notify user
            $notification = [
                'message' => 'Administrator record not found.',
                'alert-type' => 'warning',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // function get add admin page
    public function addAdmin () {
        return view('v1.admin.dashboard.admin.add_admin');
    }

    // add admin
    public function store (Request $request) {
        // validation
        $this->validate($request, [
            'full_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);

        // create new admin
        $admin_tbl = new Admin();

        // add admin info
        $admin_tbl->full_name = strtolower($request->full_name);
        $admin_tbl->email = strtolower($request->email);
        $admin_tbl->password = \Hash::make($request->password);

        // save admin record
        $save_admin = $admin_tbl->save();

        // check if admin record was saved
        if ($save_admin) {
            // admin record saved successfully
            $notification = [
                'message' => 'Administrator information saved successfully.',
                'alert-type' => 'success',
            ];

            return redirect()
                    ->route('get-admin')
                    ->with($notification);

        } else {
            // admin record not saved
            $notification = [
                'message' => 'Administrator information not saved, try again.',
                'alert-type' => 'warning',
            ];

            return redirect()
                    ->back()
                    ->with($notification);

        }
    }
}
