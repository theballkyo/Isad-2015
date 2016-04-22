<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function courses()
    {
        $this->belongsToMany('App\Course');
    }

    public function seat()
    {
        return $this->hasOne('App\Seat');
    }

    public function seatBook()
    {
        return $this->hasMany('App\SeatBook');
    }
}
