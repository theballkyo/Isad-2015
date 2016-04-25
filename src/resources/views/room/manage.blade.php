@extends('layouts.member')

@section('member_content')
    <table class="striped">
        <thead>
        <tr>
            <th>รหัส</th>
            <th>ชื่อห้อง</th>
            <th>ดูห้องเรียน</th>
            <th>แก้ไข</th>
            <th>ลบ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rooms as $room)
            <tr>
                <td>{{ $room->id }}</td>
                <td>{{ $room->title }}</td>
                <td><a class="btn green" href="{{ url('/room/'. $room->id) }}">ดูห้องเรียน</a></td>
                <td><a class="btn blue" href="{{ url('/room/' . $room->id . '/edit') }}">แก้ไข</a></td>
                <td><a class="btn red" href="{{ url('/room/' . $room->id . '/delete') }}">ลบ</a></td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection