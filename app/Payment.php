<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['no_invoice','address_id', 'order_id','pengirim','resi','total_price','total_weight','total_qty','note','kurir','services','ongkir','status',];
    //Ongkir ?
    public function address(){
    	return $this->belongsTo('App\Address');
    }
    
}
