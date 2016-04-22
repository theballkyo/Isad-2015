<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}