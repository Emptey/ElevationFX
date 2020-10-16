<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Course;

class CourseManagement extends Controller
{
    // index page
    public function index () {
        // get all courses
        $course_tbl = Course::all();
        return view('v1.admin.dashboard.course.index', ['courses' => $course_tbl]);
    }

    // course status 
    public function courseStatus ($id) {
        // decrypt id
        $id = \Crypt::decrypt($id);

        // validation

        // get course record
        $course_tbl = Course::where('id', $id);

        // check if course exist
        if ($course_tbl->count() > 0 ) {
            // course exist - check if course is activated
            
            if ($course_tbl->pluck('isActive')->first() === 1) {
                // course is actuive -  de-activate course
                $update_course = $course_tbl->update(app('App\Http\Controllers\Helper')->de_activate());

                // check if course was de-activated
                if ($update_course) {
                // course de-activated successfully
                $notification = [
                    'message' => 'Course de-activated successfully',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->back()
                        ->with($notification);

                } else {
                    // course de-activation failed - flag error
                    $notification = [
                        'message'=> 'Course de-activation failed, try again',
                        'alert-type' => 'warning',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);

                }
            } else {
                // course is de-activated - activate course
                $update_course = $course_tbl->update(app('App\Http\Controllers\Helper')->activate());

                // check if course activation wa successful
                if ($update_course) {
                    // course activation successful
                    $notification = [
                        'message' => 'Course activated successfully',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);

                } else {
                    // course activation failed -flag error
                    $notification = [
                        'message' => 'Course activation failed, try again',
                        'alert-type' => 'warning',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);
                }
            }

        } else {
            // course doesn't exist - flag
            $notification = [
                'message' => 'Course not found, try again',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // search course
    public function searchCourse (Request $request) {
        // validation
        $this->validate($request, [
            'search' => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);

        // find course
        $course_tbl = Course::where('title', 'LIKE', '%'.strtolower($request->search).'%')->get();

        // check if course was found
        if ($course_tbl->count() > 0) {
            // course was found
            return view('v1.admin.dashboard.course.index', ['courses' => $course_tbl]);
        } else {
            // course doesn't exit
            $notification = [
                'message' => 'Course not found.',
                'alert-type' => 'warning',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // get add course page
    public function addCourse () {
        return view('v1.admin.dashboard.course.add_course');
    }

    // post add course credentials
    public function postAddCourse (Request $request) {
        // validation
        $this->validate($request, [
            'title' => 'required|regex:/^[a-zA-Z\s]*$/',
            'cost' => 'required|numeric',
            'duration' => 'required|numeric',
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
            'description' => 'required',
        ]);

        // return true;
        // add course
        $course_tbl = new Course();
        $course_tbl->title = strtolower($request->title);
        $course_tbl->thumbnail = $request->thumbnail->hashName();
        $course_tbl->description = $request->description;
        $course_tbl->cost = $request->cost;
        $course_tbl->duration = $request->duration;
        $course_tbl->isActive = 1;

        // save image
        $storage_path = $request->file('thumbnail')->store('public/avatars');

        // check if thumbnail was uploaded
        if (!is_null($storage_path)) {
            // thumbnail uploaded
            $save_course = $course_tbl->save();

            // check if course was saved
            if ($save_course) {
                // course saved
                $notification = [
                    'message' => 'Course uploaded successfully',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('user-course')
                        ->with($notification);
                        
            } else {
                // course not saved
                $notification = [
                    'message' => 'Course upload failed, try again',
                    'alert-type' => 'warning',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }

        } else {
            // file upload failed
            $notification = [
                'message' => 'Thumbnail upload faild, try again',
                'alert-type' => 'warning',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }

    }

    // edit course
    public function editCourse ($id) {
        // decrypt id
        $id = \Crypt::decrypt($id);

        // find course record
        $course_tbl = Course::find($id);

        return view('v1.admin.dashboard.course.edit_course', ['course' => $course_tbl]);
    }

    // post edit course
    public function postEditCourse (Request $request) {
        // validation
        $this->validate($request, [
            'id' => 'required|numeric',
            'title' => 'required|regex:/^[a-zA-Z\s]*$/',
            'cost' => 'required|numeric',
            'duration' => 'required|numeric',
            'thumbnail' => 'required|mimes:png,jpeg,jpg',
            'description' => 'required',
        ]);

        // find course
        $course_tbl = Course::where('id', $request->id);

        // check if course exist
        if ($course_tbl->count() > 0) {
            // course exist - update record
            $new_course_record = [
                'title' => strtolower($request->title),
                'thumbnail' => $request->thumbnail->hashName(),
                'description' => $request->description,
                'cost' => $request->cost,
                'duration' => $request->duration,
            ];

            // update course
            $update_course = $course_tbl->update($new_course_record);

            $thumbnail_path = $request->file('thumbnail')->store('public/avatars');

                // check if thumbnail was uploaded
                if (!is_null($thumbnail_path)) {
                    // thumbnail uploaded successfully
                    // check if course was updated
                if ($update_course) {
                    // course updated - notify user
                    $notification = [
                        'message' => 'Course updated successfully',
                        'alert-type' => 'success',
                    ];

                    return redirect()
                            ->route('user-course')
                            ->with($notification);

                } else {
                    // course update failed - notify user
                    $notification = [
                        'message' => 'Course update failed, try again',
                        'alert-type' => 'error',
                    ];

                    return redirect()
                            ->back()
                            ->with($notification);

                }
                
            } else {
                // thumbnail upload failed
                $notification = [
                    'Unable to upload thumbnail, try again',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);

            }
        } else {
            // course doesn't exist
            $notification = [
                'message' => 'Sorry, course doesn\'t exist',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with();
        }
    }

    // view course full details
    public function viewCourse ($id) {
        // decrypting id
        $id = \Crypt::decrypt($id);

        // find course
        $course_tbl = Course::find($id);

        return view('v1.admin.dashboard.course.view_course', ['course' => $course_tbl]);
    }
}
