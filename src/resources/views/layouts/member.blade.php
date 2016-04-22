@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col s4">
            @if(auth()->user()->isStudent())
                @include('menu.member')
            @elseif(auth()->user()->isManager())
                @include('menu.manager')
            @endif
        </div>
        <div class="col s8">
            @yield('member_content')
        </div>
    </div>
@endsection