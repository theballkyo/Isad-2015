@extends('layouts.member')

@section('member_content')
    <table class="striped">
        <thead>
        <tr>
            <th>รหัส</th>
            <th>ชื่อคอร์ส</th>
            <th>แก้ไข</th>
            <th>ลบ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->title }}</td>
                <td><a class="btn green" href="{{ url('/course/' . $course->id . '/edit') }}">แก้ไข</a></td>
                <td><a class="btn red" href="{{ url('/course/' . $course->id . '/delete') }}">ลบ</a></td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection