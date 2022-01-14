<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PairedMealName extends Model
{
    protected $fillable = [
        'user_id','event_id','event_location_id','name'
    ];
    public function food_ids()
    {
        return $this->hasMany('App\PairedMealFoodId', 'paired_meal_name_id');
    }
}
