@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col s8">
            <h4>แจ้งชำระเงิน</h4>
            @if (count($errors) > 0)
                <p>
                <ul class="collection">
                    @foreach ($errors->all() as $error)
                        <li class="collection-item red accent-3 white-text">{{ $error }}</li>
                    @endforeach
                </ul>
                </p>
            @endif
            <form class="col s12" action="{{ url('/payment') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="enroll_id" value="{{ $enroll_id }}">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="bank" id="icon_prefix" type="text">
                        <label for="bank">โอนเข้าธนาคาร *</label>
                    </div>
                    <div class="input-field col s12">
                        <span class="flow-text">วันที่/เวลาโอนเงิน</span>
                        <input class="datetimepicker" data-inline="true" data-enabletime="true" data-time_24hr="true" name="pay_time" id="icon_prefix" type="hidden">
                    </div>

                    <div class="file-field input-field col s12">
                        <div class="btn">
                            <span>File</span>
                            <input name="img_file" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input name="img_name" class="file-path validate" type="text"
                                   placeholder="เลือกรูปภาพหลักฐานการชำระเงิน *">
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">vpn_key</i>
                        <input name="note" id="icon_vpn_key" type="text">
                        <label for="note">หมายเหตุ</label>
                    </div>
                    <button class="col s3 offset-s9 btn waves-effect waves-light right" type="submit" name="action">
                        แจ้งชำระเงิน
                        <i class="material-icons right">send</i>
                    </button>
                </div>
                {!! csrf_field() !!}
            </form>
        </div>
        <div class="col s4">
            @include('course.show_info_bar')
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('js/flatpickr.min.js') }}"></script>
    <script>
        flatpickr('.datetimepicker', { dateFormat: 'Y-m-d H:i', maxDate: new Date() + 1});
    </script>
@endsection
