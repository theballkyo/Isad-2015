<?php
namespace App\Http\Controllers\Course;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeatBookRequest;
use App\Room;
use App\SeatBook;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['viewCourseRoom', 'getRoom']]);
    }

    public function index()
    {

    }

    public function getCreate()
    {
        return view('room.create');
    }

    public function getManage()
    {
        $rooms = Room::all();

        return view('room.manage', compact('rooms'));
    }

    public function getRoom(Request $request, $room_id)
    {
        $room = Room::find($room_id);

        return view('room.view', compact('room'));
    }

    public function getCourseRoom(Request $request, $course_id)
    {
        $course = Course::find($course_id);

        dd($course->rooms);
    }

    public function viewCourseRoom(Request $request, $course_id, $room_id)
    {
        $course = Course::find($course_id);
        $room = $course->rooms()->where('rooms.id', $room_id)->first();
        $seatBook = $room->seatBook()->select('seat_name')->get();
        $seat_own = null;
        if (auth()->check()) {
            $enroll = $course->enroll()->where('user_id', auth()->user()->id)->first();
            if ($enroll != null) {
                $seat = $room->seatBook->where('enroll_id', $enroll->id)->first();
                if ($seat != null) {
                    $seat_own = $seat->seat_name;
                }
            }
        }
        return view('room.view', compact('course', 'room', 'seat_own'));
    }

    public function saveSeat(SeatBookRequest $request, $course_id, $room_id)
    {

        $enroll = auth()->user()->enroll()->where('course_id', $course_id)->first();

        if ($enroll->seatBook != null) {
            return back()->withErrors(['คุณได้จองที่นั่งไปแล้ว']);
        }
        if (SeatBook::where('seat_name', $request->seat_id)->exists()) {
            return back()->withErrors(['ที่นั่งนี้มีคนจองไปแล้ว']);
        }
        $seatBook = new SeatBook();
        $seatBook->seat_name = $request->seat_id;
        $seatBook->room_id = $room_id;
        $enroll->seatBook()->save($seatBook);
        return back()->with(['msg' => trans('room.book_succ')]);
    }

    public function deleteSeat(Request $request, $course_id, $room_id)
    {
        $enroll = auth()->user()->enroll()->where('course_id', $course_id)->first();

        if ($enroll->seatBook == null) {
            return back()->withErrors(['คุณยังไม่ได้จองที่ยั่ง']);
        }

        $enroll->seatBook->delete();

        return back()->with(['msg' => 'ยกเลิกการจองเรียบร้อยแล้ว']);
    }
}