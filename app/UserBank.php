<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    // relationship between user_bank and user
    public function user () {
        return $this->belongsTo('App\User');
    }
    
}
