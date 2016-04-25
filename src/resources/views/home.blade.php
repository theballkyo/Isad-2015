@extends('layouts.main')

@section('header')
    <div class="parallax-container">
        <div class="parallax"><img src="imgs/home.jpg"></div>
    </div>
@endsection

@section('content')
    <br><br>
    <h1 class="header center orange-text">ระบบโรงเรียนสอนพิเศษ</h1>
    <div class="row center">
        <h5 class="header col s12 light"></h5>
    </div>
    <div class="row center">
        <a href="{{ url('/course') }}" id="download-button" class="btn-large waves-effect waves-light orange">ดูคอร์สทั้งหมด</a>
    </div>
    <br><br>
    <div class="row">

        @include('course.show_card')

    </div>
@endsection
