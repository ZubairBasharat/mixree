<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlattedDishName extends Model
{
    protected $fillable = [
             'user_id','event_id','event_location_id','dish_name'
    ];
    function platted_items()
    {
        return $this->hasMany('App\PlattedDishItem');
    }
}
