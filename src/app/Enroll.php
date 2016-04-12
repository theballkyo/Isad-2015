<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    protected $table = 'course_table';

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
