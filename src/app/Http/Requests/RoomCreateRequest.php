<?php
namespace App\Http\Requests;

class RoomCreateRequest extends Request
{

    public function rules()
    {
        return [

        ];
    }

    public function messages()
    {
        return [
            'bank.required' => 'กรุณาเลือกธนาคาร',
            'pay_time.required'  => 'กรุณาระบุเวลาที่โอนเงิน',
            'pay_time.date' => 'ระบุเวลาที่โอนเงินให้ถูกต้อง',
            'img_file.required' => 'กรุณาเลือกภาพหลักฐานการโอนเงิน',
            'img_file.image' => 'ต้องเป็นไฟล์ภาพเท่านั้น',
            'img_name.required' => 'กรุณาเลือกภาพหลักฐานการโอนเงิน',
            'note.max' => 'หมายเหตุห้ามเกิน :max ตัวอักษร'
        ];
    }
}