<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseComponents\GetCoursesWithOneUser;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use GetCoursesWithOneUser;
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
        return view('home', ['courses' => $this->getCoursesWithOneUser($this->getUserId())]);
    }
}
