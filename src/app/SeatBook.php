<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeatBook extends Model
{
    public $table = 'seat_book';
    public $timestamps = false;
    public function enroll()
    {
        return $this->belongsTo('App\Enroll');
    }
}
