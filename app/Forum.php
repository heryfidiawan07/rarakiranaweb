<?php

namespace App;

use App\User;
use App\Menu;
use App\Forcomment;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['user_id','title','slug','menu_id','description','status',];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function forcomments(){
    	return $this->hasMany(Forcomment::Class);
    }
    
}
