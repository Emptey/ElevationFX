<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\UserInvestment;
use App\UserCourse;

class NotificationManagement extends Controller
{
    // index page
    public function index () {
        // fetch notifications
        $notification_tbl = Notification::all();
        return view('v1.admin.dashboard.notification.index', ['notification' => $notification_tbl]);
    }

    // search notification
    public function search (Request $request) {
        // validation
        $this->validate($request, [
            'search' => 'required|regex:/^[a-zA-Z\s]*$/',
        ]);

        // find notification
        $notification_tbl = Notification::where('title', 'LIKE', '%'.$request->search.'%')->get();
        
        // check if notification exist
        if ($notification_tbl->count() > 0) {
            // notification found
            return view('v1.admin.dashboard.notification.index', ['notification' => $notification_tbl]);
        } else {
            // notification not found
            $notification = [
                'message' => 'Notification not found.',
                'alert-type' => 'error',
            ];

            return redirect()
                    ->back()
                    ->with($notification);
        }
    }

    // create notification
    public function create () {
        return view('v1.admin.dashboard.notification.add');
    }

    // send notifications
    public function store (Request $request) {
        // validation
        $this->validate($request, [
            'recipient' => 'numeric|required',
            'title' => 'required|regex:/^[a-zA-Z\s]*$/',
            'message' => 'required'
        ]);

        // check if notification is for investors or students
        if ($request->recipient == 1) {
            $students = UserCourse::select('user_id')->distinct()->get();

            // check if students record was retrieved
            if ($students->count() > 0) {
                // students record retrieved - send notification to studnets
                foreach($students as $all_students) {
                    $new_notification = new Notification();
                    
                    // add notification information
                    $new_notification->user_id = $all_students->user_id;
                    $new_notification->title   = strtolower($request->title);
                    $new_notification->message = $request->message;

                    // save notification
                    $save_notification = $new_notification->save();

                    // check if notification was saved
                    if ($save_notification) {
                        // notification saved
                        $notification = [
                            'message' => 'Notification sent to students successfully',
                            'alert-type' => 'success',
                        ];

                        return redirect()
                                ->route('user-notification')
                                ->with($notification);
                    } else {
                        // notification not saved
                        $notification = [
                            'message' => 'Notification failed to send, try again',
                            'alert-type' => 'error',
                        ];

                        return redirect() 
                                ->back()
                                ->with($notification);
                    }
                }

            } else {
                // student record not retrieved
                $notification = [
                    'message' => 'There are no registered students yet',
                    'alert-type' => 'warning',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }
        } else if ($request->recipient == 2) {
            // send notification to investors
            $investors = UserInvestment::select('user_id')->distinct()->get();

            // check if investors 
            if ($investors->count() > 0) {
                // investor records found
                foreach($investors as $all_investor) {
                    $new_notification = new Notification();

                    // add information to notificatio
                    $new_notification->user_id = $all_investor->user_id;
                    $new_notification->title   = strtolower($request->title);
                    $new_notification->message = $request->message;

                    $save_notification = $new_notification->save();

                    // check if notification was saved
                    if ($save_notification) {
                        $notification = [
                            'message' => 'Notification sent to investors successfully.',
                            'alert-type' => 'success',
                        ];

                        return redirect()
                                ->route('user-notification')
                                ->with($notification);
                    } else {
                        // notification sending failed
                        $notification = [
                            'message' => 'Notification failed to send, try again',
                            'alert-type' => 'error',
                        ];

                        return redirect()
                                ->back()
                                ->with($notification);
                    }
                }

            } else {
                // investor record not found.
                $notification = [
                    'message' => 'There are no active investors found.',
                    'alert-type' => 'error',
                ];

                return redirect()
                        ->back()
                        ->with($notification);
            }
        }
    }
}
