<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MingleRequest extends Model
{
    Protected $fillable = [
                'event_id', 'requested_to', 'requested_by'
    ];

    public function requested_by()
    {
        return $this->belongsTo('App\MingleProfile', 'requested_by');
    }
}
