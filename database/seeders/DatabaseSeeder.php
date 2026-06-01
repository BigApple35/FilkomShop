<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Hapus data lama products
        Products::query()->delete();

        /*
        |--------------------------------------------------------------------------
        | CATEGORY DUMMY
        |--------------------------------------------------------------------------
        */

        $category = Categories::firstOrCreate(
            ['slug' => 'electronics'],
            [
                'name' => 'Electronics',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | ADMIN DUMMY
        |--------------------------------------------------------------------------
        */

        $admin = User::firstOrCreate(
            ['email' => 'admin@filkomshop.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | SELLER DUMMY
        |--------------------------------------------------------------------------
        */

        $sellerUser = User::firstOrCreate(
            ['email' => 'seller@filkomshop.com'],
            [
                'name' => 'Seller',
                'password' => Hash::make('password'),
                'role' => 'seller',
            ]
        );

        $seller = Seller::firstOrCreate(
            ['user_id' => $sellerUser->id],
            [
                'shop_name' => 'Filkom Official Store',
                'description' => 'Official seller account',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS DUMMY
        |--------------------------------------------------------------------------
        */

        Products::create([
            'seller_id' => $seller->id,
            'category_id' => $category->id,
            'name' => 'Mechanical Keyboard',
            'description' => 'RGB mechanical keyboard for gaming.',
            'price' => 850000,
            'stock' => 15,
            'image_url' => null,
            'is_active' => true,
        ]);

        Products::create([
            'seller_id' => $seller->id,
            'category_id' => $category->id,
            'name' => 'Wireless Mouse',
            'description' => 'Ergonomic wireless mouse.',
            'price' => 250000,
            'stock' => 30,
            'image_url' => null,
            'is_active' => true,
        ]);

        Products::create([
            'seller_id' => $seller->id,
            'category_id' => $category->id,
            'name' => 'Gaming Headset',
            'description' => 'Surround sound gaming headset.',
            'price' => 450000,
            'stock' => 10,
            'image_url' => null,
            'is_active' => true,
        ]);

        Products::create([
            'seller_id' => $seller->id,
            'category_id' => $category->id,
            'name' => 'Laptop Stand',
            'description' => 'Adjustable aluminum laptop stand.',
            'price' => 175000,
            'stock' => 25,
            'image_url' => null,
            'is_active' => true,
        ]);

        Products::create([
            'seller_id' => $seller->id,
            'category_id' => $category->id,
            'name' => 'USB Hub',
            'description' => 'Multiport USB hub with HDMI support.',
            'price' => 320000,
            'stock' => 12,
            'image_url' => null,
            'is_active' => true,
        ]);
    }
}