<?php
namespace App\Http\Requests;
/**
 * Created by PhpStorm.
 * User: theba
 * Date: 4/21/2016
 * Time: 12:44 PM
 */
class PaymentRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'bank'     => 'required',
            'pay_time' => 'required',
            'img_file' => 'required|image',
            'img_name' => 'required',
            'note'     => 'max:255'
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