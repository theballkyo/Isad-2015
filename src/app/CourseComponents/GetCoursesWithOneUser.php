<?php
namespace App\CourseComponents;

use App\Course;
use Cache;

trait GetCoursesWithOneUser
{

    /**
     * Get all courses with user is enroll by user_id
     *
     * @param  null $user_id
     * @return mixed
     */
    public function getCoursesWithOneUser($user_id = null)
    {
        $courses = Course::open()->get();

        $courses->load(['enroll' => function ($query) use ($user_id) {
            $query->owner($user_id);
        }, 'enroll.payment' => function ($query) {
            $query->latest();
        }, 'users']);
        return $courses;
    }
}