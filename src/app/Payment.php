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

    public function scopeOwner($query)
    {
        $query->where('course_user_id', '=', auth()->user()->id);
    }
}
