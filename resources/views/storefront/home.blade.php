<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILKOMSHOP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            background-color: #f8f9fa;
        }

        .hero-section {
            background: #e8f0fe !important;
            color: #1967d2 !important;
            padding: 48px !important;
            border-radius: 24px !important;
        }

        .hero-section p {
            color: #3c4043 !important;
            font-weight: 500;
        }

        .product-card {
            border: 1px solid #dadce0 !important;
            border-radius: 16px !important;
            overflow: hidden;
            background-color: #ffffff;
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(60,64,67,0.08) !important;
        }

        .product-image {
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #dadce0;
        }

        .price {
            font-weight: 800;
            font-size: 18px;
            color: #202124 !important;
        }

        .stock-badge {
            align-self: flex-start;
            font-size: 11px;
            font-weight: 700;
            background-color: #e6f4ea !important;
            color: #137333 !important;
            padding: 4px 10px;
            border-radius: 100px;
            border: 1px solid #34a853;
        }

        .btn-google-solid {
            background-color: #1a73e8 !important;
            border-color: #1a73e8 !important;
            color: #ffffff !important;
            border-radius: 100px !important;
            font-weight: 600;
            padding: 8px 16px;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-google-solid:hover {
            background-color: #1557b0 !important;
            color: #ffffff !important;
        }

        .btn-google-outline-primary {
            background-color: #ffffff !important;
            border: 1px solid #dadce0 !important;
            color: #1a73e8 !important;
            border-radius: 100px !important;
            font-weight: 600;
            padding: 8px 16px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-google-outline-primary:hover {
            background-color: #f8f9fa !important;
            border-color: #1a73e8 !important;
            color: #1a73e8 !important;
        }

        .btn-google-outline-secondary {
            background-color: #ffffff !important;
            border: 1px solid #dadce0 !important;
            color: #5f6368 !important;
            border-radius: 100px !important;
            font-weight: 600;
            padding: 8px 16px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-google-outline-secondary:hover {
            background-color: #f1f3f4 !important;
            color: #202124 !important;
        }

        .main-store-container {
            margin-top: 80px;
        }

    </style>
</head>
<body>

<!-- NAVBAR -->

@include('layouts.navigation')

<!-- CONTENT -->

<div class="container py-5 main-store-container">

    <!-- HERO -->

    <div class="hero-section mb-5">

        <h1 class="fw-bold">
            Welcome to FILKOMSHOP
        </h1>

        <p class="mt-3">
            Discover the best products from trusted sellers.
        </p>

    </div>

    <!-- TITLE -->

    <div class="mb-4">

        <h2 class="fw-bold">
            Storefront
        </h2>

        <p class="text-muted">
            Browse all available products
        </p>

    </div>

    <!-- PRODUCTS -->

    <div class="row">

        @forelse($products as $product)

            <div class="col-md-3 mb-4">

                <div class="card product-card shadow-sm h-100">

                    @if($product->image_url)
                    <img
                        src="{{ asset($product->image_url) }}"
                        class="card-img-top product-image"
                        alt="{{ $product->name }}"
                        onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'300\' height=\'200\' viewBox=\'0 0 300 200\' style=\'background:%23f8f9fa;\'><rect width=\'100%\' height=\'100%\' fill=\'%23f8f9fa\'/><text x=\'50%\' y=\'50%\' font-family=\'sans-serif\' font-size=\'14\' fill=\'%235f6368\' text-anchor=\'middle\' dominant-baseline=\'middle\'>No Image Available</text></svg>';"
                    >
                    @else
                    <div class="w-full product-image border-bottom border-gray-100 d-flex flex-column align-items-center justify-content-center text-secondary bg-light" style="height: 200px; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                        <span class="material-symbols-outlined text-muted" style="font-size: 36px; margin-bottom: 4px;">image_not_supported</span>
                        <span class="small text-muted font-medium" style="font-size: 11px;">No image available</span>
                    </div>
                    @endif

                    <div class="card-body d-flex flex-column">

                        <h5 class="fw-bold text-gray-900" style="font-size: 15px; font-weight: 700; color: #202124; margin-bottom: 8px;">
                            {{ $product->name }}
                        </h5>

                        <p class="text-muted small mb-2" style="font-size: 13px; color: #5f6368; line-height: 1.4;">

                            {{ Str::limit($product->description, 60) }}

                        </p>

                        <span class="badge bg-success stock-badge mb-2">

                            Stock: {{ $product->stock }}

                        </span>

                        <h5 class="price text-dark mb-3">

                            Rp {{ number_format($product->price, 0, ',', '.') }}

                        </h5>

                        <div class="mt-auto">

                            <!-- VIEW ITEM -->

                            <a
                                href="/product/{{ $product->id }}"
                                class="btn btn-google-solid w-100 mb-2"
                            >
                                View Item
                            </a>

                            <!-- ADD TO CART -->

                            @auth

                                <a
                                    href="/cart/add/{{ $product->id }}"
                                    class="btn btn-google-outline-primary w-100 mb-2"
                                >
                                    Add to Cart
                                </a>

                            @endauth

                            <!-- VISIT STORE -->

                            <a
                                href="/store/{{ $product->seller_id }}"
                                class="btn btn-google-outline-secondary w-100"
                            >
                                Visit Store
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="text-center py-5 bg-white rounded shadow-sm">

                    <h3 class="fw-bold">
                        No Products Yet
                    </h3>

                    <p class="text-muted">
                        Products will appear here once sellers add items.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

<!-- FOOTER -->

<footer class="bg-dark text-white text-center py-3 mt-5">

    <p class="mb-0">
        © 2026 FILKOMSHOP
    </p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
