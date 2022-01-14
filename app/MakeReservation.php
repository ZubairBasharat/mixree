<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MakeReservation extends Model
{
    protected $fillable = [
           'event_id','user_id','person','event_date','booked_person','message_to_owner'
    ];
}
