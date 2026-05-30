<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Products::all();

    return view(
        'admin.items.index',
        compact('products')
    );
    }

    /**
     * Show create product form.
     */
    public function create()
    {
        return view('admin.items.create');
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'seller_id' => ['required'],
            'category_id' => ['required'],
            'name' => ['required', 'max:255'],
            'description' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image_url' => ['nullable'],
            'is_active' => ['required'],
        ]);

        Products::create($validated);

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product created successfully.'
            );
    }

    /**
     * Display specified product.
     */
    public function show(Products $product)
    {
        return view(
            'products.show',
            compact('product')
        );
    }

    /**
     * Show edit product form.
     */
    public function edit(Products $product)
    {
        return view(
        'admin.items.edit',
        compact('product')
        );
    }

    /**
     * Update specified product.
     */
    public function update(
        Request $request,
        Products $product
    ) {
        $validated = $request->validate([
            'seller_id' => ['required'],
            'category_id' => ['required'],
            'name' => ['required', 'max:255'],
            'description' => ['required'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image_url' => ['nullable'],
            'is_active' => ['required'],
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product updated successfully.'
            );
    }

    /**
     * Remove specified product.
     */
    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'Product deleted successfully.'
            );
    }
}