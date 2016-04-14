<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function scopeOwner($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function isOwner()
    {
        return $this->user_id == auth()->user()->id;
    }

    public function isPayment()
    {
        return $this->payment->status == 1;
    }
}
