<?php
namespace App\CourseComponents;

use App\Course;
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: theba
 * Date: 4/21/2016
 * Time: 12:17 AM
 */
trait GetAvailableCourses
{

    /**
     * Get all courses with user is enroll by user_id
     *
     * @param  null $user_id
     * @return mixed
     */
    public function getAvailableCourses($user_id = null)
    {
        $courses = Course::open()->where('start_at', '>=', Carbon::today()->subDay(2));
        if ($user_id != null) {
            $courses->whereDoesntHave('users', function ($q) use ($user_id) {
                $q->where('users.id', $user_id);
            });

            $courses->with(['enroll' => function ($q) use ($user_id) {
                $q->owner($user_id);
            }]);
        }
        return $courses;
    }

}