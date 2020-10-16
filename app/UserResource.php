<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserResource extends Model
{
    // relationship between user_resource and course
    public function course () {
        return $this->belongsTo('App\Course');
    }
}
