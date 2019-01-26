<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['address_id', 'order_id','pengirim','resi','total_price','total_weight','note','kurir','services','status',];
}
