<?php

namespace App\Http\Controllers\Course;

use App\CourseComponents\GetCourseDetail;
use App\CourseComponents\GetCoursesWithOneUser;
use App\Enroll;
use App\Payment;
use Auth;
use App\Course;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use GetCoursesWithOneUser, GetCourseDetail;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'getCourse']]);
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
        return view('course.index', ['courses' => $this->getCoursesWithOneUser($this->getUserId())]);
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
        $course = $this->getCourseDetail($course_id, $this->getUserId());
        if ($course->enroll) {
            $payments = $course->enroll->payments;
        }
        return view('course.show', compact('course', 'payments'));
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
        $course = Course::find($course_id);

        if ($request->user()->hasCourse($course_id)) {
            return redirect('/');
        }

        if ($course->users->count() >= $course->max_user) {
            $request->session()->flash('error', 'max');
            return redirect('course/' . $course_id);
        } else {
            $request->user()->courses()->attach($course_id);
            return redirect()->action('Course\CourseController@getCourse', ['course_id' => $course_id])
                ->with('msg', trans('course.enrolled'));
        }
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
        //$course = $request->user()->courses();
        $enroll = $request->user()->enroll()->where('course_id', $course_id)->first();
        //dd($enroll);
        if ($enroll == null || $enroll->isApprove()) {
            return dd('Errer, not enrolled');
        }

        Payment::where('enroll_id', $enroll->id)->delete();

        $request->user()->courses()->detach($course_id);

        if ($request->ajax()) {
            return "ok";
        }

        return redirect()->action('Course\CourseController@index');
    }

    public function showEnroll(Request $request, $enroll_id)
    {
        $e = $request->user()->load(['enroll' => function ($q) use ($enroll_id) {
            $q->where('id', '=', $enroll_id);
        }]);
        if ($e->enroll == null) {
            return dd('Errer, enrolled');
        }
        return view('course.enroll.show', ['course' => $e->enroll->course, 'payments' => $e->enroll->payments]);
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
        $enrolls = $request->user()->enrolls();
        if (!is_null($request->ok)) {
            $enrolls->approve();
        } else if (!is_null($request->wait)) {
            $enrolls->waitForPayment();
        } else if (!is_null($request->check)) {
            $enrolls->check();
        }
        $enrolls = $enrolls->with('course')->get();

        return view('course.member.table', compact('enrolls'));
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
