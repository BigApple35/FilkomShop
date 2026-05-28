<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $products = Products::query()
                ->when($request->search, function ($query) use ($request) {
                    $query->where(
                        'name',
                        'like',
                        '%' . $request->search . '%'
                    );
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            return view('welcome', [
                'page' => 'admin-products',
                'products' => $products,
            ]);
        }

        $products = Products::query()
            ->where('is_active', true)
            ->when($request->search, function ($query) use ($request) {
                $query->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                );
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('welcome', [
            'page' => 'storefront',
            'products' => $products,
        ]);
    }

    public function create()
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'seller'])) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        return view('welcome', [
            'page' => 'admin-product-form',
            'categories' => Categories::all(),
            'sellers' => Auth::user()->role === 'admin' ? Seller::all() : null,
        ]);
    }

    public function store(Request $request)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'seller'])) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'nullable|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'seller_id' => 'nullable|exists:seller_profiles,id',
        ]);

        $sellerId = $this->resolveSellerId($request);
        if (!$sellerId) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        $productData = [
            'seller_id' => $sellerId,
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_active' => $validated['is_active'] ?? true,
        ];

        $imageUrls = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imageUrls[] = Storage::url($path);
            }
        }

        if (count($imageUrls) > 0) {
            $productData['image_urls'] = $imageUrls;
            $productData['image_url'] = $imageUrls[0];
        }

        $product = Products::create($productData);

        return redirect()
            ->route('admin.products.show', $product->id)
            ->with('success', 'Product created successfully.');
    }

    public function edit(Products $products)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'seller'])) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        return view('welcome', [
            'page' => 'admin-product-form',
            'productDetail' => $products,
            'categories' => Categories::all(),
            'sellers' => Auth::user()->role === 'admin' ? Seller::all() : null,
        ]);
    }

    public function update(Request $request, Products $products)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'seller'])) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_active' => 'nullable|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'seller_id' => 'nullable|exists:seller_profiles,id',
        ]);

        $sellerId = $this->resolveSellerId($request);
        if (!$sellerId) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        $products->seller_id = $sellerId;
        $products->category_id = $validated['category_id'] ?? null;
        $products->name = $validated['name'];
        $products->description = $validated['description'] ?? null;
        $products->price = $validated['price'];
        $products->stock = $validated['stock'];
        $products->is_active = $validated['is_active'] ?? true;

        $imageUrls = $products->image_urls ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imageUrls[] = Storage::url($path);
            }
        }

        if (count($imageUrls) > 0) {
            $products->image_urls = $imageUrls;
            if (!$products->image_url) {
                $products->image_url = $imageUrls[0];
            }
        }

        $products->save();

        return redirect()
            ->route('admin.products.show', $products->id)
            ->with('success', 'Product updated successfully.');
    }

    private function resolveSellerId(Request $request): ?int
    {
        if (Auth::user()->role === 'seller') {
            $seller = Seller::where('user_id', Auth::id())->first();
            return $seller ? $seller->id : null;
        }

        if (Auth::user()->role === 'admin') {
            return $request->input('seller_id');
        }

        return null;
    }

    public function show(Products $products)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'seller'])) {
            $allProducts = Products::latest()
                ->paginate(10);

            return view('welcome', [
                'page' => 'admin-products',
                'products' => $allProducts,
                'productDetail' => $products,
            ]);
        }

        return view('welcome', [
            'page' => 'product-detail',
            'productDetail' => $products,
        ]);
    }

    public function destroy(Products $products)
    {
        if (
            !Auth::check() ||
            Auth::user()->role !== 'admin'
        ) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        $products->delete();

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Product deleted successfully.'
            );
    }

    public function uploadImage(Request $request, Products $products)
    {
        if (
            !Auth::check() ||
            !in_array(Auth::user()->role, ['admin', 'seller'])
        ) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        $request->validate([
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $path = $request->file('image')->store('products', 'public');
        $products->image_url = Storage::url($path);
        $products->save();

        return redirect()
            ->route('admin.products.show', $products->id)
            ->with('success', 'Product image uploaded successfully.');
    }
}