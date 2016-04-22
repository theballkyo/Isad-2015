@extends('layouts.member')

@section('member_content')
    <p>
        ยินดีต้อนรับคุณ {{ auth()->user()->first_name }}
    </p>
@endsection