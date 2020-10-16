<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserCourse;
use App\UserResource;
use App\Course;

class UserResourceController extends Controller
{
    // index page
    public function index () {
        $user_course = UserCourse::where('user_id', \Auth::user()->id)->where('isPaid', 1)->where('isActive', 1)->get();

        $user_resource = UserResource::where('course_id', $user_course->pluck('course_id')->last())->get();

        return view('v1.user.dashboard.resource.index', ['user_resource' => $user_resource]);
    }

    // search resource
    public function search (Request $request) {
        // validation
        $this->validate($request, [
            'search' => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);

        // get user active course
        $user_course = UserCourse::where('user_id', \Auth::user()->id)->where('isPaid', 1)->where('isActive', 1)->get();

        // get resource
        $user_resource = UserResource::where('title', 'LIKE', '%'.$request->search.'%')->where('course_id', $user_course->pluck('course_id')->last())->get();

        // check if material exist for user
        if ($user_resource->count() > 0) {
            // resource is available for user
            return view('v1.user.dashboard.resource.index', ['user_resource' => $user_resource]);
        } else {
            // resource not available for user
            $notification = [
                'message' => 'It seems the resource isn\'t available.',
                'alert-type' => 'warning',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }

    }
}
