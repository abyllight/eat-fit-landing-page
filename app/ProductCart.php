<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'product_id', 'quantity', 'total', 'hasPaid', 'payment'
    ];
}
