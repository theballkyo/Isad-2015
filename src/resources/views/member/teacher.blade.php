@extends('layouts.member')

@section('member_content')
    <table class="striped centered">
        <thead>
        <tr>
            <th>รหัส</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>

        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td><a class="btn" href="{{ url('/timetable/' . $user->id) }}">ดูตารางสอน</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection