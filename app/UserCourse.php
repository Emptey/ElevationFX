<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    // relationship between user_course and user
    public function user () {
        return $this->belongsTo('App\User');
    }

    // relationship between user_course and course 
    public function course () {
        return $this->belongsTo('App\Course');
    }

    // relationship between user_course and user_Class 
    public function user_class () {
        return $this->hasMany('App\UserClass', 'course_id');
    }
}
