<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Cart_Items extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
