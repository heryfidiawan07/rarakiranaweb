<?php

namespace App;

use App\User;
use App\Forum;
use App\Article;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['user_id','menu','slug','parent_id','setting','status',];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function parent(){
    	return $this->hasMany('App\Menu', 'parent_id');
    }

    public function childs(){
    	return $this->belongsTo('App\Menu', 'parent_id');
    }

    public function childArticles(){
        return $this->hasManyThrough('App\Article','App\Menu', 'parent_id');
    }

    public function childProducts(){
        return $this->hasManyThrough('App\Product','App\Menu', 'parent_id');
    }

    public function childForums(){
        return $this->hasManyThrough('App\Forum','App\Menu', 'parent_id');
    }

    public function articles(){
    	return $this->hasMany(Article::class);
    }
    
    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function forums(){
        return $this->hasMany(Forum::class);
    }
    
}
