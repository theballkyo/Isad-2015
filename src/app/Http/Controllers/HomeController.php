<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseComponents\GetAvailableCourses;
use App\Http\Requests;
use App\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use GetAvailableCourses;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('teacher', ['only' => ['timetable']]);
        $this->middleware('manager', ['only' => ['timetableById']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', ['courses' => $this->getAvailableCourses($this->getUserId())]);
    }

    public function timetable()
    {
        $teacher = auth()->user()->teacher->with(['courses' => function ($q) {
            $q->where('end_at', '>=', \Carbon\Carbon::today());
        }])->first();
        $courses = $teacher->courses;
        $today = \Carbon\Carbon::today();
        return view('timetable', compact('courses', 'today'));
    }

    public function timetableById($teacher_id)
    {
        $teacher = Teacher::where('user_id', $teacher_id)->with(['courses' => function ($q) {
            $q->where('end_at', '>=', \Carbon\Carbon::today());
        }])->first();
        $courses = $teacher->courses;
        $today = \Carbon\Carbon::today();
        return view('timetable', compact('courses', 'today'));
    }
}
