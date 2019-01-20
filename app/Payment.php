<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['address_id', 'pengirim', 'resi', 'total_price', 'note', 'kurir', 'services', 'total_weight', 'user_id', 'status',];
}
