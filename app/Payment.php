<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['address_id', 'pengirim', 'resi', 'status',];   
    
}
