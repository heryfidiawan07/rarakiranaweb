<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $fillable = ['name','number','bank','user_id',];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    
}
