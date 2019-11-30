<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups() {
        return $this->belongsToMany('App\Group')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function receivedmessages() {
        return $this->hasMany('App\Message', 'receiver_user_id', 'id');
    }

    public function sendmessages() {
        return $this->hasMany('App\Message', 'sender_user_id', 'id');
    }

}
