<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserResource;
use App\Course;

class ResourceManagement extends Controller
{
    // index page
    public function index () {
        // get resources
        $resource_tbl = UserResource::all();
        return view('v1.admin.dashboard.resource.index', ['resource' => $resource_tbl]);
    }

    // search resource
    public function searchResource (Request $request) {
        // validation
        $this->validate($request, [
            'search' => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);

        // get resource
        $resource_tbl = UserResource::where('title', 'LIKE', '%'.$request->search.'%')->get();

        // check if resource exist
        if ($resource_tbl->count() > 0) {
            // resource exist
            return view('v1.admin.dashboard.resource.index', ['resource' => $resource_tbl]);
        } else {
            // resource doesn't exist
            $notification = [
                'message' => 'Resource not found.',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);

        }
    }

    // get add resource page
    public function addResource () {
        $course_tbl = Course::all();
        return view('v1.admin.dashboard.resource.add_resource', ['course' => $course_tbl]);
    }

    // post add resource request
    public function postAddResource (Request $request) {
        // validation
        $this->validate($request, [
            'course' => 'required|numeric',
            'title' => 'required|regex:/^[a-zA-Z\s]*$/',
            'document' => 'required|mimes:pdf',
        ]);

        // create new resource
        $resource_tbl = new UserResource();
        $resource_tbl->course_id = $request->course;
        $resource_tbl->title = strtolower($request->title);
        $resource_tbl->document = $request->document->hashName();
        $resource_tbl->downloads = 0;

        // upload document
        $resource_path = $request->file('document')->store('public/pdf');

        // check if upload was successful
        if (!is_null($resource_path)) {
            // document uploaded successfully - save resource
            $save_resource = $resource_tbl->save();

            // check if resource was saved
            if ($save_resource) {
                // resource saved successfully
                $notification = [
                    'message' => 'Resource uploaded successfully.',
                    'alert-type' => 'success',
                ];

                return redirect()
                        ->route('user-resource')
                        ->with($notification);
            } else {
                // resource not saved - notify user
                $notification = [
                    'message' => 'Resource upload failed, try again.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);

            }

        } else {
            // document upload failed - notify user
            $notification = [
                'message' => 'Document upload failed, try again.',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);

        }
    }

}
