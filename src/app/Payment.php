<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function user()
    {
        $this->hasOne('App\User');
    }

    public function course()
    {
        $this->hasOne('App\Course');
    }
}
