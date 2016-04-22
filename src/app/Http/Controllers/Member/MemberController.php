<?php
namespace App\Http\Controllers\Member;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{

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

    public function postCreate(Request $request)
    {
        $user = new User();

        $user->fill($request->all());
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
}
