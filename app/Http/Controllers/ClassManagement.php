<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserClass;
use App\Course;

class ClassManagement extends Controller
{
    // index  page
    public function index () {
        // get all classes
        $class_tbl = UserClass::all();
        return view('v1.admin.dashboard.class.index', ['class' => $class_tbl]);
    }

    // search class
    public function searchClass (Request $request) {
        // validation
        $this->validate($request, [
            'search' => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);

        // find class record
        $class_tbl = UserClass::where('title', 'LIKE', '%'.strtolower($request->search).'%')->get();

        // check if class exist
        if ($class_tbl->count() > 0) {
            // return class record
            return view('v1.admin.dashboard.class.index', ['class' => $class_tbl]);
        } else {
            // class doesn't exist
            $notification = [
                'message' => 'Class not found.',
                'alert-type' => 'warning',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // add class
    public function addClass () {
        // get courses
        $course_tbl = Course::all();

        return view('v1.admin.dashboard.class.add_class', ['course' => $course_tbl]);
    }

    // post add class
    public function postAddClass (Request $request) {
        // validation
        $this->validate($request, [
            'course' => 'required|numeric',
            'title' => 'required|regex:/^[a-zA-Z\s]*$/',
            'date'  => 'required|date',
            'link' => 'required|url',
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
            'description' => 'required',
        ]);

        // create new class
        $class_tbl = new UserClass();
        $class_tbl->course_id = $request->course;
        $class_tbl->title = strtolower($request->title);
        $class_tbl->thumbnail = $request->thumbnail->hashName();
        $class_tbl->date = $request->date;
        $class_tbl->description = $request->description;
        $class_tbl->link = $request->link;

        // upload thumbnail
        $thumbnail_path = $request->file('thumbnail')->store('public/avatars');

        // check if thumbnail was uploaded successfully
        if (!is_null($thumbnail_path)) {
            // thumbnail uploaded - save class
            $save_class = $class_tbl->save();

            // check if class was saved
            if ($save_class) {
                // class saved -notify user
                $notification = [
                    'message' => 'Class uploaded successfully.',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('user-class')
                        ->with($notification);

            } else {
                // class not saved - notify user
                $notification = [
                    'message' => 'Class not saved, try again.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with();
            }
        } else {
            // thumbnail upload failed - notify user
            $notification = [
                'message' => 'Thumbnail upload failed, try again.',
                'alert-type' => 'warning',
            ];

            return redirect()
                    ->back()
                    ->with($notification);

        }
    }
}
