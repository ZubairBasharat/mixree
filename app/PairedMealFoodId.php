<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PairedMealFoodId extends Model
{
    protected $fillable = [
        'paired_meal_name_id','food_id'
    ];
}
