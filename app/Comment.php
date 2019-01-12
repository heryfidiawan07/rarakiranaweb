<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id','commentable_id','commentable_type','description','status',];

    public function commentable(){
    	return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
