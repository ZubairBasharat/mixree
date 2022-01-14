<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSingleMenu extends Model
{
    public function get_single_menu_location()
    {
        return $this->belongsTo('App\EventLocation','event_location_id');
    }
}
