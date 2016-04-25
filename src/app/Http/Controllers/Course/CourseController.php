<?php

namespace App\Http\Controllers\Course;

use App\CourseComponents\GetCourseDetail;
use App\CourseComponents\GetCoursesWithOneUser;
use App\CourseComponents\GetAvailableCourses;
use App\Enroll;
use App\Payment;
use App\Room;
use App\Teacher;
use Auth;
use App\Course;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use GetCoursesWithOneUser, GetCourseDetail, GetAvailableCourses;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'getCourse']]);
        $this->middleware('manager', ['only' => ['getCourseCreate', 'postCourseCreate', 'getCourseEdit',
            'patchCourse', 'getCourseDelete', 'deleteCourse', 'getCourseManage']]);

    }

    public function getAvail()
    {
        return view('course.index', ['courses' => $this->getAvailableCourses($this->getUserId())->get()]);
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

    public function getCourseManage()
    {
        $courses = Course::all();
        return view('course.manage', compact('courses'));
    }

    /**
     * Show form to create new course.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCourseCreate()
    {
        $teachers = Teacher::all();
        $rooms = Room::all();
        return view('course.create', compact('teachers', 'rooms'));
    }

    /**
     * Store new course.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postCourseCreate(CreateCourseRequest $request)
    {
        $on_day = [];
        for ($i = 0; $i <= 6; $i++) {
            if (in_array($i, $request->on_day)) {
                $on_day[] = 1;
            } else {
                $on_day[] = 0;
            }
        }

        $course = new Course();
        $course->fill($request->all());
        $course->on_day = $on_day;
        $course->is_open = 1;
        $course->save();

        foreach ($request->room_id as $room) {

            $room = Room::find($room);
            $course->rooms()->save($room);
            // $course->save();
        }

        if ($request->hasFile('img')) {
            $request->file('img')->move("imgs/courses/", $course->id . '.jpg');
        }

        return redirect('/manager')->with(['msg' => 'สร้างคอร์สสำเร็จแล้ว']);
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
        $teachers = Teacher::all();
        $rooms = Room::all();
        return view('course.edit', compact('course', 'teachers', 'rooms'));
    }

    /**
     * Store course is edit.
     *
     * @param  Request $request
     * @param  int $course_id
     *
     * @return \Illuminate\Http\Response
     */
    public function patchCourse(CreateCourseRequest $request, $course_id)
    {
        $on_day = [];
        for ($i = 0; $i <= 6; $i++) {
            if (in_array($i, $request->on_day)) {
                $on_day[] = 1;
            } else {
                $on_day[] = 0;
            }
        }
        $course = Course::find($course_id);

        $course->fill($request->all());
        $course->on_day = $on_day;
        $course->save();
        if ($request->room_id != null) {
            $course->rooms()->sync($request->room_id);
        }
        $course->save();
        if ($request->hasFile('img')) {
            $request->file('img')->move("imgs/courses/", $course->id . '.jpg');
        }
        return back()->with(['msg' => 'บันทึกข้อมูลเรียบร้อยแล้ว']);
    }

    public function getCourseDelete(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);
        $course->delete();
        return back()->with(['msg' => 'ลบคอร์สเรียบร้อยแล้ว']);
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
