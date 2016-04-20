@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col s8">
            <h4>แจ้งชำระเงิน</h4>
            <form class="col s12" action="{{ url('/payment') }}" method="post">
                <input type="hidden" name="enroll_id" value="{{ $enroll_id }}">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="bank" id="icon_prefix" type="text">
                        <label for="bank">ธนาคาร</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="pay_time" id="icon_prefix" type="text">
                        <label for="pay_time">วันที่/เวลา โอนเงิน</label>
                    </div>
                    <div class="file-field input-field col s12">
                        <div class="btn">
                            <span>File</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="เลือกรูปภาพหลักฐานการชำระเงิน">
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
            @if (count($errors) > 0)
                <p>
                <ul class="collection">
                    @foreach ($errors->all() as $error)
                        <li class="collection-item red accent-3 white-text">{{ $error }}</li>
                    @endforeach
                </ul>
                </p>
            @endif
                <div class="card">
                    <div class="card-image">
                        <img class="img-thumbnail" style="width: 100%" src="{{ asset("imgs/$course->img") }}"/>
                    </div>
                    <div class="card-content">
                        <p>{{ $course->description }}</p>
                    </div>
                    <div class="card-action">
                        อาจารย์ <a class="btn blue"
                                   href="#">{{ $course->teacher->user->first_name }} {{ $course->teacher->user->last_name }}</a><br/>
                        ประเภทคอร์ส: <a class="btn blue-grey" href="#">{{ $course->getTextCourseType() }}</a><br/>
                        ห้องเรียน:
                        <ul class="ul-room">

                            @if($course->rooms->count() < 1)
                                <li>ไม่พบข้อมูลห้องเรียน</li>
                            @endif
                            @foreach($course->rooms as $room)
                                <li class=""><a class="btn orange" href="#">{{ $room->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-action">
                        ราคา: {{ $course->price }} บาท || จำนวนการลงทะเบียนเรียน {{ $course->users->count() }}
                        / {{ $course->max_user }} คน
                    </div>
                </div>
        </div>
    </div>

@endsection
