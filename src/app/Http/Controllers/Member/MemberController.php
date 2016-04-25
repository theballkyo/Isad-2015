<?php
namespace App\Http\Controllers\Member;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->middleware('can_manage', ['except' => ['index', 'saveProfile', 'showProfile']]);
    }

    public function index(Request $request)
    {
        return view('member.index');
    }

    public function indexManager()
    {
        return view('member.manager.index');
    }

    public function getCreate()
    {
        return view('member.create');
    }

    public function getEdit($user_id)
    {
        $user = User::find($user_id);

        return view('member.edit', compact('user'));
    }

    public function getManage()
    {
        $users = User::has('student')->get();

        return view('member.manage', compact('users'));
    }

    public function postEdit(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $oldpass = $user->password;
        $user->fill($request->all());
        if (empty($request->password)) {
            $user->password = $oldpass;
        }
        $user->save();

        return back()->with(['msg' => 'แก้ไขข้อมูลสำเร็จ']);
    }

    public function saveProfile(Request $request)
    {
        $user = auth()->user();
        $oldpass = $user->password;
        $user->fill($request->all());
        if (empty($request->password)) {
            $user->password = $oldpass;
        }
        $user->save();

        return back()->with(['msg' => 'แก้ไขข้อมูลสำเร็จ']);
    }

    public function postCreate(UserCreateRequest $request)
    {
        $user = new User();

        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->setStudent();

        $user->save();

        $user->student()->create([
            'user_id' => $user->id
        ]);

        return redirect('/member/manage')->with(['msg' => 'สร้างผู้ใช้งานสำเร็จ']);
    }

    public function showProfile()
    {
        $user = auth()->user();

        return view('member.show', compact('user'));
    }

    public function getDelete($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();

        return back()->with(['msg' => 'ลบผู้ใช้งานเรียบร้อยแล้ว']);
    }

    public function getTeacher()
    {
        $users = User::has('teacher')->get();

        return view('member.teacher', compact('users'));
    }

    public function getTeacherCreate()
    {
        return view('teacher.create');
    }

    public function getTeacherManage()
    {
        $users = User::has('teacher')->get();

        return view('teacher.manage', compact('users'));
    }

    public function postTeacherCreate(Request $request)
    {
        $user = new User();

        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->setTeacher();

        $user->save();

        $user->teacher()->create([
            'user_id' => $user->id
        ]);

        return redirect('/teacher/manage')->with(['msg' => 'สร้างผู้ใช้งานสำเร็จ']);
    }

    public function deleteTeacher($teacher_id)
    {
        $user = User::findOrFail($teacher_id);
        $user->delete();
        return redirect('/teacher/manage')->with(['msg' => 'ลบผู้ใช้งานเรียบร้อยแล้ว']);
    }

    public function editTeacher($teacher_id)
    {
        $user = User::findOrFail($teacher_id);
        return view('/teacher/edit', compact('user'));
    }

    public function saveTeacher(Request $request, $teacher_id)
    {
        $user = User::findOrFail($teacher_id);
        $oldpass = $user->password;
        $user->fill($request->all());
        if (empty($request->password)) {
            $user->password = $oldpass;
        }
        $user->save();

        return redirect('/teacher/manage')->with(['msg' => 'แก้ไขข้อมูลสำเร็จ']);
    }

    // Manager
    public function getManagerCreate()
    {
        return view('manager.create');
    }

    public function getManagerManage()
    {
        $users = User::has('manager')->get();

        return view('manager.manage', compact('users'));
    }

    public function postManagerCreate(Request $request)
    {
        $user = new User();

        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->setManage();

        $user->save();

        $user->manager()->create([
            'user_id' => $user->id
        ]);

        return redirect('/manager/manage')->with(['msg' => 'สร้างผู้ใช้งานสำเร็จ']);
    }

    public function deleteManager($teacher_id)
    {
        $user = User::findOrFail($teacher_id);
        $user->delete();
        return redirect('/manager/manage')->with(['msg' => 'ลบผู้ใช้งานเรียบร้อยแล้ว']);
    }

    public function editManager($teacher_id)
    {
        $user = User::findOrFail($teacher_id);
        return view('manager.edit', compact('user'));
    }

    public function saveManager(Request $request, $teacher_id)
    {
        $user = User::findOrFail($teacher_id);
        $oldpass = $user->password;
        $user->fill($request->all());
        if (empty($request->password)) {
            $user->password = $oldpass;
        }
        $user->save();

        return redirect('/manager/manage')->with(['msg' => 'แก้ไขข้อมูลสำเร็จ']);
    }
}
