<?php

namespace App;

use App\Tag;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = ['user_id','tag_id','title','slug','description','sticky','status','allowed_comment',];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function tag(){
    	return $this->belongsTo(Tag::class);
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }

}
