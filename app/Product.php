<?php

namespace App;

use App\User;
use App\Menu;
use App\Gallery;
use App\Prodcomment;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'user_id','title','slug','price','discount','menu_id','description','status','allowed_comment',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
    public function prodcomments(){
    	return $this->hasMany(Prodcomment::Class);
    }
    
    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function galleries(){
        return $this->hasMany(Gallery::class);
    }
    
}
