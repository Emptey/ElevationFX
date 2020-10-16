<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInvestmentPayment extends Model
{
    // relation between user_investment_payment and investment
    public function investment () {
        return $this->belongsTo('App\Investment');
    }

    // relationship between user_investment_payment and user
    public function user () {
        return $this->belongsTo('App\User');
    }

    // relationship between user_investment_payment and user_investment
    public function user_investment () {
        return $this->belongsTo('App\UserInvestment');
    }
}
