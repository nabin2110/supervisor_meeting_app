<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $table='meetings';
    protected $fillable=[
        'meeting_subject',
        'meeting_time',
        'reminder_minutes'
    ];
}
