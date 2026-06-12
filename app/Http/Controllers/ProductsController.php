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
    /**
     * Display a listing of products.
     */
    // public function index()
    // {
    //     $products = Products::all();

    // return view(
    //     'admin.items.index',
    //     compact('products')
    // );
    // }

    /**
     * Show create product form.
     */
    // public function create()
    // {
    //     return view('admin.items.create');
    // }

    /**
     * Store a newly created product.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'seller_id' => ['required'],
    //         'category_id' => ['required'],
    //         'name' => ['required', 'max:255'],
    //         'description' => ['required'],
    //         'price' => ['required', 'numeric', 'min:0'],
    //         'stock' => ['required', 'integer', 'min:0'],
    //         'image_url' => ['nullable'],
    //         'is_active' => ['required'],
    //     ]);

    //     Products::create($validated);

    //     return redirect()
    //         ->route('products.index')
    //         ->with(
    //             'success',
    //             'Product created successfully.'
    //         );
    // }

    /**
     * Display specified product.
     */
    // public function show(Products $product)
    // {
    //     return view(
    //         'products.show',
    //         compact('product')
    //     );
    // }

    /**
     * Show edit product form.
     */
    // public function edit(Products $product)
    // {
    //     return view(
    //     'admin.items.edit',
    //     compact('product')
    //     );
    // }

    /**
     * Update specified product.
     */
    // public function update(
    //     Request $request,
    //     Products $product
    // ) {
    //     $validated = $request->validate([
    //         'seller_id' => ['required'],
    //         'category_id' => ['required'],
    //         'name' => ['required', 'max:255'],
    //         'description' => ['required'],
    //         'price' => ['required', 'numeric', 'min:0'],
    //         'stock' => ['required', 'integer', 'min:0'],
    //         'image_url' => ['nullable'],
    //         'is_active' => ['required'],
    //     ]);

    //     $product->update($validated);

    //     return redirect()
    //         ->route('products.index')
    //         ->with(
    //             'success',
    //             'Product updated successfully.'
    //         );
    // }

    /**
     * Remove specified product.
     */
    // public function destroy(Products $product)
    // {
    //     $product->delete();

    //     return redirect()
    //         ->route('products.index')
    //         ->with(
    //             'success',
    //             'Product deleted successfully.'
    //         );
    // }

    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {

            $products = Products::with('seller.user')
                ->when($request->search, function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            return view('welcome', [
                'page' => 'admin-products',
                'products' => $products,
            ]);
        }

        // Seller: show only their own products
        if (Auth::check() && Auth::user()->role === 'seller') {
            $seller = Seller::where('user_id', Auth::id())->first();
            $products = Products::with('seller.user')
                ->where('seller_id', $seller?->id)
                ->when($request->search, function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            return view('seller.products.index', compact('products'));
        }

        $products = Products::with('seller.user')
            ->where('is_active', true)
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('welcome', [
            'page' => 'storefront',
            'products' => $products,
        ]);
    }

    /**
     * SHOW CREATE FORM
     */
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

        // Seller gets dedicated seller view
        if (Auth::user()->role === 'seller') {
            return view('seller.products.form', [
                'categories' => Categories::all(),
            ]);
        }

        return view('welcome', [
            'page' => 'admin-product-form',
            'categories' => Categories::all(),
            'sellers' => Seller::all(),
        ]);
    }

    /**
     * STORE PRODUCT
     */
    public function store(Request $request)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'seller'])) {
            return response()->view('welcome', ['page' => 'access-denied'], 403);
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
        ]);

        $sellerId = $this->resolveSellerId($request);

        if (!$sellerId) {
            return response()->view('welcome', ['page' => 'access-denied'], 403);
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

        // upload images
        $imageUrls = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imageUrls[] = Storage::url($path);
            }
        }

        if (!empty($imageUrls)) {
            $productData['image_urls'] = $imageUrls;
            $productData['image_url'] = $imageUrls[0];
        }

        $product = Products::create($productData);

        $showRoute = Auth::user()->role === 'seller'
            ? route('seller.products.show', $product->id)
            : route('admin.products.show', $product->id);

        return redirect($showRoute)->with('success', 'Product created successfully.');
    }

    /**
     * SHOW DETAIL PRODUCT
     */
    public function show(Products $product)
    {
        $product = Products::with('seller.user')->findOrFail($product->id);

        // ADMIN
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('welcome', [
                'page' => 'admin-products',
                'products' => Products::latest()->paginate(10),
                'productDetail' => $product,
            ]);
        }

        // SELLER
        if (Auth::check() && Auth::user()->role === 'seller') {

            $seller = Seller::where('user_id', Auth::id())->first();

            if (!$seller || $product->seller_id !== $seller->id) {
                return response()->view('welcome', ['page' => 'access-denied'], 403);
            }

            return view('welcome', [
                'page' => 'admin-products',
                'products' => Products::where('seller_id', $seller->id)->latest()->paginate(10),
                'productDetail' => $product,
            ]);
        }

        // CUSTOMER / GUEST
        return view('welcome', [
            'page' => 'product-detail',
            'productDetail' => $product,
        ]);
    }

    /**
     * EDIT FORM
     */
    public function edit(Products $product)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'seller'])) {
            return response()->view('welcome', ['page' => 'access-denied'], 403);
        }

        if (Auth::user()->role === 'seller') {
            $seller = Seller::where('user_id', Auth::id())->first();

            if (!$seller || $products->seller_id !== $seller->id) {

                return response()->view(
                    'welcome',
                    [
                        'page' => 'access-denied',
                    ],
                    403
                );

            }

            // Seller gets dedicated seller edit view
            return view('seller.products.form', [
                'productDetail' => $products->load('seller.user'),
                'categories' => Categories::all(),
            ]);
        }

        return view('welcome', [
            'page' => 'admin-product-form',
            'productDetail' => $product->load('seller.user'),
            'categories' => Categories::all(),
            'sellers' => Seller::all(),
        ]);
    }

    /**
     * UPDATE PRODUCT
     */
    public function update(Request $request, Products $product)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'seller'])) {
            return response()->view('welcome', ['page' => 'access-denied'], 403);
        }

        if (Auth::user()->role === 'seller') {
            $seller = Seller::where('user_id', Auth::id())->first();

            if (!$seller || $product->seller_id !== $seller->id) {
                return response()->view('welcome', ['page' => 'access-denied'], 403);
            }
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
        ]);

        $product->update([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // image update
        $imageUrls = $product->image_urls ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imageUrls[] = Storage::url($path);
            }
        }

        if (!empty($imageUrls)) {
            $product->image_urls = $imageUrls;

            if (!$product->image_url) {
                $product->image_url = $imageUrls[0];
            }
        }

        $product->save();

        $showRoute = Auth::user()->role === 'seller'
            ? route('seller.products.show', $products->id)
            : route('admin.products.show', $products->id);

        return redirect($showRoute)->with('success', 'Product updated successfully.');
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
        // Reload lengkap dengan relasi
        $products = Products::with('seller.user')
            ->findOrFail($products->id);

        // ADMIN
        if (Auth::check() && Auth::user()->role === 'admin') {

            $allProducts = Products::with('seller.user')
                ->latest()
                ->paginate(10);

            return view('welcome', [
                'page' => 'admin-products',
                'products' => $allProducts,
                'productDetail' => $products,
            ]);
        }

        // SELLER
        if (Auth::check() && Auth::user()->role === 'seller') {

            $seller = Seller::where('user_id', Auth::id())->first();

            if (!$seller || $products->seller_id !== $seller->id) {

                return response()->view(
                    'welcome',
                    [
                        'page' => 'access-denied',
                    ],
                    403
                );
            }

            // Seller gets dedicated seller product detail view
            return view('seller.products.show', [
                'productDetail' => $products,
            ]);
        }

        // CUSTOMER / GUEST
        return view('welcome', [
            'page' => 'product-detail',
            'productDetail' => $products,
        ]);
    }

    public function destroy(Products $products)
    {
        if (!Auth::check()) {
            return response()->view('welcome', ['page' => 'access-denied'], 403);
        }

        if (Auth::user()->role === 'admin') {
            $product->delete();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product deleted successfully.');
        }

        if (Auth::user()->role === 'seller') {

            $seller = Seller::where('user_id', Auth::id())->first();

            if (!$seller || $product->seller_id !== $seller->id) {
                return response()->view('welcome', ['page' => 'access-denied'], 403);
            }

            $product->delete();

            return redirect()
                ->route('seller.products.index')
                ->with('success', 'Product deleted successfully.');
        }

        return response()->view('welcome', ['page' => 'access-denied'], 403);
    }

    /**
     * UPLOAD SINGLE IMAGE
     */
    public function uploadImage(Request $request, Products $product)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'seller'])) {
            return response()->view('welcome', ['page' => 'access-denied'], 403);
        }

        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('products', 'public');

        $product->image_url = Storage::url($path);
        $product->save();

        $showRoute = Auth::user()->role === 'seller'
            ? route('seller.products.show', $products->id)
            : route('admin.products.show', $products->id);

        return redirect($showRoute)->with('success', 'Product image uploaded successfully.');
    }
}