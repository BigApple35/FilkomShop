<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart_Items;

class Carts extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany(Cart_Items::class, 'cart_id');
    }
}
