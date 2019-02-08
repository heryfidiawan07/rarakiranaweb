<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['no_order','address_id','cart','kurir_resi','total_price','total_weight','total_qty','note','kurir','services','ongkir','user_id','status',];

    public function address(){
    	return $this->belongsTo('App\Address');
    }

    public function payment(){
    	return $this->hasOne('App\Payment');
    }
    
}
