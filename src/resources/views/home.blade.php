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

        @include('course.show_card')

    </div>
@endsection
