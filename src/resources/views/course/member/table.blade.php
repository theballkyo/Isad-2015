@extends('layouts.member')
@section('member_content')
        @include('course.show_info_table', compact('courses'))
@endsection