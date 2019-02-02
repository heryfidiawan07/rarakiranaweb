<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id','messageable_id','messageable_type','description','setting','status',];
    //messageable_type = user_id(antar user) / product_id
    public function messageable(){
    	return $this->morphTo();
    }

}
