<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $fillable = ['user_id','subject','email','description',];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
