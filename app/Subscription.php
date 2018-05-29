<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['user_id', 'paypal', 'voucher_code', 'expires_on'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

