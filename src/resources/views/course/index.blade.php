@extends('layouts.main')

@section('content')
    <div class="row">@foreach($courses as $course)
            @include('course.show_card', ['course' => $course])
        @endforeach
    </div>

@endsection
