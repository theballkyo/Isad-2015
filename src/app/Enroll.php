<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    protected $table = 'course_user';

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function isEnroll()
    {
        return $this->user_id == Auth::user()->id;
    }

    public function scopeOnlyUser($query, $id)
    {
        return $query->where('user_id', $id);
    }
    
}
