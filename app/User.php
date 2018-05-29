<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DateTime;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    public function hasValidSubscription()
    {
        return $this->subscriptions()->whereRaw('expires_on > CURDATE()')->first();
    }

    public function hasAccessToArticle($article_id)
    {
        $art = $this->invoices()
                    ->where('article_id', $article_id)
                    ->first();

        if (($this->hasValidSubscription() || ($art) ))
        {
            return true;
        }

        return false;
    }
}
