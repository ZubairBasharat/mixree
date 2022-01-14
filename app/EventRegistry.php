<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRegistry extends Model
{
    protected $fillable = [
        'user_id','event_id','name','link'
    ];
}
