<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['name','penerima', 'address', 'kab_id', 'kabupaten', 'kec_id', 'kecamatan','postal_code','phone','user_id',];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    
}
