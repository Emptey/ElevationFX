<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
// use App\UserClass;

class UserDashboardController extends Controller
{
    // get index pgae
    public function index () {
        $user_tbl = User::find(\Auth::user()->id);
        return view('v1.user.dashboard.index', ['user' => $user_tbl]);
    }
}
