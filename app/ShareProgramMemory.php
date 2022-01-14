<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareProgramMemory extends Model
{
    protected $fillable = [
                   'user_id','event_id','memory_id','event_location_id','event_program_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function program()
    {
        return $this->belongsTo('App\EventProgramDescription','event_program_id');
    }
}
