<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $products = Products::where('is_active', true)

            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })

            ->latest()
            ->get();

        return view('storefront.home', compact('products'));
    }

    public function show($id)
    {
        $product = Products::with(['reviews.user', 'seller.user'])->findOrFail($id);

        return view('storefront.detail', compact('product'));
    }

    public function store($sellerId)
{
    $products = Products::where('seller_id', $sellerId)
        ->where('is_active', true)
        ->get();

    $seller = $products->first()?->seller;

    return view('storefront.store', compact('products', 'seller'));
}
}
