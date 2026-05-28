<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductManagementController extends Controller
{
    public function index()
    {
        $products = Products::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        Products::create([

            'seller_id' => 1,
            'category_id' => null,

            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_url' => $request->image_url,
            'is_active' => true,

        ]);

        return redirect('/admin/products');
    }

    public function edit($id)
    {
        $product = Products::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $product->update([

            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image_url' => $request->image_url,

        ]);

        return redirect('/admin/products');
    }

    public function delete($id)
    {
        Products::findOrFail($id)->delete();

        return redirect('/admin/products');
    }
}
