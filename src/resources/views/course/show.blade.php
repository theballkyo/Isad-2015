@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col s12">
            @if(session('error'))
                <h4 class="red accent-3 white-text center-align">{{ session('error') }}</h4>
            @endif
        </div>
    </div>
    @include('course.show_info')
@endsection
