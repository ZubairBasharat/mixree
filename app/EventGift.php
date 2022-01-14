<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventGift extends Model
{
    protected $fillable = [
        'user_id','event_id','payment_type','payment_image','name_of_bank','name_of_account','account_number','payment_email','gift','registry'
    ];
}
