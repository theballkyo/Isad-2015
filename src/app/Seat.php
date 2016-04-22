<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'pattern',
    ];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    
}
