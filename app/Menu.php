<?php

namespace App;

use App\User;
use App\Post;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['user_id','name','slug','parent_id','setting','status',];

    public function posts(){
    	return $this->hasMany(Post::class);
    }
    
    public function parent(){
    	return $this->hasMany('App\Menu', 'parent_id');
    }
    
    public function childs(){
    	return $this->belongsTo('App\Menu', 'parent_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function childPosts(){
        return $this->hasManyThrough('App\Post','App\Menu','parent_id');
    }

}
