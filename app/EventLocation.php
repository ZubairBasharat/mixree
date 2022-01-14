<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    protected $fillable = [
        'user_id','event_id','event_detail_id','name','address'
    ];

    public function get_single_menus()
    {
        return $this->hasMany('App\EventSingleMenu');
    }
    public function get_platted_menu()
    {
        return $this->hasMany('App\PlattedDishName');
    }
    public function paired_meal_names()
    {
        return $this->hasMany('App\PairedMealName');
    }

    public function event_program_details()
    {
        return $this->hasMany('App\EventProgramDetail');
    }
}
