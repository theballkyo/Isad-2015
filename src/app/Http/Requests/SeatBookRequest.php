<?php
namespace App\Http\Requests;

class SeatBookRequest extends Request
{

    public function rules()
    {
        return [
            'seat_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'seat_id.required' => 'กรุณาเลือกที่นั่งด้วย',
        ];
    }
}