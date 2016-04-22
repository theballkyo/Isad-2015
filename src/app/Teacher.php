<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function courses()
    {
        return $this->hasMany('App\Course', 'teacher_id');
    }
}
