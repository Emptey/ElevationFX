<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\UserClass;
use App\UserResource;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AdminDashboard extends Controller
{
    // get admin dashboard
    public function index () {
        // get all users
        $user_tbl = User::all();

        // get all courses
        $course_tbl = Course::all();

        // get all user classes
        $class_tbl =  UserClass::all();

        // get all resources
        $resource_tbl = UserResource::all();

        // 
        $chart_options = [
            'chart_title' => 'Investors by Month',
            'report_type' => 'group_by_date',
            'model' => 'App\UserInvestment',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];

        $chart1 = new LaravelChart($chart_options);
        return view('v1.admin.dashboard.index', ['user' => $user_tbl, 'course' => $course_tbl, 'class' => $class_tbl, 'resource' => $resource_tbl], compact('chart1'));
    }
}
