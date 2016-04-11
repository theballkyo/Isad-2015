<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all courses
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function courses()
    {
        $this->belongsToMany('App\Course');
    }

    /**
     * Get all payments info
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function payments()
    {
        $this->hasMany('App\Payment');
    }

    public function getTextRole()
    {
        switch ($this->type) {
            case 1:
                return "สมาชิก";
            case 2:
                return "ผู้ดูแลห้องเรียน";
            case 3:
                return "อาจารย์";
            default:
                return "unknown";
        }
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher');
    }
}
