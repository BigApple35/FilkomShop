<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'seller_profiles';

    protected $fillable = [
        'user_id',
        'shop_name',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}