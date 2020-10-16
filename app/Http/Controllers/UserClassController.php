<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserClassController extends Controller
{
    // index page
    public function index () {
        return view('v1.user.dashboard.class.index');
    }
}
