<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // relationship between course and user_course
    public function user_course () {
        return $this->hasMany('App\UserCourse');
    }

    // relationship between course and user_class
    public function user_class () {
        return $this->hasMany('App\UserClass');
    }

    // relationship between course and user_resource
    public function user_resource() {
        return $this->hasMany('App\UserResource');
    }
}
