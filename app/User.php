<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // relationship between user and user bank
    public function user_bank () {
        return $this->hasOne('App\UserBank');
    }

    // relationship between user and user_course
    public function user_course () {
        return $this->hasMany('App\UserCourse');
    }

    // relationship between user and user_investment 
    public function user_investment () {
        return $this->hasMany('App\UserInvestment');
    }

    // relationship between user and user_investment_payment
    public function user_investment_payment () {
        return $this->belongsTo('App\UserInvestmentPayment');
    }

    // relationship between user and notification
    public function notification () {
        return $this->hasMany('App\Notification');
    }
}
