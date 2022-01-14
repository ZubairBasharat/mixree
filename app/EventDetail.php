<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
    protected $fillable = [
        'user_id','event_id','eve_name','icon','groom_img','groom_first_name','groom_last_name', 'bride_img','bride_first_name','bride_last_name','guest_note','story','bg_img','no_of_days','no_of_witness'
    ];
}
