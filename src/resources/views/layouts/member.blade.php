@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col s4">
            <ul class="collapsible" data-collapsible="expandable">
                <li>
                    <div class="collapsible-header active"><i class="material-icons">filter_drama</i>จัดการคอร์สเรียน</div>
                    <div class="collapsible-body">
                        <ul class="collection">
                            <li class="collection-item"><a href="{{ url('/enroll') }}" class="collection-item">คอร์สที่ลงเรียน</a>
                            </li>
                            <li class="collection-item"><a href="{{ url('/enroll?wait') }}" class="collection-item">คอร์สที่รอการชำระเงิน</a>
                            </li>
                            <li class="collection-item"><a href="{{ url('/enroll?check') }}" class="collection-item">คอร์สที่กำลังตรวจสอบ</a>
                            </li>
                            <li class="collection-item"><a href="{{ url('/enroll?ok') }}" class="collection-item">คอร์สที่ชำระเงินแล้ว</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header active"><i class="material-icons">filter_drama</i>ข้อมูลส่วนตัว</div>
                    <div class="collapsible-body">
                        <ul class="collection">
                            <li class="collection-item"><a href="{{ url('/member/profile') }}" class="collection-item">จัดการข้อมูลส่วนตัว</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header active"><i class="material-icons">filter_drama</i><a href="{{ url('/logout') }}">ออกจากระบบ</a></div>
                </li>
            </ul>
        </div>
        <div class="col s8">
            @yield('member_content')
        </div>
    </div>
@endsection