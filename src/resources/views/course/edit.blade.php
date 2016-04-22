@extends('layouts.member')

@section('member_content')
    <h3>แก้ไขคอร์สเรียนใหม่</h3>
    <form class="col s12" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12">
                <input placeholder="" id="title" name="title" type="text" value="{{ $course->title }}"/>
                <label form="title">ชื่อคอร์สเรียน</label>
            </div>
            <div class="input-field col s12">
                <textarea placeholder="" id="description" name="description" class="materialize-textarea">{{ $course->description }}</textarea>
                <label for="description">รายละเอียดคอร์สเรียน</label>
            </div>
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>เลือกรูปภาพ</span>
                    <input name="img" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input name="img" class="file-path validate" type="text"
                           placeholder="เลือกรูปภาพ">
                </div>
            </div>
            <div class="input-field col s12">
                <select name="teacher_id">
                    <option value="" disabled selected>เลือกอาจารย์ผู้สอน</option>
                    @foreach($teachers as $teacher)
                        <option name="teacher_id"
                                value="{{ $teacher->user_id }}" {{ $course->teacher_id == $teacher->user_id ? 'selected' : '' }}>{{ $teacher->user->first_name }}</option>
                    @endforeach
                </select>
                <label>อาจารย์ผู้สอน</label>
            </div>
            <div class="input-field col s12">
                <select name="room_id[]" multiple>
                    <option value="" disabled selected>เลือกห้องเรียน</option>
                    @foreach($rooms as $room)
                        <option {{ $course->rooms->contains($room->id) ? 'selected' : '' }} name="room_id[]" value="{{ $room->id }}">{{ $room->title }}</option>
                    @endforeach
                </select>
                <label>ห้องเรียน</label>
            </div>
            <div class="input-field col s12">
                <select name="type">
                    <option value="" disabled selected>เลือกประเภทคอร์ส</option>
                    <option {{ $course->type == 1 ? 'selected' : '' }} name="course_type" value="1">สอนสด</option>
                    <option {{ $course->type == 2 ? 'selected' : '' }} name="course_type" value="2">วิดิโอ</option>
                </select>
                <label>ประเภทคอร์ส</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="price" placeholder="ราคา" id="price" value="{{ $course->price }}"/>
                <label for="price">ราคา</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="max_user" placeholder="จำนวนผู้เรียน" value="{{ $course->max_user }}" id="max_user"/>
                <label for="max_user">จำนวนผู้เรียน</label>
            </div>
            <div class="input-field col s6">
                <input  value="{{ $course->start_at }}" id="start_at" name="start_at" class="datepicker" placeholder="วันที่เริ่มเรียน" data-time_24hr=true data-inline="true" data-input>
            </div>
            <div class="input-field col s6">
                <input value="{{ $course->end_at }}" id="end_at" name="end_at" class="datepicker" placeholder="วันสุดท้ายที่เรียน" data-time_24hr=true data-inline="true" data-input>
            </div>

            <div class="input-field col s6">
                <input data-defaultDate="{{ \Carbon\Carbon::createFromFormat('H:i:s', $course->start_time)->toDateTimeString() }}" id="start_time" name="start_time" class="timepicker" placeholder="เวลาเริ่มเรียน" data-time_24hr=true data-inline="true" data-enabletime=true  data-nocalendar=true>
            </div>
            <div class="input-field col s6">
                <input data-defaultDate="{{ \Carbon\Carbon::createFromFormat('H:i:s', $course->end_time)->toDateTimeString() }}" id="end_time" name="end_time" class="timepicker" placeholder="เวลาเลิกเรียน" data-time_24hr=true data-inline="true" data-enabletime=true  data-nocalendar=true>
            </div>

            {!! csrf_field() !!}
            {!! method_field('patch') !!}
            <p></p>
            <button class="btn-large green waves-light waves-effect">แก้ไขคอร์สเรียน</button>
        </div>
    </form>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/flatpickr.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select').material_select();
            flatpickr('.datepicker')
            flatpickr('.timepicker', { dateFormat: 'H:i'});
        });
    </script>
@endsection