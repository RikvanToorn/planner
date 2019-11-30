<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function receiver() {
        return $this->belongsTo('App\User', 'id', 'receiver_user_id');
    }

    public function sender() {
        return $this->belongsTo('App\User', 'id', 'sender_user_id' );
    }
}
