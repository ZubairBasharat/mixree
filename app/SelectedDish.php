<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectedDish extends Model
{
    protected $fillable = [
              'user_id','event_id','event_location_id','platted_dish_id'
    ];
}
