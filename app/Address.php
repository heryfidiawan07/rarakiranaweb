<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['name', 'penerima','user_id', 'address', 'kab_id', 'kabupaten', 'kec_id', 'kecamatan',];
}
