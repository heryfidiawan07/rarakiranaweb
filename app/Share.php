<?php

namespace App;

use App\User;
use App\Menu;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = ['user_id','url','name','class',];

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
