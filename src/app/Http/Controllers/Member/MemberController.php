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

    public function patch(Request $request, $user_id)
    {
        $user = User::find($user_id);

        $user->fill($request->all());
    }

    public function postCreate(Request $request)
    {
        dd($request->all());
    }

    public function showProfile()
    {
        return view('member.show');
    }
}
