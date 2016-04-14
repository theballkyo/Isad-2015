@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col s4">
            <img class="img-thumbnail" style="width: 100%" src="{{ asset("imgs/$course->img") }}"/>
        </div>
        <div class="col s8">
            <div class="card">
                <div class="card-content">
                    <p>{{ $course->description }}</p>
                </div>
                <div class="card-action">
                    อาจารย์: <a
                            href="#">{{ $course->teacher->user->first_name }} {{ $course->teacher->user->last_name }}</a>
                    ประเภทคอร์ส: <a href="#">{{ $course->getTextCourseType() }}</a>
                    ห้องเรียน:
                    <ul>
                    @foreach($course->rooms as $room)
                        <li>
                        {{ $room->title }}
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="card-action">
                    ราคา: {{ $course->price }} บาท || จำนวนการลงทะเบียนเรียน {{ $course->enroll->count() }}
                    / {{ $course->max_user }} คน
                </div>
                @if($course->hasUser(auth()->user()->id))
                    <button class="btn-large waves-effect waves-light orange col s12">ลงทะเบียนไปแล้ว</button>
                @else
                    <form method="post"
                          action="{{ action('Course\CourseController@postEnroll', ['course_id' => $course->id]) }}">
                        <button class="btn-large waves-effect waves-light orange col s12">ลงทะเบียนเรียนเลย</button>
                        {!! csrf_field() !!}
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
