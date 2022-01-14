<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventFashion extends Model
{
    protected $fillable = [
        'user_id','event_id','type','name','description','image','price', 'link','date'
    ];
}
