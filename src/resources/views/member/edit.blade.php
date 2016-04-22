@extends('layouts.member')

@section('member_content')
    <h3>แก้ไขข้อมูลผู้เรียน</h3>
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s4">
                <input type="text" name="email" id="email" value="{{ $user->email }}">
                <label for="email">อีเมล์</label>
            </div>
            <div class="input-field col s4">
                <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}">
                <label for="first_name">ชื่อจริง</label>
            </div>
            <div class="input-field col s4">
                <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}">
                <label for="last_name">นามสกุล</label>
            </div>
            <button class="btn-large blue waves-light waves-effect">แก้ไขข้อมูลผู้เรียน</button>
        </div>
        {!! csrf_field() !!}
    </form>
@endsection