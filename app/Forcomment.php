<?php

namespace App;

use App\User;
use App\Forum;
use Illuminate\Database\Eloquent\Model;

class Forcomment extends Model
{
    protected $fillable = [
    	'user_id','forum_id','description','status',
    ];

    public function forum(){
    	return $this->belongsTo(Forum::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
