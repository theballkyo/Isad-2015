<?php

namespace App\Http\Controllers\Course;

use Auth;
use App\Course;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * enroll course
     *
     * @return \Illuminate\Http\Response
     */
    public function getEnroll(Request $request, $course_id)
    {
        if(!Auth::user()->isStudent()) {
            return dd("Error, not student");
        }
        if(Auth::user()->has('courses', '=', $course_id)->first() != null) {
            return dd('Errer, enrolled');
        }

        Auth::user()->courses()->attach($course_id);

        return dd("Enroll success");
    }
}
