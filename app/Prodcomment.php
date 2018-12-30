<?php

namespace App;

use App\User;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Prodcomment extends Model
{
    protected $fillable = [
    	'user_id','product_id','description','status',
    ];

    public function product(){
    	return $this->belongsTo(Product::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
