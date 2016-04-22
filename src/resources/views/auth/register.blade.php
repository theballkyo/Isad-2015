@extends('layouts.main')

@section('content')
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s4">
                <input placeholder="อีเมล์" type="text" name="email" id="email">
                <label for="email">อีเมล์</label>
            </div>
            <div class="input-field col s4">
                <input placeholder="ชื่อจริง" type="text" name="first_name" id="first_name">
                <label for="first_name">ชื่อจริง</label>
            </div>
            <div class="input-field col s4">
                <input placeholder="นามสกุล" type="text" name="last_name" id="last_name">
                <label for="last_name">นามสกุล</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="บัตรประชาชน" type="text" name="id_card" id="id_card">
                <label for="id_card">บัตรประชาชน</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="วันเกิด" type="text" name="birthday" id="birthday">
                <label for="birthday">วันเกิด</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="โรงเรียน" type="text" name="school" id="school">
                <label for="school">โรงเรียน</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="ระดับชั้น" type="text" name="level" id="level">
                <label for="level">ระดับชั้น</label>
            </div>
            <div class="input-field col s12">
                <textarea placeholder="ที่อยู่" class="materialize-textarea" name="address" id="address"></textarea>
                <label for="address">ที่อยู่</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="รหัสผ่าน" type="password" name="password" id="password">
                <label for="password">รหัสผ่าน</label>
            </div>
            <div class="input-field col s6">
                <input placeholder="ยืนยันรหัสผ่าน" type="password" name="password_confirmation" id="password_confirmation">
                <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
            </div>
            <button class="btn-large blue waves-light waves-effect">สมัครสมาชิก</button>
        </div>
        {!! csrf_field() !!}
    </form>

@endsection
