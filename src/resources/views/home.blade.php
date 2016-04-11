@extends('layouts.main')

@section('content')
    <br><br>
    <h1 class="header center orange-text">Starter School System</h1>
    <div class="row center">
        <h5 class="header col s12 light">Developed preview 1.0</h5>
    </div>
    <div class="row center">
        <a href="#" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
    </div>
    <br><br>
    <div class="row">
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
                    <a class="btn-large waves-effect waves-light orange col s12" href="#">ลงทะเบียนเรียนเลย</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
