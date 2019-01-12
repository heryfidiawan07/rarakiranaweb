<?php

namespace App;

use App\User;
use App\Thread;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['user_id','name','slug','parent_id','setting','status',];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function threads(){
    	return $this->hasMany(Thread::class);
    }
    
    public function parent(){
    	return $this->hasMany('App\Tag', 'parent_id');
    }
    
    public function childs(){
    	return $this->belongsTo('App\Tag', 'parent_id');
    }

    public function childThreads(){
        return $this->hasManyThrough('App\Thread','App\Tag','parent_id');
    }

}
