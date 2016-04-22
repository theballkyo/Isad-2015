<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;

    public function enroll()
    {
        return $this->belongsTo('App\Enroll');
    }

    public function isWait()
    {
        return $this->status == 1;
    }

    public function setWait()
    {
        $this->status = 1;
    }

    public function isReject()
    {
        return $this->status == 2;
    }

    public function setReject()
    {
        $this->status = 2;
    }

    public function isApprove()
    {
        return $this->status == 3;
    }

    public function setApprove()
    {
        $this->status = 3;
    }

    public function getTextStatus()
    {
        switch ($this->status) {
            case 1:
                return 'รอการตรวจสอบ';
            case 2:
                return 'ข้อมูลไม่ถูกต้อง';
            case 3:
                return 'ข้อมูลถูกต้อง';
            default:
                return 'Unknown';
        }
    }

    public function scopeWait($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOwner($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopeApprove($query)
    {
        return $query->where('status', 3);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
