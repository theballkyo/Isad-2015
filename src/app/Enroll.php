<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    protected $table = 'course_user';

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function course()
    {
        return $this->hasOne('App\Course');
    }

    public function scopeOwner($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function isOwner()
    {
        return $this->user_id == Auth::user()->id;
    }
}
