<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id','type', 'days', 'collect_info','need_reservation', 'event_code', 'gift', 'registry', 'fashion','start_date_event'
    ];
    
    function event_details()
    {
        return $this->hasOne('App\EventDetail');
    }
    
    function event_fashions()
    {
        return $this->hasMany('App\EventFashion');
    }
    
    function event_gifts()
    {
        return $this->hasMany('App\EventGift');
    }
    
    function event_locations()
    {
        return $this->hasMany('App\EventLocation');
    }
    
    function event_registries()
    {
        return $this->hasMany('App\EventRegistry');
    }
    
    function event_reservations()
    {
        return $this->hasOne('App\EventReservation');
    }

    function get_event_reservations()
    {
        return $this->hasMany('App\EventReservation', 'event_id');
    }

    function event_participants()
    {
        return $this->hasMany('App\EventParticipant');
    }
    function witnesses()
    {
        return $this->hasMany('App\Witneess');
    }
}
