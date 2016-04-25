@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col s8">
            <div id="seat-map">
                <div class="front-indicator center-align">หน้าห้อง</div>
            </div>
            <p>
                * <div class="seatCharts-seat seatCharts-cell front-seat unavailable">เต็ม</div>
            <div class="seatCharts-seat seatCharts-cell front-seat focused">ว่าง</div>
            <div class="seatCharts-seat seatCharts-cell front-seat focused" style="background-color: rgb(255, 212, 0);">ที่จอง</div>
            </p>
        </div>
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



    console.log('Seat 1_2 costs ' + sc.get('1_2').data().price + ' and is currently ' + sc.status('1_2'));
    $('.seatCharts-header').remove();
@endsection