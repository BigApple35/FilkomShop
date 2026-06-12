<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seller->store_name ?? 'Seller Catalog' }} - FILKOMSHOP</title>

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

<!-- CONTENT -->
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

    <!-- SELLER BANNER -->
    <div class="bg-gradient-to-r from-[#1a73e8] to-[#1557b0] rounded-[2rem] shadow-xl p-8 md:p-12 mb-8 text-white">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center text-3xl font-extrabold select-none">
                {{ strtoupper(substr($seller->store_name ?? $seller->user->name ?? 'S', 0, 1)) }}
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                    {{ $seller->store_name ?? 'Seller Shop' }}
                </h1>
                <p class="text-white/80 font-medium text-sm md:text-base mt-1.5 flex items-center gap-1.5">
                    <span class="material-symbols-outlined" style="font-size: 18px;">person</span>
                    Owner: {{ $seller->user->name ?? 'FilkomShop Member' }}
                </p>
            </div>
        </div>
    </div>

    <!-- PRODUCTS SECTION -->
    <div class="mb-6">
        <h2 class="text-2xl font-extrabold text-[#202124]">
            Store Catalog
        </h2>
        <p class="text-sm text-slate-500 font-medium mt-1">
            Browse all products listed by this seller
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @forelse($products as $product)

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md hover:-translate-y-1 transition duration-200">
                
                <div>
                    <!-- PRODUCT IMAGE -->
                    <div class="h-52 overflow-hidden border-b border-slate-100 bg-[#f8f9fa] relative flex items-center justify-center">
                        @if($product->image_url)
                        <img
                            src="{{ asset($product->image_url) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                            onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'300\' height=\'200\' viewBox=\'0 0 300 200\' style=\'background:%23f8f9fa;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f8f9fa\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'14\' fill=\'%235f6368\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image Available</text></svg>';"
                        >
                        @else
                        <div class="flex flex-col items-center justify-center text-slate-400 p-4">
                            <span class="material-symbols-outlined text-slate-350" style="font-size: 36px; margin-bottom: 4px;">image_not_supported</span>
                            <span class="text-xs font-semibold text-slate-500">No image available</span>
                        </div>
                        @endif
                    </div>

                    <!-- CARD BODY -->
                    <div class="p-5 space-y-3">
                        <h3 class="font-extrabold text-[#202124] text-base line-clamp-1 break-all">
                            {{ $product->name }}
                        </h3>

                        <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed break-all">
                            {{ $product->description ?? 'No description provided.' }}
                        </p>

                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center text-[10px] font-bold bg-[#e6f4ea] text-[#137333] border border-[#34a853]/30 px-2.5 py-0.5 rounded-full">
                                Stock: {{ $product->stock }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-5 pt-0">
                    <div class="text-[#1a73e8] font-black text-lg mb-3">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <a
                        href="/product/{{ $product->id }}"
                        class="inline-flex w-full items-center justify-center rounded-full bg-[#1a73e8] hover:bg-[#1557b0] py-2.5 text-sm font-semibold text-white transition gap-1.5"
                    >
                        <span class="material-symbols-outlined" style="font-size: 18px;">visibility</span>
                        View Details
                    </a>
                </div>

            </div>

        @empty

            <div class="col-span-full">
                <div class="text-center py-16 bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                    <span class="material-symbols-outlined text-slate-300" style="font-size: 56px; margin-bottom: 8px;">category</span>
                    <h3 class="text-xl font-bold text-slate-800">No Products Found</h3>
                    <p class="text-slate-450 text-sm mt-2">This seller hasn't published any products yet.</p>
                </div>
            </div>

        @endforelse

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
