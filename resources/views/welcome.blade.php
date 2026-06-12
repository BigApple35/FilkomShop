<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>FILKOMSHOP</title>

    <!-- Google Font & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

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
                class="inline-block bg-[#1f232b] hover:bg-[#343a46] text-white px-8 py-4 rounded-2xl font-semibold transition">
                Back to Home
            </a>

        </div>

    </div>

    @elseif(isset($page) && $page === 'admin-products')

    @include('layouts.admin_sidebar')

    <div class="mt-4">

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
                    <button type="button" onclick="history.back()" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-[#1f232b] shadow-sm hover:bg-slate-50 transition">
                        <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                        Back to List
                    </button>
                </div>

                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-6 md:p-8">
                    <div class="grid gap-8 lg:grid-cols-[1.2fr_1fr]">
                        <div class="rounded-[1.8rem] overflow-hidden border border-slate-200 bg-[#f8f9fa] flex items-center justify-center relative min-h-[300px]">
                            <form action="{{ route('admin.products.image.upload', $productDetail->id) }}" method="POST" enctype="multipart/form-data" class="group relative w-full h-full m-0">
                                @csrf
                                <input id="product-image-input" type="file" name="image" accept="image/*" class="hidden" onchange="this.form.submit()" />

                                <label for="product-image-input" class="cursor-pointer block w-full h-full m-0">
                                    @php
                                    $primaryImage = (is_array($productDetail->image_urls) && isset($productDetail->image_urls[0])) ? $productDetail->image_urls[0] : $productDetail->image_url;
                                    @endphp
                                    @if($primaryImage)
                                    <img
                                        src="{{ asset($primaryImage) }}"
                                        alt="{{ $productDetail->name }}"
                                        class="w-full h-full object-cover max-h-[500px]"
                                        onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'600\' height=\'400\' viewBox=\'0 0 600 400\' style=\'background:%23f1f5f9;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f1f5f9\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'16\' fill=\'%2394a3b8\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image Available</text></svg>';" />
                                    @else
                                    <div class="w-full h-[28rem] bg-slate-100 flex flex-col items-center justify-center text-slate-400 text-lg">
                                        <span class="material-symbols-outlined text-slate-350" style="font-size: 48px; margin-bottom: 8px;">image_not_supported</span>
                                        Product image not available
                                    </div>
                                    @endif

                                    <div class="absolute inset-0 flex items-center justify-center bg-slate-950/0 transition duration-300 group-hover:bg-slate-950/40">
                                        <span class="inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-sm font-semibold text-slate-900 opacity-0 transition duration-300 group-hover:opacity-100">
                                            <span class="material-symbols-outlined" style="font-size: 18px;">photo_camera</span>
                                            Change Photo
                                        </span>
                                    </div>
                                </label>
                            </form>
                        </div>

                        <div class="flex flex-col justify-between space-y-6">
                            <div class="space-y-4">
                                <div>
                                    <h2 class="text-3xl md:text-4xl font-extrabold text-[#202124] break-all leading-tight">
                                        {{ $productDetail->name }}
                                    </h2>
                                    <p class="text-sm text-slate-500 mt-2 flex items-center gap-1.5 font-semibold">
                                        <span class="material-symbols-outlined text-slate-455" style="font-size: 18px;">store</span>
                                        Seller: <span class="text-slate-800">{{ $productDetail->seller->shop_name ?? $productDetail->seller->user->name ?? 'Unknown Seller' }}</span>
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                        <div class="text-slate-450 text-xs font-semibold uppercase tracking-wider">Price</div>
                                        <div class="mt-1 text-2xl font-extrabold text-[#1a73e8] break-all">
                                            Rp {{ number_format($productDetail->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                        <div class="text-slate-450 text-xs font-semibold uppercase tracking-wider">Stock</div>
                                        <div class="mt-1 text-2xl font-extrabold text-[#202124] break-all">
                                            {{ $productDetail->stock }}
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 text-slate-700">
                                    <div class="text-xs uppercase tracking-[0.15em] text-slate-455 font-bold mb-2">Description</div>
                                    <p class="text-sm leading-relaxed whitespace-pre-line break-all font-medium text-slate-650">
                                        {{ $productDetail->description ?? 'No description provided.' }}
                                    </p>
                                </div>
                            </div>

                            @auth
                            @if(in_array(Auth::user()->role, ['admin', 'seller']))
                            <div class="grid gap-3 pt-4 border-t border-slate-100">
                                <a 
                                    href="{{ route('admin.products.edit', $productDetail->id) }}" 
                                    class="w-full inline-flex items-center justify-center rounded-full bg-[#1a73e8] hover:bg-[#1557b0] px-6 py-3.5 text-base font-semibold text-white transition gap-2 shadow-sm hover:shadow"
                                >
                                    <span class="material-symbols-outlined" style="font-size: 20px;">edit</span>
                                    Edit Product Details
                                </a>
                                <form 
                                    action="{{ route('admin.products.destroy', $productDetail->id) }}" 
                                    method="POST" 
                                    class="mt-1 m-0"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        onclick="return confirm('Are you sure you want to delete this product?')" 
                                        class="w-full inline-flex items-center justify-center rounded-full bg-red-50 hover:bg-red-100 border border-red-100 px-6 py-3.5 text-base font-semibold text-red-650 transition gap-2 text-red-600"
                                    >
                                        <span class="material-symbols-outlined" style="font-size: 20px;">delete</span>
                                        Delete Product Listing
                                    </button>
                                </form>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>

                @else

                @if($products->count() > 0)

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($products as $product)

                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md hover:-translate-y-0.5 transition duration-200 p-5">

                        <div>
                            <!-- PRODUCT IMAGE HEADER -->
                            <div class="h-44 rounded-2xl overflow-hidden border border-slate-100 bg-[#f8f9fa] relative flex items-center justify-center mb-4">
                                @if($product->image_url)
                                <img
                                    src="{{ asset($product->image_url) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'300\' height=\'200\' viewBox=\'0 0 300 200\' style=\'background:%23f8f9fa;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f8f9fa\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'14\' fill=\'%235f6368\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image Available</text></svg>';"
                                />
                                @else
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <span class="material-symbols-outlined text-slate-350" style="font-size: 32px; margin-bottom: 2px;">image_not_supported</span>
                                    <span class="text-xs font-semibold text-slate-550">No image available</span>
                                </div>
                                @endif
                            </div>

                            <div class="space-y-1">
                                <h3 class="font-extrabold text-[#202124] text-base break-all line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-xs text-slate-500 flex items-center gap-1 font-semibold">
                                    <span class="material-symbols-outlined" style="font-size: 14px;">store</span>
                                    {{ $product->seller->shop_name ?? $product->seller->user->name ?? 'Unknown Seller' }}
                                </p>
                            </div>
                            
                            <div class="flex flex-wrap gap-2 my-3">
                                <span class="inline-flex items-center text-[10px] font-bold bg-[#e6f4ea] text-[#137333] border border-[#34a853]/20 px-2.5 py-0.5 rounded-full">
                                    Stock: {{ $product->stock }}
                                </span>
                                <span class="inline-flex items-center text-[10px] font-bold bg-[#e8f0fe] text-[#1a73e8] border border-[#1a73e8]/20 px-2.5 py-0.5 rounded-full">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex flex-col gap-2 mt-4">
                            <div class="flex gap-2">
                                <a
                                    href="{{ route('admin.products.show', $product->id) }}"
                                    class="flex-1 inline-flex items-center justify-center rounded-full bg-slate-100 hover:bg-slate-200 py-2 text-xs font-bold text-slate-700 transition gap-1"
                                >
                                    <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span>
                                    Read
                                </a>

                                <a
                                    href="{{ route('admin.products.edit', $product->id) }}"
                                    class="flex-1 inline-flex items-center justify-center rounded-full border border-slate-200 bg-white hover:bg-slate-50 py-2 text-xs font-bold text-slate-700 transition gap-1"
                                >
                                    <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                    Edit
                                </a>
                            </div>

                            <form
                                action="{{ route('admin.products.destroy', $product->id) }}"
                                method="POST"
                                class="w-full m-0"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    onclick="return confirm('Are you sure you want to delete this item?')"
                                    class="w-full inline-flex items-center justify-center rounded-full bg-red-50 hover:bg-red-100 border border-red-100 py-2 text-xs font-bold text-red-650 transition gap-1"
                                >
                                    <span class="material-symbols-outlined" style="font-size: 16px;">delete</span>
                                    Delete
                                </button>
                            </form>
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

        @include('layouts.admin_sidebar_footer')

    @elseif(isset($page) && $page === 'storefront')

    <div class="min-h-screen bg-[#f3f3f3]">

        @include('layouts.navigation')

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
                                onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'300\' height=\'200\' viewBox=\'0 0 300 200\' style=\'background:%23f8f9fa;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f8f9fa\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'14\' fill=\'%235f6368\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image Available</text></svg>';" />
                            @else
                            <div class="w-full h-52 rounded-3xl border border-dashed border-gray-300 bg-gray-100 mb-5 flex flex-col items-center justify-center text-gray-500">
                                <span class="material-symbols-outlined text-slate-400" style="font-size: 36px; margin-bottom: 4px;">image_not_supported</span>
                                <span class="small text-slate-400 font-medium" style="font-size: 11px;">No image available</span>
                            </div>
                            @endif
                            <h3 class="text-3xl font-bold text-[#1f232b] break-all">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500">
                                Seller: {{ $product->seller->user->name ?? 'Unknown Seller' }}
                            </p>
                            <p class="text-gray-500 mt-2 break-all">Rp {{ number_format($product->price,0,',','.') }}</p>
                            <p class="text-gray-500 mt-1 break-all">Stock: {{ $product->stock }}</p>
                        </div>

                        <div class="flex flex-col gap-3">

                            <a
                                href="{{ route('products.show', $product->id) }}"
                                class="bg-[#1f232b] hover:bg-[#343a46] text-white px-5 py-3 rounded-xl text-center font-semibold">
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
                                class="bg-black hover:bg-slate-900 text-white px-5 py-3 rounded-xl text-center font-semibold">
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

    @elseif(isset($page) && $page === 'admin-users')

    @include('layouts.admin_sidebar')

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-5xl font-bold text-[#1f232b]">
                        Manage Users
                    </h1>
                    <p class="text-gray-500 text-xl mt-2">
                        View, read, and delete registered users
                    </p>
                </div>

                <div>
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center rounded-full bg-yellow-400 px-5 py-3 text-lg font-semibold text-black hover:bg-yellow-500 transition">
                        + Create User
                    </a>
                </div>
            </div>
            @if(session('success'))

            <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl mb-6">

                {{ session('success') }}

            </div>

            @endif

            @isset($userDetail)

            <div class="mb-6">

                <button
                    type="button"
                    onclick="history.back()"
                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-[#1f232b] shadow-sm hover:bg-slate-50">
                    ← Back
                </button>

            </div>

            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-10">

                <div class="space-y-6">

                    <div>

                        <h2 class="text-4xl font-bold text-[#1f232b]">
                            {{ $userDetail->name }}
                        </h2>

                        <p class="text-gray-500 text-lg mt-2">
                            {{ $userDetail->email }}
                        </p>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6">

                            <div class="text-gray-400 text-sm">
                                User ID
                            </div>

                            <div class="text-2xl font-bold text-[#1f232b] mt-2">
                                #{{ $userDetail->id }}
                            </div>

                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6">

                            <div class="text-gray-400 text-sm">
                                Role
                            </div>

                            <div class="text-2xl font-bold text-[#1f232b] mt-2">
                                {{ ucfirst($userDetail->role) }}
                            </div>

                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6">

                            <div class="text-gray-400 text-sm break-all">
                                Email
                            </div>

                            <div class="text-xl font-semibold text-[#1f232b] mt-2 break-all">
                                {{ $userDetail->email }}
                            </div>

                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6">

                            <div class="text-gray-400 text-sm break-all">
                                Password (Hashed)
                            </div>

                            <div class="text-sm font-semibold text-[#1f232b] mt-2 break-all">
                                {{ $userDetail->password }}
                            </div>

                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6">

                            <div class="text-gray-400 text-sm break-all">
                                Created At
                            </div>

                            <div class="text-xl font-semibold text-[#1f232b] mt-2 break-all">
                                {{ $userDetail->created_at }}
                            </div>

                        </div>

                        <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6">

                            <div class="text-gray-400 text-sm break-all">
                                Updated At
                            </div>

                            <div class="text-xl font-semibold text-[#1f232b] mt-2 break-all">
                                {{ $userDetail->updated_at }}
                            </div>

                        </div>

                    </div>

                    <form
                        action="{{ route('admin.users.destroy', $userDetail->id) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            onclick="return confirm('Delete this user?')"
                            class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-full text-xl font-bold transition">
                            Delete User
                        </button>

                    </form>

                </div>

            </div>

            @else

            @if($users->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($users as $user)

                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md hover:-translate-y-0.5 transition duration-200 p-6">

                    <div>
                        <div class="flex items-center gap-4 mb-4">
                            <!-- GOOGLE PROFILE INITIALS -->
                            <div class="w-12 h-12 rounded-full bg-[#1a73e8] text-white font-extrabold text-base flex items-center justify-center border border-slate-200 shadow-inner select-none flex-shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            
                            <div class="min-w-0">
                                <h3 class="font-extrabold text-[#202124] text-base line-clamp-1 break-all">
                                    {{ $user->name }}
                                </h3>
                                <p class="text-xs text-slate-500 line-clamp-1 break-all mt-0.5 font-medium">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>

                        <!-- ROLE PILL BADGE -->
                        <div class="mb-4">
                            @if($user->role === 'admin')
                                <span class="inline-flex items-center text-[10px] font-bold bg-[#e8f0fe] text-[#1a73e8] border border-[#1a73e8]/20 px-3 py-0.5 rounded-full uppercase tracking-wider">
                                    {{ $user->role }}
                                </span>
                            @elseif($user->role === 'seller')
                                <span class="inline-flex items-center text-[10px] font-bold bg-[#fef7e0] text-[#b06000] border border-[#b06000]/20 px-3 py-0.5 rounded-full uppercase tracking-wider">
                                    {{ $user->role }}
                                </span>
                            @else
                                <span class="inline-flex items-center text-[10px] font-bold bg-[#f1f3f4] text-[#5f6368] border border-[#dadce0] px-3 py-0.5 rounded-full uppercase tracking-wider">
                                    {{ $user->role }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex flex-col gap-2 mt-2">
                        <div class="flex gap-2">
                            <a
                                href="{{ route('admin.users.show', $user->id) }}"
                                class="flex-1 inline-flex items-center justify-center rounded-full bg-slate-100 hover:bg-slate-200 py-2 text-xs font-bold text-slate-700 transition gap-1"
                            >
                                <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span>
                                Read
                            </a>

                            <a
                                href="{{ route('admin.users.edit', $user->id) }}"
                                class="flex-1 inline-flex items-center justify-center rounded-full border border-slate-200 bg-white hover:bg-slate-50 py-2 text-xs font-bold text-slate-700 transition gap-1"
                            >
                                <span class="material-symbols-outlined" style="font-size: 16px;">edit</span>
                                Edit
                            </a>
                        </div>

                        <form
                            action="{{ route('admin.users.destroy', $user->id) }}"
                            method="POST"
                            class="w-full m-0"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                onclick="return confirm('Are you sure you want to delete this user?')"
                                class="w-full inline-flex items-center justify-center rounded-full bg-red-55 hover:bg-red-100 border border-red-100 py-2 text-xs font-bold text-red-650 transition gap-1 text-red-600"
                            >
                                <span class="material-symbols-outlined" style="font-size: 16px;">delete_forever</span>
                                Delete
                            </button>
                        </form>
                    </div>

                </div>

                @endforeach

            </div>

            <div class="mt-10">

                {{ $users->links() }}

            </div>

            @else

            <div class="bg-white rounded-2xl shadow-md p-20 text-center">

                <h2 class="text-5xl font-bold text-[#1f232b]">
                    No Users Found
                </h2>

                <p class="text-gray-500 mt-5 text-xl">
                    There are currently no registered users.
                </p>

            </div>

            @endif

            @endisset

        @include('layouts.admin_sidebar_footer')

    @elseif(isset($page) && $page === 'admin-product-form')

    @include('layouts.admin_sidebar')

            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-8">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between mb-8">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-[#202124] tracking-tight">{{ isset($productDetail) ? 'Edit Product' : 'Create New Product' }}</h1>
                        <p class="text-slate-500 mt-2 text-sm font-medium">{{ isset($productDetail) ? 'Update the product details, price, stock and images.' : 'Add a new item to your seller catalog.' }}</p>
                    </div>

                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition">
                        <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                        Back to List
                    </a>
                </div>

                @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl mb-6">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ isset($productDetail) ? route('admin.products.update', $productDetail->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 m-0">
                    @csrf
                    @if(isset($productDetail))
                    @method('PUT')
                    @endif

                    @if(Auth::user()->role === 'admin' && isset($sellers))
                    <div>
                        <label class="block text-xs font-bold text-slate-450 uppercase tracking-wider mb-2" for="seller_id">Seller Profile</label>
                        <select id="seller_id" name="seller_id" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] font-medium text-sm">
                            <option value="">Choose seller</option>
                            @foreach($sellers as $seller)
                            <option value="{{ $seller->id }}" {{ old('seller_id', $productDetail->seller_id ?? '') == $seller->id ? 'selected' : '' }}>{{ $seller->store_name ?? $seller->shop_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block text-xs font-bold text-slate-450 uppercase tracking-wider mb-2" for="name">Product Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $productDetail->name ?? '') }}" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] font-semibold text-sm" required />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-450 uppercase tracking-wider mb-2" for="price">Price (Rupiah)</label>
                            <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $productDetail->price ?? '') }}" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] font-semibold text-sm" required />
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="block text-xs font-bold text-slate-450 uppercase tracking-wider mb-2" for="stock">Available Stock</label>
                            <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $productDetail->stock ?? '') }}" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] font-semibold text-sm" required />
                        </div>

                        <div class="flex items-center gap-3">
                            <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $productDetail->is_active ?? true) ? 'checked' : '' }} class="h-5 w-5 rounded border-slate-350 text-[#1a73e8] focus:ring-[#1a73e8]" />
                            <label for="is_active" class="text-sm font-semibold text-slate-700">Publish product on store</label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-450 uppercase tracking-wider mb-2" for="category_id">Category Tag</label>
                        <select id="category_id" name="category_id" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] font-medium text-sm">
                            <option value="">No category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $productDetail->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-450 uppercase tracking-wider mb-2" for="description">Product Description</label>
                        <textarea id="description" name="description" rows="6" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] font-medium text-sm leading-relaxed">{{ old('description', $productDetail->description ?? '') }}</textarea>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-xs font-bold text-slate-450 uppercase tracking-wider mb-1">Product Photos</label>
                        <p class="text-xs text-slate-500 font-medium">Upload one or more product catalog photos (Max 2MB per file).</p>
                        <input type="file" name="images[]" accept="image/*" multiple class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] text-sm font-semibold file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200" />
                    </div>

                    @if(isset($productDetail) && ($productDetail->image_urls || $productDetail->image_url))
                    <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6">
                        <div class="text-xs font-bold text-slate-450 uppercase tracking-wider mb-4">Existing Product Photos</div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach(array_filter(array_merge([$productDetail->image_url], $productDetail->image_urls ?? [])) as $image)
                            @if($image)
                            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white relative group">
                                <img src="{{ asset($image) }}" alt="Product photo" class="h-32 w-full object-cover" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'150\' height=\'150\' viewBox=\'0 0 150 150\' style=\'background:%23f8f9fa;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f8f9fa\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'10\' fill=\'%235f6368\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image</text></svg>';" />
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="grid gap-4 sm:grid-cols-2 pt-4 border-t border-slate-100">
                        <button type="submit" class="w-full rounded-full bg-[#1a73e8] hover:bg-[#1557b0] px-6 py-3.5 text-base font-semibold text-white transition flex items-center justify-center gap-2 shadow-sm hover:shadow">
                            <span class="material-symbols-outlined" style="font-size: 20px;">save</span>
                            {{ isset($productDetail) ? 'Update Product Details' : 'Create Product Listing' }}
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="w-full inline-flex items-center justify-center rounded-full border border-slate-200 bg-white hover:bg-slate-50 px-6 py-3.5 text-base font-semibold text-slate-700 transition gap-2 shadow-sm">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        @include('layouts.admin_sidebar_footer')

    @elseif(isset($page) && $page === 'product-detail')

    <div class="min-h-screen bg-[#f3f3f3]">

        @include('layouts.navigation')

        <div class="max-w-7xl mx-auto px-6 pt-28 pb-10">

            <div class="mb-6">
                <button type="button" onclick="history.back()" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-[#1f232b] shadow-sm hover:bg-slate-50">← Back</button>
            </div>

            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-8">
                <div class="grid gap-6 xl:grid-cols-[1.5fr_1.05fr]">
                    <div class="rounded-[2rem] overflow-hidden border border-slate-200 bg-slate-50">
                        @php
                        $primaryImage = (is_array($productDetail->image_urls) && isset($productDetail->image_urls[0])) ? $productDetail->image_urls[0] : $productDetail->image_url;
                        @endphp
                        @if($primaryImage)
                        <img
                            src="{{ asset($primaryImage) }}"
                            alt="{{ $productDetail->name }}"
                            class="w-full max-h-[1080px] object-cover"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'600\' height=\'400\' viewBox=\'0 0 600 400\' style=\'background:%23f8f9fa;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f8f9fa\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'16\' fill=\'%235f6368\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image Available</text></svg>';" />
                        @else
                        <div class="w-full h-[28rem] bg-slate-100 flex items-center justify-center text-slate-400 text-lg">
                            Product image not available
                        </div>
                        @endif
                    </div>

                    <div class="space-y-5">
                        <div>
                            <h1 class="text-4xl font-bold text-[#1f232b] break-all">{{ $productDetail->name }}</h1>
                            <p class="text-sm text-gray-500">
                                Seller: {{ $productDetail->seller->user->name ?? 'Unknown Seller' }}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm text-slate-600">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                <div class="text-slate-400">Price</div>
                                <div class="mt-2 text-2xl font-semibold text-[#1f232b] break-all">Rp {{ number_format($productDetail->price,0,',','.') }}</div>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                <div class="text-slate-400">Stock</div>
                                <div class="mt-2 text-2xl font-semibold text-[#1f232b] break-all">{{ $productDetail->stock }}</div>
                            </div>
                        </div>

                        <div class="rounded-[1.7rem] border border-slate-200 bg-slate-50 p-6 text-slate-600">
                            <div class="text-sm uppercase tracking-[0.2em] text-slate-400">Description</div>
                            <p class="mt-3 leading-relaxed break-all">{{ $productDetail->description }}</p>
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

        <footer class="bg-[#1f232b] text-white py-6 mt-16">
            <div class="text-center">© 2026 FILKOMSHOP</div>
        </footer>

    </div>

    @elseif(isset($page) && $page === 'cart')

    <div class="min-h-screen bg-[#f3f3f3] flex flex-col">

        @include('layouts.navigation')

        <div class="max-w-4xl mx-auto px-6 pt-28 pb-16 flex-1">

            <h2 class="text-3xl font-extrabold text-gray-900 mb-8 tracking-tight">Your Shopping Cart</h2>

            @if(session('success'))

            <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl mb-6 text-sm font-medium">

                {{ session('success') }}

            </div>

            @endif

            @if(session('error'))

            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl mb-6 text-sm font-medium">

                {{ session('error') }}

            </div>

            @endif

            @if(isset($items) && $items->count() > 0)

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 md:p-8 w-full">

                <div class="space-y-6">

                    @foreach($items as $item)

                    <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-gray-100 pb-6 gap-4">

                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden border border-gray-200 bg-gray-55 flex items-center justify-center flex-shrink-0">
                                @if($item->product->image_url)
                                <img src="{{ asset($item->product->image_url) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'150\' height=\'150\' viewBox=\'0 0 150 150\' style=\'background:%23f8f9fa;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f8f9fa\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'11\' fill=\'%235f6368\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image</text></svg>';" />
                                @else
                                <div class="w-full h-full bg-slate-50 flex flex-col items-center justify-center text-slate-400">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">image_not_supported</span>
                                </div>
                                @endif
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-base font-semibold text-gray-900 break-all leading-snug">{{ $item->product->name }}</h3>
                                <p class="text-sm font-semibold text-gray-700 break-all">Rp {{ number_format($item->product->price,0,',','.') }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-3">

                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-16 px-2.5 py-1.5 border border-gray-300 rounded-full text-center text-sm font-medium outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" />
                                <button class="bg-blue-55 hover:bg-blue-100 text-blue-600 border border-blue-200 px-4 py-1.5 rounded-full text-xs font-semibold transition">Update</button>
                            </form>

                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Remove this item from cart?')" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-1.5 rounded-full text-xs font-semibold transition">Remove</button>
                            </form>

                        </div>

                    </div>

                    @endforeach

                </div>

                <div class="mt-8 flex justify-end">

                    <div class="text-right w-full sm:w-auto">
                        @php
                        $total = $items->reduce(function($carry, $i){ return $carry + ($i->product->price * $i->quantity); }, 0);
                        @endphp
                        <div class="text-sm text-gray-500 font-medium">Subtotal</div>
                        <div class="text-3xl font-extrabold text-gray-900 mt-1">Rp {{ number_format($total,0,',','.') }}</div>
                        <div class="mt-6">
                            <form action="{{ route('cart.checkout') }}" method="POST">

                                @csrf

                                <button
                                    type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-8 rounded-full text-base font-semibold shadow-sm hover:shadow transition">
                                    Proceed To Checkout
                                </button>

                            </form>
                        </div>
                    </div>

                </div>

            </div>

            @else

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-16 text-center w-full">

                <span class="material-symbols-outlined text-gray-300" style="font-size: 56px; margin-bottom: 12px;">shopping_cart</span>
                <h2 class="text-xl font-bold text-gray-900">Your cart is empty</h2>

                <p class="text-gray-500 mt-2 text-sm">Browse products and add items to your cart.</p>

                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-sm transition">Browse Products</a>
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
                    class="bg-[#1f232b] hover:bg-[#343a46] text-white px-6 py-3 rounded-xl font-semibold">
                    Login
                </a>

                <a
                    href="{{ route('register') }}"
                    class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-3 rounded-xl font-semibold">
                    Register
                </a>

                @else

                @if(Auth::check() && Auth::user()->role === 'admin')

                <a
                    href="{{ route('admin.products.index') }}"
                    class="bg-[#1f232b] hover:bg-[#343a46] text-white px-6 py-3 rounded-xl font-semibold">
                    Open Item Management
                </a>

                @else

                <a
                    href="{{ route('products.index') }}"
                    class="bg-[#1f232b] hover:bg-[#343a46] text-white px-6 py-3 rounded-xl font-semibold">
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