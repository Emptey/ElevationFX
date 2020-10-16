<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    // index page
    public function index () {
        return view('v1.user.dashboard.notification.index');
    }
}
