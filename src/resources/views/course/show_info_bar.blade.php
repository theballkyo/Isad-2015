<div class="card">
    <div class="card-image">
        <img class="img-thumbnail" style="width: 100%" src="{{ asset('imgs/courses/' . $course->id . '.jpg') }}"/>
    </div>
    <div class="card-content">
        <p>{{ $course->description }}</p>
    </div>
    <div class="card-action">
        <div class="row">อาจารย์ <a class="btn blue"
                                    href="#">{{ $course->teacher->user->first_name }} {{ $course->teacher->user->last_name }}</a>
        </div>
        <div class="row">ประเภทคอร์ส: <a class="btn blue-grey" href="{{ url('/coursetype') }}">{{ $course->getTextCourseType() }}</a></div>
        <div class="row">ห้องเรียน:
                @if($course->rooms->count() < 1)
                    ไม่พบข้อมูลห้องเรียน
                @endif
                @foreach($course->rooms as $room)
                   <a class="btn orange"
                                    href="{{ url('/course/'.$course->id.'/'.$room->id) }}">{{ $room->title }}</a>
                @endforeach
        </div>

    </div>
    <div class="card-action">
        ราคา: {{ $course->price }} บาท || จำนวนการลงทะเบียนเรียน {{ $course->users->count() }}
        / {{ $course->max_user }} คน
    </div>
</div>