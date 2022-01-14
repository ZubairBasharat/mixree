<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareContactInformation extends Model
{
    protected $fillable = [
        'event_id','user_id','address_id'
    ];
}
