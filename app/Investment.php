<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    // relationship between investment and user investment
    public function user_investment () {
        return $this->hasMany('App\UserInvestment');
    }

    // relationship between investment and user_investment_payout
    public function user_investment_payment () {
        return $this->hasMany('App\UserInvestmentPayment');
    }
}
