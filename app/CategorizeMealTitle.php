<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorizeMealTitle extends Model
{
   public function categorize_meal_pairs()
   {
       return $this->hasMany('App\CategorizeMealPaires');
   }
}
