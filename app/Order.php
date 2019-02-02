<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['no_order','cart','user_id','status',];

    public function payment(){
    	return $this->hasOne('App\Payment');
    }
    
}
