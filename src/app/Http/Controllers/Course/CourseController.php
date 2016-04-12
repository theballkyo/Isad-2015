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
     *
     * View course
     */
    public function getCourse(Request $request, $course_id)
    {
        $course = Course::find($course_id);
        if($course === null)
        {
            $request->session()->flash('type__', 'course');
            return abort(404);

        }
        return view('course.enroll', ['course' => $course]);
    }
    /**
     * store enroll course
     *
     * @return \Illuminate\Http\Response
     */
    public function postEnroll(Request $request, $course_id)
    {
        if(!$request->user()->isStudent()) {
            return dd("Error, not student");
        }
        if($request->user()->has('courses', '=', $course_id)->first() != null) {
            return dd('Errer, enrolled');
        }

        $request->user()->courses()->attach($course_id);

        return dd("Enroll success");
    }

    public function display404()
    {

    }
}
