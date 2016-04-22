@extends('layouts.main')

@section('content')
    @if(session('error'))
        <input type="hidden" id="error" value="{{ session('error') }}" />
    @endif
    @include('course.show_info')
    @if(session('msg') == 'pay_send')
    <script>swal("ข้อความ", "{{ trans('pay_send') }}", "success")</script>
    @endif
@endsection
