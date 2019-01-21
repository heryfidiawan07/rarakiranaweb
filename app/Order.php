<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['payment_id', 'no_order', 'cart', 'total_price', 'note', 'kurir', 'services', 'total_weight','user_id',];
}
