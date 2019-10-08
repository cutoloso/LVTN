<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $filterable = [
        'bra',
        'price' => 'price_sale'
    ];
}
