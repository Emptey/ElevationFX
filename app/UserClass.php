<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserClass extends Model
{
    // relationship between user_class and course
    public function course () {
        return $this->belongsTo('App\Course');
    }

    // relationship between user_class and user_course 
    public function user_class () {
        return $this->hasMany('App\UserCourse', 'course_id');
    }
}
