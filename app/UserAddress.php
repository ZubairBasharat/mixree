<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
       'user_id','address','city','state','zip_code'
    ];
}
