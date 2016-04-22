<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
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