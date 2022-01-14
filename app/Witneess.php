<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Witneess extends Model
{
    protected $fillable = [
            'user_id','event_id','first_name','last_name','biography','witness_type','witness_image'
    ];
}
