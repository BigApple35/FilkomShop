<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - FILKOMSHOP</title>

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
<div class="max-w-4xl mx-auto px-6 pt-28 pb-16 flex-1 w-full">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-[#202124] tracking-tight flex items-center gap-2">
            <span class="material-symbols-outlined text-[#1a73e8]" style="font-size: 32px;">shopping_cart</span>
            Shopping Cart
        </h1>
        <a 
            href="/" 
            class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 transition"
        >
            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
            Continue Shopping
        </a>
    </div>

    @if(count($items) > 0)

        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-6 md:p-8 space-y-6">

            @foreach($items as $item)

                <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-100 pb-6 last:border-0 last:pb-0 gap-4">
                    
                    <div class="flex items-center gap-4">
                        <!-- PRODUCT IMAGE OR FALLBACK -->
                        <div class="w-20 h-20 rounded-2xl overflow-hidden border border-slate-200 bg-[#f8f9fa] flex items-center justify-center flex-shrink-0 relative">
                            @if($item->product->image_url)
                            <img 
                                src="{{ asset($item->product->image_url) }}" 
                                alt="{{ $item->product->name }}" 
                                class="w-full h-full object-cover"
                                onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\' viewBox=\'0 0 100 100\' style=\'background:%23f8f9fa;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f8f9fa\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'11\' fill=\'%235f6368\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image</text></svg>';"
                            />
                            @else
                            <div class="flex flex-col items-center justify-center text-slate-400">
                                <span class="material-symbols-outlined" style="font-size: 24px; margin-bottom: 2px;">image_not_supported</span>
                                <span class="text-[9px] font-bold">No image</span>
                            </div>
                            @endif
                        </div>

                        <!-- PRODUCT DETAILS -->
                        <div class="space-y-1">
                            <h3 class="font-extrabold text-[#202124] text-base leading-snug break-all line-clamp-1">
                                {{ $item->product->name }}
                            </h3>
                            <p class="text-sm font-semibold text-[#1a73e8]">
                                Rp {{ number_format($item->product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- QUANTITY AND ACTIONS -->
                    <div class="flex items-center justify-between sm:justify-start gap-4">
                        
                        <div class="text-sm font-semibold text-slate-650 flex items-center gap-1 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-full">
                            <span class="text-slate-450 uppercase tracking-wider text-xs">Qty:</span>
                            <span class="text-[#202124] font-black text-sm">{{ $item->quantity }}</span>
                        </div>

                        <div class="text-base font-extrabold text-[#202124] min-w-[100px] text-right">
                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </div>

                        <!-- DELETE ACTIONS -->
                        <a 
                            href="/cart/delete/{{ $item->id }}"
                            onclick="return confirm('Remove this item from your cart?')"
                            class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-red-50 hover:bg-red-100 border border-red-100 text-red-600 hover:text-red-700 transition"
                        >
                            <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                        </a>

                    </div>

                </div>

            @endforeach

            <!-- CHECKOUT BLOCK -->
            <div class="mt-8 pt-8 border-t border-slate-100 flex justify-end">
                <div class="text-right w-full sm:w-auto">
                    @php
                    $total = array_reduce($items->toArray(), function($carry, $i) { 
                        return $carry + ($i['product']['price'] * $i['quantity']); 
                    }, 0);
                    @endphp
                    
                    <div class="text-xs font-bold text-slate-450 uppercase tracking-wider">Subtotal</div>
                    <div class="text-3xl font-black text-[#202124] mt-1">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </div>
                    
                    <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-end">
                        <a 
                            href="/" 
                            class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white hover:bg-slate-50 px-6 py-3.5 text-base font-semibold text-slate-700 transition gap-2 shadow-sm"
                        >
                            <span class="material-symbols-outlined" style="font-size: 20px;">storefront</span>
                            Add More Items
                        </a>
                        
                        <!-- Form checkout pointing to index/route of choice -->
                        <form action="{{ route('cart.checkout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button 
                                type="submit"
                                class="inline-flex w-full sm:w-auto items-center justify-center rounded-full bg-[#1a73e8] hover:bg-[#1557b0] px-8 py-3.5 text-base font-semibold text-white transition gap-2 shadow-sm"
                            >
                                <span class="material-symbols-outlined" style="font-size: 20px;">shopping_bag</span>
                                Proceed to Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    @else

        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-16 text-center w-full">
            <span class="material-symbols-outlined text-slate-300" style="font-size: 64px; margin-bottom: 12px;">shopping_cart</span>
            <h2 class="text-xl font-bold text-slate-800">Your cart is empty</h2>
            <p class="text-slate-500 mt-2 text-sm">Browse products and add items to your cart.</p>
            <div class="mt-6">
                <a 
                    href="/" 
                    class="inline-flex items-center justify-center bg-[#1a73e8] hover:bg-[#1557b0] text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-sm transition"
                >
                    Browse Products
                </a>
            </div>
        </div>

    @endif

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-4 mt-16 bg-[#1f232b]">
    <p class="mb-0 text-sm text-slate-400">
        © 2026 FILKOMSHOP. All rights reserved.
    </p>
</footer>

</body>
</html>
