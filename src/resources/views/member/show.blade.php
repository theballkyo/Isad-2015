@extends('layouts.member')

@section('member_content')
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s4">
                <input placeholder="อีเมล์" type="text" name="email" id="email" value="{{ $user->email }}">
                <label for="email">อีเมล์</label>
            </div>
            <div class="input-field col s4">
                <input placeholder="ชื่อจริง" type="text" name="first_name" id="first_name" value="{{ $user->first_name }}">
                <label for="first_name">ชื่อจริง</label>
            </div>
            <div class="input-field col s4">
                <input placeholder="นามสกุล" type="text" name="last_name" id="last_name" value="{{ $user->last_name }}">
                <label for="last_name">นามสกุล</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="บัตรประชาชน" type="text" name="id_card" id="id_card" value="{{ $user->id_card }}">
                <label for="id_card">บัตรประชาชน</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="วันเกิด" type="text" name="birthday" id="birthday" value="{{ $user->birthday }}">
                <label for="birthday">วันเกิด</label>
            </div>
            <div class="input-field col s12">
                <textarea placeholder="ที่อยู่" class="materialize-textarea" name="address" id="address">{{ $user->address }}</textarea>
                <label for="address">ที่อยู่</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="รหัสผ่าน" type="text" name="password" id="password">
                <label for="password">รหัสผ่าน</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="ยืนยันรหัสผ่าน" type="text" name="password_confirmation" id="password_confirmation">
                <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
            </div>
            <button class="btn-large blue waves-light waves-effect">เพิ่มผู้เรียนใหม่</button>
        </div>
        {!! csrf_field() !!}
    </form>
@endsection