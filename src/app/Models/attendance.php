<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_start_time',
        'work_end_time',
        'work_time',
        'date',
    ];

    public function scopeUser_idSearch($query, $user_id)
    {
        if (!empty($user_id)) {
            $query->where('user_id', '=',  $user_id );
        }
    }
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->where('date', '=',  $date );
        }
    }
}
