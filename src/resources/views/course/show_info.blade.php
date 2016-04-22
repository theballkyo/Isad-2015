<div class="row">
    <div class="col s4">
        <img class="img-thumbnail" style="width: 100%" src="{{ asset('imgs/courses/' . $course->id . '.jpg') }}"/>
    </div>
    <div class="col s8">
        <div class="card">
            <div class="card-content">
                <p>{{ $course->description }}</p>
            </div>
            <div class="card-action">
                อาจารย์: <a class="btn blue-grey"
                            href="#">{{ $course->teacher->user->first_name }} {{ $course->teacher->user->last_name }}</a>
                ประเภทคอร์ส: <a class="btn blue-grey" href="#">{{ $course->getTextCourseType() }}</a>
                ห้องเรียน:
                <ul class="ul-room">

                    @if($course->rooms->count() < 1)
                        <li>ไม่พบข้อมูลห้องเรียน</li>
                    @endif
                    @foreach($course->rooms as $room)
                        <li class=""><a class="btn orange" href="{{ url('/course/'.$course->id.'/'.$room->id) }}">{{ $room->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="card-action">
                ราคา: {{ $course->price }} บาท || จำนวนการลงทะเบียนเรียน {{ $course->users->count() }}
                / {{ $course->max_user }} คน
            </div>
            <div class="card-action">
                เริ่มเรียน {{ $course->start_at }} - {{ $course->end_at }} || เวลาเรียน {{ $course->start_time }} - {{ $course->end_time }}
            </div>
            @if(!auth()->guest())
                @if(!auth()->user()->isStudent())
                @elseif($course->enroll != null)
                    @if($course->enroll->isApprove())
                        <a href="#"
                           class="btn-large waves-effect waves-light light-green col s12">ชำระเงินเรียนร้อยแล้ว</a>
                    @elseif($course->enroll->isCheck())
                        <a href="#" class="btn-large waves-effect waves-light light-blue col s12">กำลังตรวจสอบการชำระเงิน</a>
                    @elseif($course->enroll->isWait())
                        <div class="row">
                            <div class="col s6">@include('btn.course.payment', ['id' => $course->enroll->id])</div>
                            <div class="col s6">@include('btn.course.delete', ['id' => $course->id])</div>
                        </div>
                    @endif
                @else
                    @if($course->users->count() >= $course->max_user)
                        <a id="max_user_alert" href="#"
                           class="btn-large waves-effect waves-light deep-orange accent-4 col s12">ขออภัย
                            จำนวนคนลงเต็มเรียบร้อยแล้ว</a>
                    @else
                        <form method="post"
                              action="{{ action('Course\CourseController@postEnroll', ['course_id' => $course->id]) }}">
                            <button id="enroll" class="btn-large waves-effect waves-light orange col s12">
                                ลงทะเบียนเรียนเลย
                            </button>
                            {!! csrf_field() !!}
                        </form>
                    @endif
                @endif
            @else
                <a href="{{ url('/login') }}" class="btn-large orange col s12">เข้าสู่ระบบ/สมัครสมาชิก
                    เพื่อลงทะเบียน</a>
            @endif

        </div>
        @if($course->enroll != null)
            <p class="flow-text center-align">ประวัติการแจ้งชำระเงิน</p>
            @if(!isset($payments))
                <p>ไม่พบข้อมูล</p>
            @else
                <table>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->bank }}</td>
                            <td>{{ $payment->pay_time }}</td>
                            <td>{{ $payment->getTextStatus() }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        @endif
    </div>
</div>