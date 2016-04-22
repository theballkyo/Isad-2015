@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col s8">
            <div id="seat-map">
                <div class="front-indicator center-align">หน้าห้อง</div>
            </div>
            <form method="post" class="right-align">
                {!! csrf_field() !!}
                <input type="hidden" name="seat_id" id="seat_id" value=""/>
                @if(auth()->check())
                    @if($seat_own == null)
                        <button class="btn-large">ยืนยันการจองที่นั่ง</button>
                    @else
                        <button class="btn-large red">ยกเลิกจองที่นั่ง</button>
                        {!! method_field('delete') !!}
                    @endif
                @endif
            </form>
            <p>
                * <div class="seatCharts-seat seatCharts-cell front-seat unavailable">เต็ม</div>
                <div class="seatCharts-seat seatCharts-cell front-seat focused">ว่าง</div>
            <div class="seatCharts-seat seatCharts-cell front-seat focused" style="background-color: rgb(255, 212, 0);">ที่จอง</div>
            </p>
        </div>
        <div class="col s4">@include('course.show_info_bar')</div>
    </div>
@endsection

@section('script_ready')
    @parent
    var firstSeatLabel = 1;
    var seat_id = $('#seat_id');
    var sc = $('#seat-map').seatCharts({
    map: {!! $room->seat->pattern !!},
    seats: {
    a: {
    price   : 99.99,
    classes : 'front-seat' //your custom CSS class
    },

    },

    naming: {
    top: false,
    getLabel : function (character, row, column) {
    return firstSeatLabel++;
    },
    },

    columns: ['A', 'B', 'C', 'D', 'E'],
    click: function () {
    if (this.status() == 'available') {
    if(sc.find('selected').seatIds.length > 0) {
    sc.status(seat_id.val(), 'available');
    }
    seat_id.val(this.settings.id);
    return 'selected';

    } else if (this.status() == 'selected') {
    seat_id.val('');
    return 'available';
    } else if (this.status() == 'unavailable') {
    //seat has been already booked
    return 'unavailable';
    } else {
    return this.style();
    }
    }
    });
    var alertMax = function() {
    sweetAlert("ขออภัย", "เลือกได้ที่นั่งเดียว" + seat_id.val(), "error");
    }
    /*
    Get seats with ids 2_6, 1_7 (more on ids later on),
    put them in a jQuery set and change some css
    */
    sc.get(['{{ $seat_own  }}']).node().css({
    'background-color': '#FFD400'
    });
    sc.status([@foreach($room->seatBook as $seat)
        '{{ $seat->seat_name }}',
    @endforeach], 'unavailable');

    console.log('Seat 1_2 costs ' + sc.get('1_2').data().price + ' and is currently ' + sc.status('1_2'));
    $('.seatCharts-header').remove();
@endsection