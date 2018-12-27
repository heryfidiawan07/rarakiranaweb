<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password', 'admin', 'social', 'img', 'graph', 'status','token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function forums(){
        return $this->hasMany(Forum::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function discusions(){
        return $this->hasMany(Discusion::class);
    }

}
