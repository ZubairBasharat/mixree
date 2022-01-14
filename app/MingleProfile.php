<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MingleProfile extends Model
{
    protected $fillable = [
                    'user_id', 'event_id', 'name', 'image', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
