<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function room()
    {
        return $this->belongsToMany('App\Room');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'teacher_id', 'user_id');
    }
}
