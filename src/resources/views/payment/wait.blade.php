@extends('layouts.member')

@section('member_content')
    <table class="striped centered">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อคอร์ส</th>
                <th>ธนาคาร</th>
                <th>เวลา</th>
                <th>ภาพสลิปโอนเงิน</th>
                <th>ชื่อผู้ใช้งาน</th>
                <th>ยืนยัน</th>
                <th>ปฎิเสธ</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->enroll->course->title }}</td>
                <td>{{ $payment->bank }}</td>
                <td>{{ $payment->pay_time }}</td>
                <td><a href="{{ asset('imgs/payments/'.$payment->id . '.jpg') }}" target="_blank">คลิกเพื่อดูภาพ</a></td>
                <td><a href="{{ url('/member/' . $payment->enroll->user_id . '/edit')  }}">{{ $payment->enroll->user->first_name }}</a></td>
                <td><a class="btn green" href="{{ url('payment/' . $payment->id . '/approve') }}">Approve</a></td>
                <td><a class="btn red" href="{{ url('payment/' . $payment->id . '/reject') }}">Reject</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection