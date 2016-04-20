<?php
namespace App\PaymentComponents;

use App\Enroll;
trait GetEnrollWithLatestPayment
{
    public function getEnrollWithLatestPayment($enroll_id, $user_id = null)
    {
        $enroll = Enroll::where('id', $enroll_id)->first();
        if($enroll->user_id != $user_id)
        {
            return null;
        }

        $enroll->load(['payment' => function($query) {
            $query->latest();
        }, 'course']);

        return $enroll;
    }

}