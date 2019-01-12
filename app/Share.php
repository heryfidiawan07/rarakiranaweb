<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = ['user_id','name','url','class',];

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
