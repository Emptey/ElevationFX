<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInvestment extends Model
{
    // allow mass assignment
    protected $guarded = ['id'];
    
    // relationship between user_investment and investment
    public function investment () {
        return $this->belongsTo('App\Investment');
    }

    // relationship between user_investment and user_investment_payment
    public function user_investment_payment () {
        return $this->hasMany('App\UserInvestmentPayment');
    }

    // relationship between user_investment and user
    public function user () {
        return $this->belongsTo('App\User');
    }
}
