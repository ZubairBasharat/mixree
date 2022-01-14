<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventReservation extends Model
{
    protected $fillable = [
        'user_id','event_id','start_date',
    ];
}
