<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'highlight','selection', 'comment', 'private_note'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

