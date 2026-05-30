<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\User;

class Seller extends Model
{
    protected $table = 'seller_profiles';

    protected $fillable = [
        'user_id',
        'shop_name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'seller_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
