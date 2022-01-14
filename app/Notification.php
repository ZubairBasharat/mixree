<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
              'event_id', 'notifiy_by', 'notify_to', 'message'
    ];

    public function notify_by()
    {
        return $this->belongsTo('App\User', 'notifiy_by');
    }
}
