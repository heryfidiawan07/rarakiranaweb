<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = ['user_id','title','description','img','setting',];
    
    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
