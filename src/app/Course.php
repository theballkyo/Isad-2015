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
}
