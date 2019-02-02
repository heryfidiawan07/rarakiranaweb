<?php

namespace App;

use App\Thread;
use App\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'slug','bio','email','password','admin','social','img','graph','status','token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function admin(){
        if ($this->admin == 1) {
            return true;
        }
        return false;
    }

    public function getImg(){
        return $this->img;
    }

    public function avatar(){
        if($this->getImg()){
            return $this->getImg();
        }else{
            return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm&s=50";
        }
    }

    public function messages(){
        return $this->morphMany('App\Message','messageable');
    }

    public function threads(){
        return $this->hasMany(Thread::class);
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }
    
    public function orders(){
        return $this->hasMany('App\Order');
    }
    
    public function payments(){
        return $this->hasManyThrough('App\Payment','App\Order');
    }
    
}
