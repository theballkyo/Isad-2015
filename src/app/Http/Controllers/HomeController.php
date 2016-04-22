<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseComponents\GetAvailableCourses;
use App\Http\Requests;
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
}
