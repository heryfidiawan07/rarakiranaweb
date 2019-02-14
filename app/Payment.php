<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['no_invoice', 'order_id','pengirim','resi_img','keterangan','status',];
    //Ongkir ?
    
    public function order(){
    	return $this->belongsTo('App\Order');
    }
    
}
