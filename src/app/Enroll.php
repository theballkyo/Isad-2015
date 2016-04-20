<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    /**
     * Enroll status column detail
     * 1 is enrolled and wait for payment
     * 2 is payment and wait for approve
     * 3 is approve
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    /**
     * Get latest payment info of user is login.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOwner($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWaitForPayment($query)
    {
        return $query->where('status', 1);
    }

    /**
     * @return bool
     */
    public function isOwner()
    {
        return $this->user_id == auth()->user()->id;
    }

    /**
     * @return bool
     */
    public function isWait()
    {
        return $this->status == 1;
    }

    /**
     * @return bool
     */
    public function isCheck()
    {
        return $this->status == 2;
    }

    /**
     * @return int
     */
    public function isApprove()
    {
        return $this->status == 3;
    }

}
