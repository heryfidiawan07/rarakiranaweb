<?php

namespace App;

use App\User;
use App\Menu;
use App\Artcomment;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
    	'user_id','title','slug','menu_id','img','description','sticky','status','allowed_comment',
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
    public function artcomments(){
    	return $this->hasMany(Artcomment::Class);
    }
    
    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

}
