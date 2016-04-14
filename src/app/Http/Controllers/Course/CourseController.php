<?php

namespace App\Http\Controllers\Course;

use App\Enroll;
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
     * Show all courses.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::with('teacher.user')->open()->get();

       // return dd($courses);

        return view('course.index', ['courses' => $courses]);
    }

    /**
     * Show form to create new course.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCourseCreate()
    {
        return view('course.create');
    }

    /**
     * Store new course.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postCourseCreate(Request $request)
    {
        $this->validate($request, [
            //'title' => 'required|unique:posts|max:255',
            //'body' => 'required',
        ]);

        $teacher = Teacher::where('teacher_id', '=', $request->teacher_id)->first();

        if ($teacher == null) {
            // error !?
        }

        $course = new Course;
        // ...

        $course->save();
        $teacher->courses()->save($course);

        return redirect()->action('CourseController@getCourse', ['course_id' => $course->id]);
    }

    /**
     * View course.
     *
     * @param  Request $request
     * @param  int $course_id
     *
     * @return \Illuminate\Http\Response
     */
    public function getCourse(Request $request, $course_id)
    {
        $course = Course::where('id', $course_id)->with('users', 'teacher', 'rooms')->first();
        if ($course === null) {
            $request->session()->flash('type__', 'course');
            return abort(404);
        }

        return view('course.show', ['course' => $course]);
    }

    /**
     * Show form to edit course.
     *
     * @param  Request $request
     * @param  int $course_id
     *
     * @return \Illuminate\Http\Response
     */
    public function getCourseEdit(Request $request, $course_id)
    {
        $course = Course::find($course_id);
        if ($course === null) {
            $request->session()->flash('type__', 'course');
            return abort(404);
        }

        return view('course.edit');
    }

    /**
     * Store course is edit.
     *
     * @param  Request $request
     * @param  int $course_id
     *
     * @return \Illuminate\Http\Response
     */
    public function patchCourse(Request $request, $course_id)
    {
        $course = Course::find($course_id);
        if ($course === null) {
            $request->session()->flash('type__', 'course');
            return abort(404);
        }

        $this->validator($request);

        $course = $this->mapCourse($request, $course_id);

        $course->save();

        return view('course.edit', ['save' => true]);
    }

    /**
     * Delete course.
     *
     * @param  Request $request
     * @param  int $course_id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteCourse(Request $request, $course_id)
    {
        $course = Course::find($course_id);
        if ($course === null) {
            $request->session()->flash('type__', 'course');
            return abort(404);
        }

        $course->delete();

        return view('course.index', ['delete' => true]);
    }

    /**
     * store enroll course
     *
     * @param  Request $request
     * @param  int $course_id
     *
     * @return \Illuminate\Http\Response
     */
    public function postEnroll(Request $request, $course_id)
    {
        if ($request->user()->hasCourse($course_id)) {
            return dd('Errer, enrolled');
        }

        $request->user()->courses()->attach($course_id);

        return dd("Enroll success");
    }

    /**
     * Cancel enroll course
     *
     * @param  Request $request
     * @param  int $course_id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteEnroll(Request $request, $course_id)
    {
        if ($request->user()->hasCourse($course_id)) {
            return dd('Errer, enrolled');
        }

        $request->user()->courses()->detach($course_id);

        return redirect()->action('Course\CourseController@index');
    }

    /**
     * View detail course is enroll.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getEnroll(Request $request)
    {
        $enrolls = Enroll::owner()->with('course', 'payment')->get();

        return view('course.enroll.index', ['enrolls' => $enrolls]);
    }

    /**
     * View detail course is enroll.
     *
     * @param  Request $request
     * @param  int $enroll_id
     *
     * @return \Illuminate\Http\Response
     */
    public function showEnroll(Request $request, $enroll_id)
    {
        $enroll = Enroll::where($enroll_id)->owner()->get();

        if ($enroll == null) {
            // Null

        }

        return view('course.enroll.show', ['course' => $course]);
    }

    /**
     * Map a course object with request object
     *
     * @param  Request $request
     * @param  App\Course $course
     *
     * @return App\Course
     */
    public function mapCourse($request, $course)
    {
        return $course;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  Request $request
     * @return void
     */
    private function validator(Request $request)
    {
        $this->validate($request, [
            //'first_name' => 'required|max:255',
            //'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }
}
