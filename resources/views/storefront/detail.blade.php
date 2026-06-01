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

    <!-- REVIEWS SECTION -->
    <div class="mt-8 bg-white rounded-[2rem] border border-slate-200 shadow-xl p-6 md:p-10 space-y-8">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl mb-6 text-sm font-medium flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @php
            $reviews = $product->reviews()->latest()->get();
            $reviewsCount = $reviews->count();
            $avgRating = $reviewsCount > 0 ? round($reviews->avg('rating'), 1) : 0;
            $fullStars = floor($avgRating);
            $hasHalfStar = ($avgRating - $fullStars) >= 0.5;
            $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
        @endphp

        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-slate-100 pb-6 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-[#202124] tracking-tight flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#1a73e8]" style="font-size: 32px;">rate_review</span>
                    Product Reviews & Ratings
                </h2>
                <p class="text-slate-500 text-sm mt-1">What our customers say about this product</p>
            </div>
            
            <div class="flex items-center gap-4 bg-slate-50 border border-slate-200 px-5 py-3 rounded-3xl shadow-sm">
                <div class="text-center pr-4 border-r border-slate-200">
                    <div class="text-3xl font-black text-[#202124]">{{ $avgRating > 0 ? $avgRating : 'N/A' }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Average</div>
                </div>
                <div>
                    <div class="flex items-center text-amber-500 gap-0.5">
                        @for($i = 0; $i < $fullStars; $i++)
                            <span class="material-symbols-outlined fill-current" style="font-variation-settings: 'FILL' 1; font-size: 20px;">star</span>
                        @endfor
                        @if($hasHalfStar)
                            <span class="material-symbols-outlined fill-current" style="font-variation-settings: 'FILL' 1; font-size: 20px;">star_half</span>
                        @endif
                        @for($i = 0; $i < $emptyStars; $i++)
                            <span class="material-symbols-outlined" style="font-size: 20px;">star</span>
                        @endfor
                    </div>
                    <div class="text-xs font-semibold text-slate-650 mt-1">{{ $reviewsCount }} {{ Str::plural('review', $reviewsCount) }}</div>
                </div>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1.5fr_1fr] items-start pt-4">
            <!-- LEFT: REVIEWS LIST -->
            <div class="space-y-6">
                @forelse($reviews as $rev)
                    <div class="bg-slate-50/50 border border-slate-150 rounded-[1.8rem] p-6 space-y-4 hover:border-slate-350 transition shadow-sm relative">
                        <div class="flex items-center justify-between pr-8">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#1a73e8] text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                    {{ strtoupper(substr($rev->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-extrabold text-[#202124] text-sm">{{ $rev->user->name }}</h4>
                                    <div class="text-[10px] text-slate-400 font-semibold mt-0.5">
                                        {{ $rev->created_at->format('d M Y, H:i') }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-0.5 text-amber-500 bg-amber-50 border border-amber-100 px-2.5 py-1 rounded-full">
                                <span class="material-symbols-outlined fill-current text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-xs font-bold text-amber-700">{{ $rev->rating }}</span>
                            </div>
                        </div>
                        
                        @if($rev->comment)
                            <p class="text-sm text-slate-700 leading-relaxed break-all font-medium whitespace-pre-line pl-1">{{ $rev->comment }}</p>
                        @else
                            <p class="text-sm text-slate-400 italic pl-1">No comment written.</p>
                        @endif

                        @auth
                            @if(Auth::user()->role === 'admin' || Auth::id() === $rev->user_id)
                                <form action="{{ route('reviews.destroy', $rev->id) }}" method="POST" class="absolute top-4 right-4 m-0" onsubmit="return confirm('Delete this review?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-full bg-red-50 border border-red-100 hover:bg-red-100 text-red-600 hover:text-red-700 flex items-center justify-center transition shadow-sm" title="Delete Review">
                                        <span class="material-symbols-outlined text-base">delete</span>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @empty
                    <div class="text-center py-12 text-slate-400 border-2 border-dashed border-slate-200 rounded-[1.8rem] bg-slate-50/20">
                        <span class="material-symbols-outlined text-slate-300 mb-2" style="font-size: 48px;">rate_review</span>
                        <div class="text-base font-bold text-slate-800">No reviews yet</div>
                        <div class="text-sm mt-1">Be the first to share your experience with this item!</div>
                    </div>
                @endforelse
            </div>

            <!-- RIGHT: SUBMIT REVIEW FORM -->
            <div class="bg-slate-50 border border-slate-200 rounded-[1.8rem] p-6 md:p-8 space-y-6 shadow-sm">
                @auth
                    <div>
                        <h3 class="text-lg font-black text-[#202124] tracking-tight">Share Your Review</h3>
                        <p class="text-xs text-slate-500 mt-1">Have you purchased or used this product? Leave your rating and comments below.</p>
                    </div>

                    <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="space-y-4 m-0">
                        @csrf
                        
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Your Rating</label>
                            <!-- Star Selection Input -->
                            <div class="flex items-center gap-2" id="starRatingSelector">
                                @for($val = 1; $val <= 5; $val++)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $val }}" class="hidden" {{ $val == 5 ? 'checked' : '' }} />
                                        <span class="material-symbols-outlined star-icon text-slate-300 hover:text-amber-400 transition" style="font-size: 32px;" data-value="{{ $val }}">star</span>
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="comment" class="block text-xs font-bold text-slate-500 uppercase tracking-widest pl-1">Your Comment <span class="text-slate-400 font-normal">(Optional)</span></label>
                            <textarea 
                                name="comment" 
                                id="comment" 
                                rows="4" 
                                placeholder="What did you like or dislike? How is the quality of the product?"
                                class="w-full p-4 text-sm border border-slate-200 rounded-2xl outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] bg-white transition resize-none box-border"
                            ></textarea>
                        </div>

                        <button 
                            type="submit"
                            class="w-full inline-flex items-center justify-center rounded-full bg-[#1a73e8] hover:bg-[#1557b0] py-3.5 text-sm font-semibold text-white transition gap-2 shadow-sm"
                        >
                            <span class="material-symbols-outlined" style="font-size: 18px;">send</span>
                            Submit Review
                        </button>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const starContainer = document.getElementById('starRatingSelector');
                            if (starContainer) {
                                const radios = starContainer.querySelectorAll('input[type="radio"]');
                                const stars = starContainer.querySelectorAll('.star-icon');
                                
                                function updateStars(rating) {
                                    stars.forEach((star, index) => {
                                        if (index < rating) {
                                            star.classList.remove('text-slate-300');
                                            star.classList.add('text-amber-500', 'fill-current');
                                            star.style.fontVariationSettings = "'FILL' 1";
                                        } else {
                                            star.classList.remove('text-amber-500', 'fill-current');
                                            star.classList.add('text-slate-300');
                                            star.style.fontVariationSettings = "'FILL' 0";
                                        }
                                    });
                                }

                                // Initial load
                                const checkedVal = starContainer.querySelector('input[type="radio"]:checked')?.value || 5;
                                updateStars(checkedVal);

                                stars.forEach(star => {
                                    star.addEventListener('click', (e) => {
                                        const val = parseInt(e.target.getAttribute('data-value'));
                                        const radio = starContainer.querySelector(`input[value="${val}"]`);
                                        if (radio) {
                                            radio.checked = true;
                                            updateStars(val);
                                        }
                                    });

                                    star.addEventListener('mouseover', (e) => {
                                        const val = parseInt(e.target.getAttribute('data-value'));
                                        stars.forEach((s, index) => {
                                            if (index < val) {
                                                s.classList.add('text-amber-400');
                                            }
                                        });
                                    });

                                    star.addEventListener('mouseout', () => {
                                        const currentVal = starContainer.querySelector('input[type="radio"]:checked')?.value || 0;
                                        updateStars(currentVal);
                                    });
                                });
                            }
                        });
                    </script>
                @else
                    <div class="text-center py-6">
                        <span class="material-symbols-outlined text-slate-350" style="font-size: 48px; margin-bottom: 8px;">lock</span>
                        <h3 class="text-base font-bold text-slate-800">Login to leave a review</h3>
                        <p class="text-xs text-slate-500 mt-2">Only registered and logged-in customers can submit reviews for this product.</p>
                        <div class="mt-4">
                            <a 
                                href="{{ route('login') }}" 
                                class="inline-flex w-full items-center justify-center rounded-full bg-[#1a73e8] hover:bg-[#1557b0] py-2.5 text-sm font-semibold text-white transition shadow-sm"
                            >
                                Login Now
                            </a>
                        </div>
                    </div>
                @endauth
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
