@extends('layouts.main')

@section('content')
    @foreach($enrolls as $enroll)
        @include('course.show_info', ['course' => $enroll->course])
        <hr>
    @endforeach
@endsection
