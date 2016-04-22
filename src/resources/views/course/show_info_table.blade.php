<table class="striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>ชื่อคอร์ส</th>
            <th>สถานะ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($enrolls as $enroll)
        <tr>
            <td>{{ $enroll->course->id }}</td>
            <td><a href="{{ url('/course/'.$enroll->course->id) }}">{{ $enroll->course->title }}</a></td>
            <td>{{ $enroll->getTextStatus() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>