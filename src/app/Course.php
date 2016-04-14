<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function rooms()
    {
        return $this->belongsToMany('App\Room');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'teacher_id', 'user_id');
    }

    public function getTextCourseType()
    {
        switch ($this->type) {
            case 1:
                return "สอนสด";
            case 2:
                return "วิดีโอ";
            default:
                return "ไม่พบในระบบ โปรดแจ้งผู้ดูแลระบบ";
        }
    }

    /**
     * Scope a query to only open courses.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen($query)
    {
        return $query->where('is_open', 1);
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function enroll()
    {
        return $this->hasMany('App\Enroll');
    }

    public function hasUser($id)
    {
        return $this->enroll->contains('user_id', $id);
    }
}
