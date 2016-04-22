@extends('layouts.member')

@section('member_content')
    <h3>แก้ไขห้องเรียน</h3>
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="title" id="title" value="{{ $room->title }}">
                <label for="title">ชื่อห้อง</label>
            </div>
            <div class="input-field col s12">
                <textarea name="pattern" id="pattern" class="materialize-textarea">{{ $room->seat->pattern }}</textarea>
                <label for="pattern">รูปแบบห้องเรียน</label>
            </div>
            <button class="btn-large blue waves-light waves-effect">แก้ไขห้องเรียน</button>
        </div>
        {!! csrf_field() !!}
    </form>
@endsection