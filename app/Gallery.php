<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['img','product_id',];

    public function products(){
    	return $this->belongsTo(Product::class);
    }

}
