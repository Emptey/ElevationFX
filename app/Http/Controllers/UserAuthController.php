<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Mail;

use App\Investment;
use App\Course;
use App\User;

class UserAuthController extends Controller
{

    // user index page
    public function index () {
        // get all active investments
        $investment_tbl = Investment::where('isActive', 1)
                                        ->where('isComplete', 0)
                                        ->get();

        // get all active courses
        $course_tbl = Course::where('isActive', 1)
                                ->get();

        return view('v1.user.index', ['investment' => $investment_tbl, 'course' => $course_tbl]);
    }


    // gets login page
    public function getLogin () {
        return view('v1.user.user_auth.login');
    }

    // post login page request
    public function postLogin (Request $request) {
        // validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|alpha-dash',
        ]);

        // validate login credentials
        if (\Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isActive' => 1])) {
            // user authenticated - login - check if an intended url was supplied
            if (!empty(session()->get('url.intended'))) {
                return redirect()
                        ->intended(session()->get('url.intended'));
            } else {
                return redirect()
                ->route('get-user-dashboard');
            }
           
        } else {
            // login credential error
            $notification = [
                'message' => 'Wrong email/password combination',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
                    
        }
    }

    // recover password page
    public function recoverPassword () {
        return view('v1.user.user_auth.recover_password');
    }

    // post recover password request
    public function postRecoverPassword (Request $request) {
        // validation
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        // get user record
        $user_tbl = User::where('email', $request->email);

        // check if user exist
        if ($user_tbl->count() > 0) {
            // user exist - generate random number and save to db
            $rand = mt_rand(10, 99);

            // add generated token
            $new_remember_token  = [
                'remember_token' => $rand,
            ];

            // update user record
            $update_user_tbl = $user_tbl->update($new_remember_token);

            // check if update was successful
            if ($update_user_tbl) {
                // update successful (remember token saved) - send mail
                $details = [
                    'title' => 'Account verification',
                    'body' => 'A request to change your password was received by our system. If this was you, kindly click the button below to reset your password.',
                    'url' => route('recover-password-verify-token', \Crypt::encrypt($rand)),
                ];

                // send mail
                Mail::to($request->email)->send(new VerifyMail($details));

                // check if mail was sent
                if (!Mail::failures()) {
                    // mail sent - notify user
                    $notification = [
                        'message' => 'A mail has been sent to you, please check your mail.',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);

                } else {
                    // mail not sent
                    $notification = [
                        'message' => 'Request processing failed, try again later',
                        'alert-type' => 'error',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);
                }

            } else {
                // update failed, remember token not saved
                $notification = [
                    'message' => 'An error has occured, please try again later',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }
           
        } else {
            // user doesn't exist -  notify user
            $notification = [
                'message' => 'Account not found, check and try again.',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }

        
    }

    // verify recover password token
    public function recoverPasswordVerifyToken ($id) {
        // decryption
        $id = \Crypt::decrypt($id);

        // get record associated to token
        $user_tbl = User::where('remember_token', $id)->get();

        // check if token exist
        if ($user_tbl->count() > 0) {
            return view('v1.user.user_auth.reset_password', ['user' => $user_tbl]);
        } else {
            // token doesn't exit
            $notification = [
                'message' => 'Invalid request received, check and try again',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }

    }

    // reset user password
    public function resetPassword (Request $request) {
        // validation
        $this->validate($request, [
            'id' => 'required|numeric',
            'password' => 'required|alpha-dash|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        // get user record
        $user_tbl = User::where('id', $request->id);

        // check if user exist
        if ($user_tbl->count() > 0) {
            // user exist -  reset password
            $new_password = [
                'password' => \Hash::make($request->password),
                'remember_token' => null,
            ];

            // update user record
            $update_user_tbl = $user_tbl->update($new_password);

            // check if record was update
            if ($update_user_tbl) {
                // user record updated - notify user
                $notification = [
                    'message' => 'Password reset was successful, try logging in.',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('get-user-login')
                        ->with($notification);

            } else {
                // user record failed to update
                $notification = [
                    'message' => 'An error has occured, password not changed.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);

            }

        } else {
            // user doesn't exist
            $notification = [
                'message' => 'Invalid request received, try again later',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // get user register page
    public function getRegister () {
        return view('v1.user.user_auth.sign_up');
    }

    // post user register page 1
    public function postRegisterOne (Request $request) {
        // validation
        $this->validate($request, [
            'full_name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'dob' => 'required|date',
            'gender' => 'required|alpha',
        ]);

        // store credentials in session
        session()->put('full_name', $request->full_name); // store full name
        session()->put('dob', $request->dob);  // store date of birth
        session()->put('gender', $request->gender);  // store gender

        // redirect user to registration page - step 2
        return redirect()
                ->route('get-user-register-step-two');
    }

    // get user registration page 2
    public function getRegisterTwo () {
        // return view
        return view('v1.user.user_auth.sign_up_2');
    }

    // post user registration page two
    public function postRegisterTwo (Request $request) {
        // validation
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric',
            'password' => 'required|min:6|alpha_dash',
        ]);

        // store credentials in session
        session()->put('email', $request->email);  // store email
        session()->put('phone', $request->phone);  // store phone
        session()->put('password', $request->password);  // store password
        
        // redirect user to registration page - step 3
        return redirect()
                ->route('get-user-register-step-three');
    }

    // get user registration page three
    public function getRegisterThree () {
        // return view
        return view('v1.user.user_auth.sign_up_3');
    }

    // post user registration page 3
    public function postRegisterThree (Request $request) {
        // validation
        $this->validate($request, [
            'address' => 'required|regex:/^[a-zA-Z\s\0-9]*$/',
            'country' => 'required|alpha',
            'state' => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);

        // save all registration credential to database
        $user_tbl = new User();

        // step 1 registration credential
        $user_tbl->full_name = strtolower(session()->get('full_name'));
        $user_tbl->dob = session()->get('dob');
        $user_tbl->gender = strtolower(session()->get('gender'));

        // step 2 resgistration credential
        $user_tbl->email = strtolower(session()->get('email'));
        $user_tbl->phone = session()->get('phone');
        $user_tbl->password = \Hash::make(session()->get('password'));

        // step 3 registration credential
        $user_tbl->address = strtolower($request->address);
        $user_tbl->country = strtolower($request->country);
        $user_tbl->state   = strtolower($request->state);

        // save credentials
        $save_user_tbl = $user_tbl->save();

        // check if registration was successful
        if ($save_user_tbl) {
            // user registration successful - authenticate user and redirect to dashboard
            $email = session()->get('email');
            $password = session()->get('password');

            // delete session records
            session()->forget('full_name');            
            session()->forget('dob');
            session()->forget('gender');
            session()->forget('email');
            session()->forget('phone');
            session()->forget('password');

            // authenticate user and log user in
            if (\Auth::attempt(['email' => $email, 'password' => $password])) {
                // user authenticated - redirect to dashboard

                // delete session records
                $notification = [
                    'message' => 'Welcome to ElevationFX, feel free to go through our investment tiers at anytime.',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('get-user-dashboard')
                        ->with($notification);
            } else {
                // authentication failed
                $notification = [
                    'message' => 'Welcome to ElevationFX, feel free to sign in to access your dashboard.',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('get-user-login')
                        ->with($notification);
            }

        } else {
            // user registration failed
            $notification = [
                'message' => 'Registration failed, kindly try again.',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // get about us page
    public function getAbout () {
        return view('v1.user.about_us');
    }

     // logout user
     public function getLogout () {
        \Auth::logout();
        return redirect()->route('get-user-login');
    }

}
