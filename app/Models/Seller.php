<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Seller extends Model
{
    protected $table = 'seller_profiles';

    public function products()
    {
        return $this->hasMany(Products::class, 'seller_id');
    }
}
