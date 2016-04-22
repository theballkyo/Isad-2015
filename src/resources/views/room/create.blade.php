@extends('layouts.member')

@section('member_content')
    <h3>สร้างห้องเรียนใหม่</h3>
    <form class="col s12" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="title" id="title">
                <label for="title">ชื่อห้อง</label>
            </div>
            <div class="input-field col s12">
                <textarea name="pattern" id="pattern" class="materialize-textarea"></textarea>
                <label for="pattern">รูปแบบห้องเรียน</label>
            </div>
            <button class="btn-large blue waves-light waves-effect">สร้างห้องใหม่</button>
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