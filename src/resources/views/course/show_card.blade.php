@foreach($courses as $course)
    <div class="col s12 m4">
        <div class="card">
            <div class="card-image">
                <img src="{{ asset('imgs/courses/' . $course->id . '.jpg') }}">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">{{ $course->title }}</span>
                @if($course->enroll != null)
                    <span class="badge">{{ $course->enroll->getTextStatus() }}</span>
                @endif
                <p class="grey-text">{{ $course->description }} :: {{$course->id}}</p>
            </div>
            <div class="card-action">
                {{ trans('course.period') }} {{ thaidate('d F Y', strtotime($course->start_at))  }} - {{ thaidate('d F Y', strtotime($course->end_at)) }}
            </div>
            <div class="card-action">
                อาจารย์: <a href="#">{{ $course->teacher->user->first_name }} {{ $course->teacher->user->last_name }}</a>
                ประเภทคอร์ส: <a href="#">{{ $course->getTextCourseType() }}</a>
            </div>

            <a href="{{ action('Course\CourseController@getCourse', ['course_id' => $course->id]) }}"
               class="btn-large waves-effect waves-light orange col s12">ดูรายละเอียดเพิ่มเติม</a>
            @if(isset($add_pay_btn))
                <div class="row">
                    <div class="col s6">@include('btn.course.payment', ['id' => $course->enroll->id])</div>
                    <div class="col s6">@include('btn.course.delete', ['id' => $course->id])</div>
                </div>
            @endif
        </div>

    </div>
@endforeach