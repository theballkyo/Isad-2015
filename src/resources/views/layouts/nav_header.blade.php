<li><a href="{{ url('/course') }}">ดูคอร์สเรียนทั้งหมด</a></li>
@if (Auth::guest())
    <li><a href="{{ url('/login') }}">เข้าสู่ระบบ</a></li>
    <li><a href="{{ url('/register') }}">สมัครสมาชิก</a></li>
@else
    @if (Auth::user()->isManager())
        <li><a href="{{ url('/manager') }}">เข้าสู่หน้าจัดการ</a></li>
    @elseif(Auth::user()->isStudent())
        <li><a href="{{ route('member') }}">ดูข้อมูลส่วนตัว</a></li>
    @elseif(auth()->user()->isTeacher())
        <li><a href="{{ url('/timetable') }}">ดูตารางสอน</a></li>
    @elseif(auth()->user()->isOwner())
        <li><a href="{{ url('/admin') }}">จัดการระบบ</a></li>
    @endif
    <ul id='user_info' class='dropdown-content'>
        <li><a href="{{ url('/logout') }}">ออกจากระบบ</a></li>
    </ul>
    <ul id='user_info2' class='dropdown-content'>
        <li><a href="{{ url('/logout') }}">ออกจากระบบ</a></li>
    </ul>
@endif