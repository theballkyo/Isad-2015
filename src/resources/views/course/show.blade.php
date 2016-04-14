@extends('layouts.main')

@section('content')
    @include('course.show_info', ['course' => $course])
@endsection
