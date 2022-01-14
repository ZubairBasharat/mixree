<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetailsTable extends Model
{
    protected $fillable = [
                'user_id','event_id','order_id','product_id','product_quantity','total_price'
    ];

    public function product()
    {
        return $this->belongsTo('App\EventFashion');
    }
}
