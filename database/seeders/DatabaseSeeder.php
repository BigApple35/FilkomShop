<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Products::query()->delete();
        
        Products::create([
            'seller_id' => 1,
            'category_id' => 1,
            'name' => 'Mechanical Keyboard',
            'description' => 'RGB mechanical keyboard for gaming.',
            'price' => 850000,
            'stock' => 15,
            'image_url' => null,
            'is_active' => true,
        ]);

        Products::create([
            'seller_id' => 1,
            'category_id' => 1,
            'name' => 'Wireless Mouse',
            'description' => 'Ergonomic wireless mouse.',
            'price' => 250000,
            'stock' => 30,
            'image_url' => null,
            'is_active' => true,
        ]);

        Products::create([
            'seller_id' => 1,
            'category_id' => 1,
            'name' => 'Gaming Headset',
            'description' => 'Surround sound gaming headset.',
            'price' => 450000,
            'stock' => 10,
            'image_url' => null,
            'is_active' => true,
        ]);

        Products::create([
            'seller_id' => 1,
            'category_id' => 1,
            'name' => 'Laptop Stand',
            'description' => 'Adjustable aluminum laptop stand.',
            'price' => 175000,
            'stock' => 25,
            'image_url' => null,
            'is_active' => true,
        ]);

        Products::create([
            'seller_id' => 1,
            'category_id' => 1,
            'name' => 'USB Hub',
            'description' => 'Multiport USB hub with HDMI support.',
            'price' => 320000,
            'stock' => 12,
            'image_url' => null,
            'is_active' => true,
        ]);
    }
}