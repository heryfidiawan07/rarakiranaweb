<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['name','penerima', 'address', 'kab_id', 'kabupaten', 'kec_id', 'kecamatan','user_id',];
}
