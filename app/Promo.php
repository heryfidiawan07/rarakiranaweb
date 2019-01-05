<?php

namespace App;

use App\Picture;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['user_id','setting','status',];

    public function pictures(){
    	return $this->hasMany(Picture::class);
    }
    
}
