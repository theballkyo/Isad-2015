@extends('layouts.member')

@section('member_content')
    <table class="striped">
        <thead>
        <tr>
            <th>รหัส</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>แก้ไข</th>
            <th>ลบ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td><a class="btn green" href="{{ url('/manager/' . $user->id . '/edit') }}">แก้ไข</a></td>
                <td><a class="btn red" href="{{ url('/manager/' . $user->id . '/delete') }}">ลบ</a></td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection