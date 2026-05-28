<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Carts;
use App\Models\Products;

class Cart_Items extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    public function cart()
    {
        return $this->belongsTo(Carts::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
