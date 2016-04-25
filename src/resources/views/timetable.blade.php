@extends('layouts.main')

@section('content')

    <div id='calendar'></div>
    <p class="flow-text">*ตารางของวันที่ {{ \Carbon\Carbon::today()->toDateString() }} - {{ \Carbon\Carbon::today()->addDay(10)->toDateString() }}</p>
@endsection
@section('script')
    @parent
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
                events: [
                    @for($i = 0; $i<10; $i++)
                        @foreach($courses as $course)
                            @if($course->end_at >= $today && $course->on_day[$today->dayOfWeek] == 1)
                            {
                                title: '{{ $course->title }}',
                                start: '{{ $today->toDateString() }}',
                                url: '{{ url('/course/'.$course->id) }}',
                            },
                            @endif
                        @endforeach
                        <?php $today->addDay(); ?>
                    @endfor
                ]
            })

        });
    </script>
@endsection