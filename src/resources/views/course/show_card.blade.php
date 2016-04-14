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
        <a class="btn-large waves-effect waves-light orange col s12" href="{{ action('Course\CourseController@getCourse', ['course_id' => $course->id]) }}">ลงทะเบียนเรียนเลย</a>
    </div>
</div>