@foreach($courses as $course)
    <div class="col s12 m4">
    <div class="card">
        <div class="card-image">
            <img src="{{ asset("imgs/$course->img") }}">
            <span class="card-title z-depth-1 col s12 grey-text">{{ $course->title }}</span>
        </div>
        <div class="card-content">
            <p>{{ $course->description }}</p>
        </div>
        <div class="card-action">
            อาจารย์: <a href="#">{{ $course->teacher->user->first_name }} {{ $course->teacher->user->last_name }}</a>
            ประเภทคอร์ส: <a href="#">{{ $course->getTextCourseType() }}</a>
        </div>
        @if(auth()->guest())
            <a href="{{ action('Course\CourseController@getCourse', ['course_id' => $course->id]) }}"
               class="btn-large waves-effect waves-light orange col s12">ลงทะเบียนเรียนเลย</a>
        @elseif(auth()->user()->isStudent())
            @if($course->enroll != null)
                @if($course->enroll->isApprove())
                    <a href="{{ action('Course\CourseController@getCourse', ['course_id' => $course->id]) }}" class="btn-large waves-effect waves-light light-green col s12">ชำระเงินเรียนร้อยแล้ว</a>
                @elseif($course->enroll->isCheck())
                    <a href="{{ action('Course\CourseController@getCourse', ['course_id' => $course->id]) }}" class="btn-large waves-effect waves-light light-blue col s12">กำลังตรวจสอบการชำระเงิน</a>
                @elseif($course->enroll->isWait())
                    <a href="{{ action('Payment\PaymentController@newPayment', ['course_id' => $course->enroll->id]) }}" class="btn-large waves-effect waves-light purple col s12">แจ้งชำระเงิน</a>
                @endif
            @else
                <a href="{{ action('Course\CourseController@getCourse', ['course_id' => $course->id]) }}"
                   class="btn-large waves-effect waves-light orange col s12">ลงทะเบียนเรียนเลย</a>
            @endif
        @elseif(auth()->user()->isManager())
        <a class="btn-large waves-effect waves-light deep-purple col s12" href="#">จัดการคอร์สเรียน</a>
        @endif
    </div>

</div>
@endforeach