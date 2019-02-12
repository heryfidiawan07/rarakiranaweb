<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id','messageable_id','messageable_type','description','setting','status',];
    //messageable_type = App/User / App/product
    public function messageable(){
    	return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
    

}
