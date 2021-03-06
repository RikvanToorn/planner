<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

    protected $fillable = [
        'name', 'description',
    ];

    public function users() {
        return $this->belongsToMany('App\User')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function tasks() {
        return $this->hasMany('App\Task');
    }
}
