<?php

namespace App;

use App\User;
use App\Menu;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = ['user_id','title','description','img','menu_id',];

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
