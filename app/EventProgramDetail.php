<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventProgramDetail extends Model
{
    protected $fillable = [
         'user_id','event_id','event_location_id','program_location_bit'
    ];

    public function event_program_description()
    {
        return $this->hasMany('App\EventProgramDescription','event_program_details_id');
    }
}
