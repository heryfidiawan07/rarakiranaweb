<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['payment_id', 'no_order', 'product_id', 'qty', 'price', 'user_id',];
}
