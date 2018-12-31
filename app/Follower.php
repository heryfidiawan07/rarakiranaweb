<?php

namespace App;

use App\User;
use App\Menu;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = ['user_id','name','url','class',];

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
