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
        return $this->belongsToMany('App\Course', 'enrolls');
    }

    public function enrolls()
    {
        return $this->hasMany('App\Enroll');
    }

    /**
     * Get all payments info
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function teacher()
    {
        return $this->hasOne('App\Teacher');
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

    public function isStudent()
    {
        return $this->type == 1;
    }

    public function isManager()
    {
        return $this->type == 2;
    }

    public function isTeacher()
    {
        return $this->type == 3;
    }

    public function hasCourse($id)
    {
        return $this->courses->contains('id', $id);
    }
}
