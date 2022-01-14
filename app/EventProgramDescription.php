<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventProgramDescription extends Model
{
    protected $fillable = [
            'event_program_details_id','description','program_time'
    ];
}
