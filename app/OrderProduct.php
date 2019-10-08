<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = "order_product";
    protected $fillable = ['ord_id','pro_id','price','quantity'];
    public $timestamps = false;
}
