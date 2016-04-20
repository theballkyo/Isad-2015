<?php
namespace App\CourseComponents;

use App\Course;

trait GetCourseDetail
{
    public function getCourseDetail($course_id, $user_id = null)
    {
        $course = Course::where('id', $course_id)->with(['enroll' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->first();

        return $course;
    }

}