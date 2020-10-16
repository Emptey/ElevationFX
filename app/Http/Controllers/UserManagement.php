<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserCourse;

class UserManagement extends Controller
{
    // get index page
    public function index () {
        // get users
        $user_tbl = User::orderBy('id', 'desc')->paginate(10);
        // return view
        return view('v1.admin.dashboard.user.index', ['user' => $user_tbl]);
    }

    // search user
    public function searchUser (Request $request) {
        // validation
        $this->validate($request, [
            'search' => 'required|email',
        ]);

        // get user record
        $user_tbl = User::where('email', 'LIKE', '%'.$request->search.'%')->paginate(10);

        // check if user exist
        if ($user_tbl->count() > 0) {

            // user exist - return record
            return view('v1.admin.dashboard.user.index', ['user' => $user_tbl]);

        } else {

            // user doesn't exist - flag error
            $notification = [
                'message' => 'User record not found.',
                'alert-type' => 'warning',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // modify user status
    public function userStatus ($id) {
         // decrypting id
         $id = \Crypt::decrypt($id);

        // validation

        // get user record
        $user_tbl = User::where('id', $id);

        // check if user exist
        if ($user_tbl->count() > 0) {
            
            // user exist - check if user isActive = true/false
            if ($user_tbl->pluck('isActive')->first() === 1) {
                
                // user is Active -  De-activate user
                $update_user = $user_tbl->update(app('App\Http\Controllers\Helper')->de_activate());

                // check if user record was updated
                if ($update_user) {
                    // user record was updated - return record
                    $notification = [
                        'message' => 'User de-activated successfully',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);
                } else {
                    // user record not updated - flag error
                    $notification = [
                        'message' => 'User de-activation failed, try again',
                        'alert-type' => 'error',
                    ];
                }

            } else {
                
                // user is De-activated - activate user
                $update_user = $user_tbl->update(app('App\Http\Controllers\Helper')->activate());

                // check if user record was updated
                if ($user_tbl) {
                    // user record updated -  return record
                    $notification = [
                        'message' => 'User activated successfully',
                        'alert-type' => 'success',
                    ];

                return redirect()
                        ->back()
                        ->with($notification);
                }
            }

        } else {
            // user doesn't exist -  flag
            $notification = [
                'message' => 'User not found.',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // view user info
    public function userRecord ($id) {
        // decrypt id
        $id = \Crypt::decrypt($id);

        // id validation

        // get user record
        $user_tbl = User::find($id);

        // get active user course
        $user_course_tbl = UserCourse::where('isActive', 1)->get();

        // get all user courses
        $user_courses = UserCourse::orderBy('id', 'desc')->get();


        // check if user exist
        if ($user_tbl->count() > 0) {
            // user record found - process request
            return view('v1.admin.dashboard.user.view_user', ['user' => $user_tbl, 'user_course' => $user_course_tbl, 'user_courses' => $user_courses]);
        } else {
            // user record not found -  flag
            $notification = [
                'message' => 'User not found.',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }

    }
}
