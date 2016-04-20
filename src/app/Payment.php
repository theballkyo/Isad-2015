<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function enroll()
    {
        $this->belongsTo('App\Enroll');
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
