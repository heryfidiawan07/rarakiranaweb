<?php

namespace App;

use App\User;
use App\Menu;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'user_id','menu_id','title','slug','img','description','sticky','status','allowed_comment',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }

}