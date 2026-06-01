<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - FILKOMSHOP</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f3f3f3;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

<!-- NAVBAR -->
@include('layouts.navigation')

<!-- MAIN CONTENT -->
<div class="max-w-7xl mx-auto px-6 pt-28 pb-16 flex-1 w-full">

    <!-- BACK BUTTON -->
    <div class="mb-8">
        <a 
            href="/" 
            class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-[#1f232b] shadow-sm hover:bg-slate-50 transition"
        >
            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
            Back to Store
        </a>
    </div>

    <!-- PRODUCT DETAIL CARD -->
    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-6 md:p-10">
        
        <div class="grid gap-8 lg:grid-cols-[1.2fr_1fr]">
            
            <!-- LEFT: IMAGE PORTFOLIO -->
            <div class="rounded-[1.8rem] overflow-hidden border border-slate-200 bg-slate-55 flex items-center justify-center relative min-h-[300px] max-h-[550px] bg-[#f8f9fa]">
                @if($product->image_url)
                <img
                    src="{{ asset($product->image_url) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-cover max-h-[550px]"
                    onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'600\' height=\'400\' viewBox=\'0 0 600 400\' style=\'background:%23f8f9fa;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f8f9fa\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'16\' fill=\'%235f6368\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image Available</text></svg>';"
                />
                @else
                <div class="flex flex-col items-center justify-center text-slate-400 p-10">
                    <span class="material-symbols-outlined text-slate-350" style="font-size: 64px; margin-bottom: 12px;">image_not_supported</span>
                    <span class="text-sm font-semibold text-slate-500">No image available</span>
                </div>
                @endif
            </div>

            <!-- RIGHT: MAIN INFORMATION -->
            <div class="flex flex-col justify-between space-y-6">
                
                <div class="space-y-4">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-[#202124] break-all leading-tight">
                            {{ $product->name }}
                        </h1>
                        <p class="text-sm text-slate-500 mt-2 flex items-center gap-1.5 font-medium">
                            <span class="material-symbols-outlined text-slate-400" style="font-size: 18px;">store</span>
                            Seller: <span class="text-slate-800 font-semibold">{{ $product->seller->store_name ?? $product->seller->user->name ?? 'FilkomShop Seller' }}</span>
                        </p>
                    </div>

                    <!-- METRICS GRID -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-slate-450 text-xs font-semibold uppercase tracking-wider">Price</div>
                            <div class="mt-1.5 text-2xl font-extrabold text-[#1a73e8] break-all">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="text-slate-450 text-xs font-semibold uppercase tracking-wider">Stock</div>
                            <div class="mt-1.5 text-2xl font-extrabold text-[#202124] break-all">
                                {{ $product->stock }}
                            </div>
                        </div>
                    </div>

                    <!-- DESCRIPTION PANEL -->
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 text-slate-700">
                        <div class="text-xs uppercase tracking-[0.15em] text-slate-450 font-bold mb-2">Description</div>
                        <p class="text-sm leading-relaxed whitespace-pre-line break-all font-medium text-slate-650">
                            {{ $product->description ?? 'No description available for this product.' }}
                        </p>
                    </div>
                </div>

                <!-- ADD TO CART & CHECKOUT TRIGGERS -->
                <div class="pt-4 border-t border-slate-100">
                    @if($product->stock > 0)
                        @auth
                        <form action="{{ route('cart.store') }}" method="POST" class="grid gap-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                <div class="flex items-center justify-between rounded-full border border-slate-200 bg-slate-50 px-4 py-2.5 sm:w-44 flex-shrink-0">
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Qty</span>
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        min="1" 
                                        max="{{ $product->stock }}" 
                                        value="1" 
                                        class="w-16 rounded-full border border-slate-300 bg-white px-2 py-1 text-center text-sm font-bold text-slate-900 focus:outline-none focus:border-[#1a73e8]" 
                                    />
                                </div>
                                
                                <button 
                                    type="submit" 
                                    class="w-full rounded-full bg-[#1a73e8] hover:bg-[#1557b0] px-6 py-3.5 text-base font-semibold text-white transition flex items-center justify-center gap-2 shadow-sm hover:shadow"
                                >
                                    <span class="material-symbols-outlined" style="font-size: 20px;">add_shopping_cart</span>
                                    Add to Cart
                                </button>
                            </div>
                        </form>
                        @else
                        <div class="grid gap-3">
                            <a 
                                href="{{ route('login') }}" 
                                class="inline-flex w-full items-center justify-center rounded-full bg-[#1a73e8] hover:bg-[#1557b0] px-6 py-3.5 text-base font-semibold text-white transition gap-2"
                            >
                                <span class="material-symbols-outlined" style="font-size: 20px;">login</span>
                                Login to Add to Cart
                            </a>
                        </div>
                        @endauth

                        <div class="mt-3">
                            <a 
                                href="{{ route('cart.index') }}" 
                                class="inline-flex w-full items-center justify-center rounded-full border border-[#dadce0] bg-white hover:bg-slate-50 px-6 py-3.5 text-base font-semibold text-slate-700 transition gap-2 shadow-sm"
                            >
                                <span class="material-symbols-outlined" style="font-size: 20px;">shopping_bag</span>
                                Go to Checkout
                            </a>
                        </div>
                    @else
                        <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-center text-red-700 font-semibold flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">error</span>
                            This product is currently out of stock
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-16 bg-[#1f232b]">
    <p class="mb-0 text-sm text-slate-400">
        © 2026 FILKOMSHOP. All rights reserved.
    </p>
</footer>

</body>
</html>
