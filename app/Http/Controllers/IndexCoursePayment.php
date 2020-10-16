<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\UserCourse;

class IndexCoursePayment extends Controller
{
    // verify if user is logged in
    public function verifyCourse ($id) {
        // check if user is logged in
        if (\Auth::check()) {
            // user is logged in - check if user has active course
            $user_course_tbl = UserCourse::where('user_id', \Auth::user()->id)
                                        ->where('isPaid', 1)
                                        ->where('isActive', 1)->get();

            // check if active course exist
            if ($user_course_tbl->count() > 0) {
                // user has an active course - redirect and notify user
                $notification = [
                    'message' => 'Sorry you need to finish your active course before you can enroll for another course.',
                    'alert-type' => 'warning',
                ];

                return redirect()
                        ->back()
                        ->with($notification);

            } else {
                // user doesn't have an active course
                return redirect()
                    ->route('purchase-course', $id);
            }
            
        } else {
            // user is not logged in redirect user to login page
            session()->put('url.intended', route('purchase-course', $id));

            // redirect user to login
            return redirect()
                    ->route('get-user-login');
        }
    }

    // course payment page
    public function purchaseCourse ($id) {
        // decryption
        $id = \Crypt::decrypt($id);

        // get course record
        $course_tbl = Course::find($id);

        // check if course exist
        if ($course_tbl->count() > 0) {
            // course exist - return view
            return view('v1.user.index_course_payment', ['course' => $course_tbl]);
        } else {
            // course doesn't exist
            $notification = [
                'message' => 'Invalid course provided.',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // upload user purchased course
    public function uploadUserCourse (Request $request) {
        // validation
        $this->validate($request, [
            'user_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'reference' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'isPaid' => 'required|numeric',
            'isActive' => 'required|numeric',
        ]);

        // store user new course
        $user_course_tbl = new UserCourse();

        // add records
        $user_course_tbl->user_id = $request->user_id;
        $user_course_tbl->course_id = $request->course_id;
        $user_course_tbl->payment_reference_key = $request->reference;
        $user_course_tbl->start_date = $request->start_date;
        $user_course_tbl->end_date = $request->end_date;
        $user_course_tbl->isPaid = $request->isPaid;
        $user_course_tbl->isActive = $request->isActive;

        // save record
        $save_user_course = $user_course_tbl->save();

        // check if course was saved
        if ($save_user_course) {
            return response()
                    ->json(['message' => 'success']);
        } else {
            return response()
                    ->json(['message' => 'Course registration failed, contact support']);
        }
    }

    // verify course purchase
    public function verifyCoursePurchase ($id) {
        // check if user course was uploaded
        $user_course_tbl = UserCourse::where('payment_reference_key', $id)->get();

        // check if course exist
        if ($user_course_tbl->count() > 0) {
            // user course added successfully
            $notification = [
                'message' => 'Congratulations, course purchased successfully.',
                'alert-type' => 'success',
            ];

            return redirect()
                    ->route('get-user-home')
                    ->with($notification);
        }
    }
}
