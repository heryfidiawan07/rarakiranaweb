<?php

namespace App;

use App\User;
use App\Gallery;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['user_id','setting','status',];
    //Promo setting 1 = Home Logo/Main 2 = Post Logo 3 = Thread Logo 4 = Product Logo
    public function galleries(){
    	return $this->hasMany(Gallery::class);
    }
    
    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
