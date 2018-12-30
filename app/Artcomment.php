<?php

namespace App;

use App\User;
use App\Article;
use Illuminate\Database\Eloquent\Model;

class Artcomment extends Model
{
    protected $fillable = [
    	'user_id','article_id','description','status',
    ];

    public function article(){
    	return $this->belongsTo(Article::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
