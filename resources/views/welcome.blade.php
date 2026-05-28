<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>FILKOMSHOP</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

</head>

<body class="bg-[#f3f3f3] min-h-screen m-0">

    @if(isset($page) && $page === 'access-denied')

        <div class="min-h-screen flex items-center justify-center px-6">

            <div class="bg-white shadow-2xl rounded-3xl p-14 text-center max-w-2xl w-full">

                <div class="text-8xl mb-8">
                    🔒
                </div>

                <h1 class="text-5xl font-extrabold text-red-500 mb-5">
                    Access Denied
                </h1>

                <p class="text-gray-500 text-xl mb-10">
                    You do not have permission to access this page.
                </p>

                <a
                    href="/"
                    class="inline-block bg-[#1f232b] hover:bg-[#343a46] text-white px-8 py-4 rounded-2xl font-semibold transition"
                >
                    Back to Home
                </a>

            </div>

        </div>

    @elseif(isset($page) && $page === 'admin-products')

        <div class="min-h-screen bg-[#f3f3f3]">

            <nav class="fixed left-0 right-0 top-0 w-full z-50 bg-slate-950 shadow-lg border-b border-slate-800" style="background-color: #1f232b;">

                <div class="max-w-7xl mx-auto px-6">

                    <div class="flex justify-between items-center h-16">

                        <div class="flex items-center gap-10">

                            <a
                                href="/"
                                class="text-3xl font-extrabold text-white tracking-wide"
                            >
                                FILKOMSHOP
                            </a>

                            <a
                                href="/"
                                class="text-gray-300 hover:text-white transition"
                            >
                                Home
                            </a>

                        </div>

                        <div class="flex items-center gap-4">

                            <div class="rounded-xl px-3 py-2 shadow-lg">

                                <form
                                    action="{{ route('admin.products.index') }}"
                                    method="GET"
                                    class="flex items-center gap-2"
                                >

                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Search product..."
                                        class="bg-white w-64 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none text-gray"
                                    >

                                    <button
                                        type="submit"
                                        class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium"
                                    >
                                        Search
                                    </button>

                                </form>

                            </div>

                            <div class="rounded-xl px-3 py-2 shadow-lg">

                                <div class="bg-yellow-400 text-black px-4 py-2 rounded-lg font-semibold">
                                    Admin
                                </div>

                            </div>

                            @auth

                                <div class="rounded-xl px-3 py-2 shadow-lg">

                                    <form
                                        action="{{ route('logout') }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium"
                                        >
                                            Logout
                                        </button>

                                    </form>

                                </div>

                            @endauth

                        </div>

                    </div>

                </div>

            </nav>

            <div class="max-w-7xl mx-auto px-6 pt-28 pb-10">

                <div class="mt-12">

                    <div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center mb-6">

                        <div>

                            <h2 class="text-5xl font-bold text-[#1f232b]">
                                Product List
                            </h2>

                            <p class="text-gray-500 text-2xl">
                                Browse all available products
                            </p>

                        </div>

                        <div>
                            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-full bg-yellow-400 px-5 py-3 text-lg font-semibold text-black hover:bg-yellow-500">
                                + Create Product
                            </a>
                        </div>

                    </div>

                    @if(session('success'))

                        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl mb-6">

                            {{ session('success') }}

                        </div>

                    @endif

                    @isset($productDetail)

                        <div class="mb-6">
                            <button type="button" onclick="history.back()" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-[#1f232b] shadow-sm hover:bg-slate-50">
                                ← Back
                            </button>
                        </div>

                        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-8">
                            <div class="grid gap-6 xl:grid-cols-[1.5fr_1.05fr]">
                                <div class="rounded-[2rem] overflow-hidden border border-slate-200 bg-slate-50">
                                    <form action="{{ route('admin.products.image.upload', $productDetail->id) }}" method="POST" enctype="multipart/form-data" class="group relative">
                                        @csrf
                                        <input id="product-image-input" type="file" name="image" accept="image/*" class="hidden" onchange="this.form.submit()" />

                                        <label for="product-image-input" class="cursor-pointer block">
                                            @php
                                                $primaryImage = $productDetail->image_urls[0] ?? $productDetail->image_url;
                                            @endphp
                                            @if($primaryImage)
                                                <img
                                                    src="{{ asset($primaryImage) }}"
                                                    alt="{{ $productDetail->name }}"
                                                    class="w-full max-h-[1080px] object-cover"
                                                    style="max-width:1920px;"
                                                />
                                            @else
                                                <div class="w-full h-[28rem] bg-slate-100 flex items-center justify-center text-slate-400 text-lg">
                                                    Product image not available
                                                </div>
                                            @endif

                                            <div class="absolute inset-0 flex items-center justify-center bg-slate-950/0 transition duration-300 group-hover:bg-slate-950/40">
                                                <span class="inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-sm font-semibold text-slate-900 opacity-0 transition duration-300 group-hover:opacity-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                                                        <path fill-rule="evenodd" d="M7.707 4.293a1 1 0 00-1.414 1.414L10.586 10 6.293 14.293a1 1 0 001.414 1.414l5-5a1 1 0 000-1.414l-5-5z" clip-rule="evenodd" />
                                                    </svg>
                                                    Change Photo
                                                </span>
                                            </div>
                                        </label>
                                    </form>
                                </div>

                                <div class="space-y-5">
                                    <div>
                                        <h2 class="text-4xl font-bold text-[#1f232b]">{{ $productDetail->name }}</h2>
                                        <p class="text-slate-500 mt-2">Toko Emas Jaya</p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 text-sm text-slate-600">
                                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                            <div class="text-slate-400">Price</div>
                                            <div class="mt-2 text-2xl font-semibold text-[#1f232b]">Rp {{ number_format($productDetail->price, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                            <div class="text-slate-400">Stock</div>
                                            <div class="mt-2 text-2xl font-semibold text-[#1f232b]">{{ $productDetail->stock }}</div>
                                        </div>
                                    </div>

                                    <div class="rounded-[1.7rem] border border-slate-200 bg-slate-50 p-6 text-slate-600">
                                        <div class="text-sm uppercase tracking-[0.2em] text-slate-400">Description</div>
                                        <p class="mt-3 leading-relaxed">{{ $productDetail->description }}</p>
                                    </div>

                                    <div class="grid gap-4">
                                        @auth
                                            <form action="{{ route('cart.store') }}" method="POST" class="grid gap-4">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $productDetail->id }}" />
                                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                                    <button type="submit" class="w-full rounded-full bg-black px-6 py-4 text-lg font-semibold text-white hover:bg-slate-900">Add to Cart</button>
                                                    <div class="flex items-center justify-between rounded-full border border-slate-200 bg-slate-50 px-4 py-4 sm:w-48">
                                                        <span class="text-sm text-slate-500">Qty</span>
                                                        <input type="number" name="quantity" min="1" max="{{ $productDetail->stock }}" value="1" class="w-20 rounded-3xl border border-slate-300 bg-white px-3 py-2 text-center text-slate-900" />
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="inline-flex w-full items-center justify-center rounded-full bg-black px-6 py-4 text-lg font-semibold text-white hover:bg-slate-900">Add to Cart</a>
                                        @endauth

                                        <a href="{{ route('cart.index') }}" class="inline-flex w-full items-center justify-center rounded-full border border-yellow-400 bg-yellow-400 px-6 py-4 text-lg font-semibold text-black hover:bg-yellow-500">Checkout</a>
                                    </div>

                                    @auth
                                        @if(in_array(Auth::user()->role, ['admin', 'seller']))
                                            <div class="grid gap-3">
                                                <a href="{{ route('admin.products.edit', $productDetail->id) }}" class="inline-flex w-full items-center justify-center rounded-full bg-[#1f232b] px-6 py-4 text-lg font-semibold text-white hover:bg-[#343a46]">Edit Product</a>
                                                <form action="{{ route('admin.products.destroy', $productDetail->id) }}" method="POST" class="mt-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Delete this product?')" class="w-full rounded-full bg-red-500 px-6 py-4 text-lg font-semibold text-white hover:bg-red-600">Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>

                    @else

                        @if($products->count() > 0)

                            <div class="grid grid-cols-1 gap-8">

                                @foreach($products as $product)

                                    <div class="bg-gradient-to-r from-[#1f232b] to-[#343a46] rounded-[2rem] shadow-xl overflow-hidden p-5">

                                        <div class="text-white">

                                            <h3 class="text-3xl font-bold">
                                                {{ $product->name }}
                                            </h3>

                                            <p class="text-2xl mt-2">
                                                Stock: {{ $product->stock }}
                                            </p>

                                        </div>

<div class="flex flex-col gap-3 mt-5">

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                                        <a
                                            href="{{ route('admin.products.show', $product->id) }}"
                                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-black text-center py-3 rounded-full text-2xl font-bold transition"
                                        >
                                            Read
                                        </a>

                                        @auth
                                            <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                                <button
                                                    type="submit"
                                                    class="w-full bg-yellow-400 hover:bg-yellow-500 text-black py-3 rounded-full text-2xl font-bold transition"
                                                >
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <a
                                                href="{{ route('login') }}"
                                                class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-black text-center py-3 rounded-full text-2xl font-bold transition"
                                            >
                                                Login to Add
                                            </a>
                                        @endauth

                                        <form
                                            action="{{ route('admin.products.destroy', $product->id) }}"
                                            method="POST"
                                            class="flex-1"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                onclick="return confirm('Are you sure you want to delete this item?')"
                                                class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-full text-2xl font-bold transition"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                        </div>

                                    </div>

                                @endforeach
                            </div>

                        @else

                            <div class="bg-white rounded-2xl shadow-md p-20 text-center">

                                <h2 class="text-5xl font-bold text-[#1f232b]">
                                    No Products Yet
                                </h2>

                                <p class="text-gray-500 mt-5 text-xl">
                                    Products will appear here once sellers add items.
                                </p>

                            </div>

                        @endif

                        <div class="mt-10">

                            {{ $products->links() }}

                        </div>

                    @endisset

                </div>

            </div>

            <footer class="bg-[#1f232b] text-white py-6 mt-16">

                <div class="text-center">

                    © 2026 FILKOMSHOP

                </div>

            </footer>

        </div>

    @elseif(isset($page) && $page === 'storefront')

        <div class="min-h-screen bg-[#f3f3f3]">

            <nav class="fixed left-0 right-0 top-0 w-full z-50 bg-slate-950 shadow-lg border-b border-slate-800" style="background-color: #1f232b;">

                <div class="max-w-7xl mx-auto px-6">

                    <div class="flex justify-between items-center h-16">

                        <div class="flex items-center gap-10">

                            <a
                                href="/"
                                class="text-3xl font-extrabold text-white tracking-wide"
                            >
                                FILKOMSHOP
                            </a>

                            <a
                                href="/products"
                                class="text-gray-300 hover:text-white transition"
                            >
                                Storefront
                            </a>

                        </div>

                        <div class="flex items-center gap-4">

                            <form
                                action="{{ route('products.index') }}"
                                method="GET"
                                class="flex items-center gap-2 rounded-xl px-3 py-2 shadow-lg bg-white"
                            >

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search product..."
                                    class="bg-white w-64 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none text-gray"
                                >

                                <button
                                    type="submit"
                                    class="bg-[#1f232b] hover:bg-[#343a46] text-white px-4 py-2 rounded-lg font-medium"
                                >
                                    Search
                                </button>

                            </form>

                            @auth
                                <a
                                    href="{{ route('cart.index') }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg font-medium"
                                >
                                    View Cart
                                </a>
                                <div class="rounded-xl px-3 py-2 shadow-lg">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium">Logout</button>
                                    </form>
                                </div>
                            @else
                                <div class="flex gap-2">
                                    <a href="{{ route('login') }}" class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium">Login</a>
                                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium">Register</a>
                                </div>
                            @endauth

                        </div>

                    </div>

                </div>

            </nav>

            <div class="max-w-7xl mx-auto px-6 pt-28 pb-10">

                <div class="mt-12">

                    <div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center mb-6">

                        <div>

                            <h2 class="text-5xl font-bold text-[#1f232b]">
                            Store
                            </h2>

                        </div>

                        <div>
                            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-full bg-yellow-400 px-5 py-3 text-lg font-semibold text-black hover:bg-yellow-500">
                                + Create Product
                            </a>
                        </div>

                    </div>

                    @if($products->count() > 0)

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                            @foreach($products as $product)

                                <div class="bg-white rounded-3xl shadow-xl overflow-hidden p-6">

                                    <div class="mb-4">
                                    @if($product->image_url)
                                        <img
                                            src="{{ asset($product->image_url) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-52 object-cover rounded-3xl mb-5 border border-gray-200"
                                        />
                                    @else
                                        <div class="w-full h-52 rounded-3xl border border-dashed border-gray-300 bg-gray-100 mb-5 flex items-center justify-center text-gray-500">
                                            No image available
                                        </div>
                                    @endif
                                    <h3 class="text-3xl font-bold text-[#1f232b]">{{ $product->name }}</h3>
                                    <p class="text-gray-500 mt-2">Rp {{ number_format($product->price,0,',','.') }}</p>
                                    <p class="text-gray-500 mt-1">Stock: {{ $product->stock }}</p>
                                </div>

                                    <div class="flex flex-col gap-3">

                                        <a
                                            href="{{ route('products.show', $product->id) }}"
                                            class="bg-[#1f232b] hover:bg-[#343a46] text-white px-5 py-3 rounded-xl text-center font-semibold"
                                        >
                                            View Item
                                        </a>

                                        @auth

                                            <form action="{{ route('cart.store') }}" method="POST" class="flex gap-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                                <button type="submit" class="flex-1 bg-black hover:bg-slate-900 text-white px-5 py-3 rounded-xl font-semibold">Add to Cart</button>
                                            </form>

                                        @else

                                            <a
                                                href="{{ route('login') }}"
                                                class="bg-black hover:bg-slate-900 text-white px-5 py-3 rounded-xl text-center font-semibold"
                                            >
                                                Login to Add
                                            </a>

                                        @endauth

                                    </div>

                                </div>

                            @endforeach

                        </div>

                        <div class="mt-10">{{ $products->links() }}</div>

                    @else

                        <div class="bg-white rounded-2xl shadow-md p-20 text-center">

                            <h2 class="text-5xl font-bold text-[#1f232b]">No products available</h2>
                            <p class="text-gray-500 mt-5 text-xl">Check back later or ask a seller to add items.</p>

                        </div>

                    @endif

                </div>

            </div>

            <footer class="bg-[#1f232b] text-white py-6 mt-16">

                <div class="text-center">© 2026 FILKOMSHOP</div>

            </footer>

        </div>

    @elseif(isset($page) && $page === 'admin-product-form')

        <div class="min-h-screen bg-[#f3f3f3]">

            <nav class="fixed left-0 right-0 top-0 w-full z-50 bg-slate-950 shadow-lg border-b border-slate-800" style="background-color: #1f232b;">

                <div class="max-w-7xl mx-auto px-6">

                    <div class="flex justify-between items-center h-16">

                        <div class="flex items-center gap-10">

                            <a
                                href="/"
                                class="text-3xl font-extrabold text-white tracking-wide"
                            >
                                FILKOMSHOP
                            </a>

                            <a
                                href="/admin/products"
                                class="text-gray-300 hover:text-white transition"
                            >
                                Product List
                            </a>

                        </div>

                        <div class="flex items-center gap-4">

                            @auth
                                <div class="rounded-xl px-3 py-2 shadow-lg">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium">Logout</button>
                                    </form>
                                </div>
                            @endauth

                        </div>

                    </div>

                </div>

            </nav>

            <div class="max-w-7xl mx-auto px-6 pt-28 pb-10">

                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-8">
                    <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between mb-8">
                        <div>
                            <h1 class="text-5xl font-bold text-[#1f232b]">{{ isset($productDetail) ? 'Edit Product' : 'Create New Product' }}</h1>
                            <p class="text-slate-500 mt-3">{{ isset($productDetail) ? 'Update the product details, price, stock and images.' : 'Add a new item to your seller catalog.' }}</p>
                        </div>

                        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-[#1f232b] hover:bg-slate-50">Back to Product List</a>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl mb-6">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($productDetail) ? route('admin.products.update', $productDetail->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @if(isset($productDetail))
                            @method('PUT')
                        @endif

                        @if(Auth::user()->role === 'admin' && isset($sellers))
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2" for="seller_id">Seller</label>
                                <select id="seller_id" name="seller_id" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900">
                                    <option value="">Choose seller</option>
                                    @foreach($sellers as $seller)
                                        <option value="{{ $seller->id }}" {{ old('seller_id', $productDetail->seller_id ?? '') == $seller->id ? 'selected' : '' }}>{{ $seller->shop_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="grid gap-6 lg:grid-cols-2">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2" for="name">Product Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name', $productDetail->name ?? '') }}" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900" required />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2" for="price">Price</label>
                                <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $productDetail->price ?? '') }}" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900" required />
                            </div>
                        </div>

                        <div class="grid gap-6 lg:grid-cols-2">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2" for="stock">Stock</label>
                                <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $productDetail->stock ?? '') }}" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900" required />
                            </div>

                            <div class="flex items-center gap-3">
                                <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $productDetail->is_active ?? true) ? 'checked' : '' }} class="h-5 w-5 rounded border-slate-300 text-black focus:ring-black" />
                                <label for="is_active" class="text-sm font-semibold text-slate-700">Publish product</label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2" for="category_id">Category</label>
                            <select id="category_id" name="category_id" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900">
                                <option value="">No category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $productDetail->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2" for="description">Description</label>
                            <textarea id="description" name="description" rows="6" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900">{{ old('description', $productDetail->description ?? '') }}</textarea>
                        </div>

                        <div class="space-y-3">
                            <label class="block text-sm font-semibold text-slate-700">Product Photos</label>
                            <p class="text-sm text-slate-500">Upload one or more product photos. Max each 2MB.</p>
                            <input type="file" name="images[]" accept="image/*" multiple class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900" />
                        </div>

                        @if(isset($productDetail) && ($productDetail->image_urls || $productDetail->image_url))
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                <div class="text-sm font-semibold text-slate-700 mb-4">Existing Photos</div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach(array_filter(array_merge([$productDetail->image_url], $productDetail->image_urls ?? [])) as $image)
                                        @if($image)
                                            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white">
                                                <img src="{{ asset($image) }}" alt="Product photo" class="h-32 w-full object-cover" />
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="grid gap-4 sm:grid-cols-2">
                            <button type="submit" class="w-full rounded-full bg-[#1f232b] px-6 py-4 text-lg font-semibold text-white hover:bg-[#343a46]">{{ isset($productDetail) ? 'Update Product' : 'Create Product' }}</button>
                            <a href="{{ route('admin.products.index') }}" class="w-full inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-6 py-4 text-lg font-semibold text-[#1f232b] hover:bg-slate-50">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="bg-[#1f232b] text-white py-6 mt-16">
                <div class="text-center">© 2026 FILKOMSHOP</div>
            </footer>

        </div>

    @elseif(isset($page) && $page === 'product-detail')

        <div class="min-h-screen bg-[#f3f3f3]">

            <nav class="fixed left-0 right-0 top-0 w-full z-50 bg-slate-950 shadow-lg border-b border-slate-800" style="background-color: #1f232b;">

                <div class="max-w-7xl mx-auto px-6">

                    <div class="flex justify-between items-center h-16">

                        <div class="flex items-center gap-10">

                            <a href="/" class="text-3xl font-extrabold text-white tracking-wide">FILKOMSHOP</a>
                            <a href="/products" class="text-gray-300 hover:text-white transition">Storefront</a>

                        </div>

                        <div class="flex items-center gap-4">

                            @auth
                                <a href="{{ route('cart.index') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg font-medium">View Cart</a>
                                <div class="rounded-xl px-3 py-2 shadow-lg">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium">Logout</button>
                                    </form>
                                </div>
                            @else
                                <div class="flex gap-2">
                                    <a href="{{ route('login') }}" class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium">Login</a>
                                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium">Register</a>
                                </div>
                            @endauth

                        </div>

                    </div>

                </div>

            </nav>

            <div class="max-w-7xl mx-auto px-6 pt-28 pb-10">

                <div class="mb-6">
                    <button type="button" onclick="history.back()" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-[#1f232b] shadow-sm hover:bg-slate-50">← Back</button>
                </div>

                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-8">
                    <div class="grid gap-6 xl:grid-cols-[1.5fr_1.05fr]">
                        <div class="rounded-[2rem] overflow-hidden border border-slate-200 bg-slate-50">
                            @php
                                $primaryImage = $productDetail->image_urls[0] ?? $productDetail->image_url;
                            @endphp
                            @if($primaryImage)
                                <img
                                    src="{{ asset($primaryImage) }}"
                                    alt="{{ $productDetail->name }}"
                                    class="w-full max-h-[1080px] object-cover"
                                />
                            @else
                                <div class="w-full h-[28rem] bg-slate-100 flex items-center justify-center text-slate-400 text-lg">
                                    Product image not available
                                </div>
                            @endif
                        </div>

                        <div class="space-y-5">
                            <div>
                                <h1 class="text-4xl font-bold text-[#1f232b]">{{ $productDetail->name }}</h1>
                                <p class="text-slate-500 mt-2">Toko Emas Jaya</p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm text-slate-600">
                                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                    <div class="text-slate-400">Price</div>
                                    <div class="mt-2 text-2xl font-semibold text-[#1f232b]">Rp {{ number_format($productDetail->price,0,',','.') }}</div>
                                </div>
                                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                    <div class="text-slate-400">Stock</div>
                                    <div class="mt-2 text-2xl font-semibold text-[#1f232b]">{{ $productDetail->stock }}</div>
                                </div>
                            </div>

                            <div class="rounded-[1.7rem] border border-slate-200 bg-slate-50 p-6 text-slate-600">
                                <div class="text-sm uppercase tracking-[0.2em] text-slate-400">Description</div>
                                <p class="mt-3 leading-relaxed">{{ $productDetail->description }}</p>
                            </div>

                            <div class="grid gap-4">
                                @auth
                                    <form action="{{ route('cart.store') }}" method="POST" class="grid gap-4">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $productDetail->id }}" />
                                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                            <button type="submit" class="w-full rounded-full bg-black px-6 py-4 text-lg font-semibold text-white hover:bg-slate-900">Add to Cart</button>
                                            <div class="flex items-center justify-between rounded-full border border-slate-200 bg-slate-50 px-4 py-4 sm:w-48">
                                                <span class="text-sm text-slate-500">Qty</span>
                                                <input type="number" name="quantity" min="1" max="{{ $productDetail->stock }}" value="1" class="w-20 rounded-3xl border border-slate-300 bg-white px-3 py-2 text-center text-slate-900" />
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex w-full items-center justify-center rounded-full bg-black px-6 py-4 text-lg font-semibold text-white hover:bg-slate-900">Add to Cart</a>
                                @endauth

                                <a href="{{ route('cart.index') }}" class="inline-flex w-full items-center justify-center rounded-full border border-yellow-400 bg-yellow-400 px-6 py-4 text-lg font-semibold text-black hover:bg-yellow-500">Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <footer class="bg-[#1f232b] text-white py-6 mt-16"><div class="text-center">© 2026 FILKOMSHOP</div></footer>

        </div>

    @elseif(isset($page) && $page === 'cart')

        <div class="min-h-screen bg-[#f3f3f3] flex flex-col">

            <nav class="fixed left-0 right-0 top-0 w-full z-50 bg-slate-950 shadow-lg border-b border-slate-800" style="background-color: #1f232b;">

                <div class="max-w-7xl mx-auto px-6">

                    <div class="flex justify-between items-center h-16">

                        <div class="flex items-center gap-10">

                            <a
                                href="/"
                                class="text-3xl font-extrabold text-white tracking-wide"
                            >
                                FILKOMSHOP
                            </a>

                            <a
                                href="/"
                                class="text-gray-300 hover:text-white transition"
                            >
                                Home
                            </a>

                        </div>

                        <div class="flex items-center gap-4">

                            <a
                                href="{{ route('products.index') }}"
                                class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium"
                            >
                                Browse Products
                            </a>

                            <div class="rounded-xl px-3 py-2 shadow-lg">

                                <form
                                    action="{{ route('products.index') }}"
                                    method="GET"
                                    class="flex items-center gap-2"
                                >

                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Search product..."
                                        class="bg-white w-64 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none text-gray"
                                    >

                                    <button
                                        type="submit"
                                        class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium"
                                    >
                                        Search
                                    </button>

                                </form>

                            </div>

                            <div class="rounded-xl px-3 py-2 shadow-lg">

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium">Logout</button>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </nav>

            <div class="max-w-7xl mx-auto px-6 pt-28 pb-10 flex-1">

                <h2 class="text-5xl font-bold text-[#1f232b] mb-6">Your Shopping Cart</h2>

                @if(session('success'))

                    <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl mb-6">

                        {{ session('success') }}

                    </div>

                @endif

                @if(session('error'))

                    <div class="bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-2xl mb-6">

                        {{ session('error') }}

                    </div>

                @endif

                @if(isset($items) && $items->count() > 0)

                    <div class="bg-white rounded-2xl shadow-lg p-10 md:p-12 max-w-5xl mx-auto w-full">

                        <div class="space-y-6">

                            @foreach($items as $item)

                                <div class="flex flex-col md:flex-row md:items-center justify-between border-b pb-6 gap-4">

                                            <div class="flex items-start gap-4">
                                            <div class="w-24 h-24 rounded-3xl overflow-hidden border border-gray-200 bg-gray-100 flex items-center justify-center">
                                                @if($item->product->image_url)
                                                    <img src="{{ asset($item->product->image_url) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover" />
                                                @else
                                                    <span class="text-sm text-gray-500">No image</span>
                                                @endif
                                            </div>
                                            <div class="space-y-2">
                                                <h3 class="text-2xl font-semibold text-[#1f232b]">{{ $item->product->name }}</h3>
                                                <p class="text-gray-600">Rp {{ number_format($item->product->price,0,',','.') }}</p>
                                            </div>
                                        </div>

                                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">

                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-24 px-3 py-2 border rounded-lg" />
                                            <button class="bg-[#1f232b] text-white px-4 py-2 rounded-lg">Update</button>
                                        </form>

                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Remove this item from cart?')" class="bg-red-500 text-white px-4 py-2 rounded-lg">Remove</button>
                                        </form>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                        <div class="mt-6 flex justify-end">

                            <div class="text-right">
                                @php
                                    $total = $items->reduce(function($carry, $i){ return $carry + ($i->product->price * $i->quantity); }, 0);
                                @endphp
                                <div class="text-2xl font-bold">Total: Rp {{ number_format($total,0,',','.') }}</div>
                                <div class="mt-4">
                                    <button class="bg-yellow-400 text-black px-6 py-3 rounded-xl font-semibold">Proceed to Checkout</button>
                                </div>
                            </div>

                        </div>

                    </div>

                @else

                    <div class="bg-white rounded-2xl shadow-md p-20 text-center max-w-5xl mx-auto w-full">

                        <h2 class="text-3xl font-bold text-[#1f232b]">Your cart is empty</h2>

                        <p class="text-gray-500 mt-5">Browse products and add items to your cart.</p>

                        <div class="mt-8">
                            <a href="{{ route('products.index') }}" class="bg-[#1f232b] text-white px-6 py-3 rounded-xl">Browse Products</a>
                        </div>

                    </div>

                @endif

            </div>

            <footer class="bg-[#1f232b] text-white py-6 mt-16">

                <div class="text-center">© 2026 FILKOMSHOP</div>

            </footer>

        </div>

    @else

        <div class="min-h-screen flex items-center justify-center">

            <div class="text-center">

                <h1 class="text-5xl font-extrabold text-[#1f232b]">
                    FILKOMSHOP
                </h1>

                <p class="text-gray-500 mt-5 text-xl">
                    Welcome to FilkomShop
                </p>

                <div class="mt-10 flex justify-center gap-4">

                    @guest

                        <a
                            href="{{ route('login') }}"
                            class="bg-[#1f232b] hover:bg-[#343a46] text-white px-6 py-3 rounded-xl font-semibold"
                        >
                            Login
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-3 rounded-xl font-semibold"
                        >
                            Register
                        </a>

                    @else

                        @if(Auth::check() && Auth::user()->role === 'admin')

                            <a
                                href="{{ route('admin.products.index') }}"
                                class="bg-[#1f232b] hover:bg-[#343a46] text-white px-6 py-3 rounded-xl font-semibold"
                            >
                                Open Item Management
                            </a>

                        @else

                            <a
                                href="{{ route('products.index') }}"
                                class="bg-[#1f232b] hover:bg-[#343a46] text-white px-6 py-3 rounded-xl font-semibold"
                            >
                                Open Storefront
                            </a>

                        @endif

                    @endguest

                </div>

            </div>

        </div>

    @endif

</body>

</html>