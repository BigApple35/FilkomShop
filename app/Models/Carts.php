<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart_Items;
use App\Models\User;

class Carts extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
    ];

    public function items()
    {
        return $this->hasMany(Cart_Items::class, 'cart_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
