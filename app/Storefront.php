<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Storefront extends Model
{
    protected $fillable = ['user_id','name','slug','parent_id','setting','status',];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function products(){
    	return $this->hasMany(Product::class);
    }
    
    public function parent(){
    	return $this->hasMany('App\Storefront', 'parent_id');
    }
    
    public function childs(){
    	return $this->belongsTo('App\Storefront', 'parent_id');
    }

    public function childProducts(){
        return $this->hasManyThrough('App\Product','App\Storefront','parent_id');
    }

}
