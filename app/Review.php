<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id','product_id','description','setting','status',];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
