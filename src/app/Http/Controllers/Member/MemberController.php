<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{

    public function index(Request $request) {
        return view('member.index');
    }

    public function showProfile()
    {
        return view('member.profile');
    }
}
