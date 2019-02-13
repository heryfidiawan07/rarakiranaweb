<?php

namespace App;

use App\User;
use App\Storefront;
use App\Picture;
use App\Review;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id','storefront_id','title','slug','price','discount','weight','dimensi','description','sticky','status','allowed_comment',];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function storefront(){
    	return $this->belongsTo(Storefront::class);
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }

    public function messages(){
        return $this->morphMany('App\Message','messageable');
    }

    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    
}
