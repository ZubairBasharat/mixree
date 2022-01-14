<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Prophecy\Exception\Doubler\ReturnByReferenceException;

class OrdersTable extends Model
{
    protected $fillable = [
          'user_id', 'event_id', 'total_price', 'payment_id'
    ];

    public function orders()
    {
        return $this->hasMany('App\OrderDetailsTable','order_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
