<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILKOMSHOP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            background-color: #f5f5f5;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
        }

        .hero-section {
            background: linear-gradient(135deg, #212529, #343a40);
            color: white;
            padding: 60px;
            border-radius: 20px;
        }

        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            height: 220px;
            object-fit: cover;
        }

        .price {
            font-weight: bold;
            font-size: 20px;
        }

        .stock-badge {
            font-size: 12px;
        }

    </style>
</head>
<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

    <div class="container">

        <a class="navbar-brand" href="/">
            FILKOMSHOP
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto ms-4">

                <li class="nav-item">

                    <a class="nav-link active" href="/">
                        Home
                    </a>

                </li>

            </ul>

            <!-- SEARCH -->

            <form action="/" method="GET" class="d-flex me-3">

                <input
                    type="text"
                    name="search"
                    class="form-control me-2"
                    placeholder="Search product..."
                    value="{{ request('search') }}"
                >

                <button class="btn btn-light">
                    Search
                </button>

            </form>

            <!-- AUTH -->

            @guest

                <a href="/login" class="btn btn-outline-light me-2">
                    Login
                </a>

                <a href="/register" class="btn btn-warning">
                    Register
                </a>

            @endguest


            @auth

                <a href="/cart" class="btn btn-warning me-3">
                    Cart
                </a>

                <span class="text-white me-3">

                    Hi, {{ auth()->user()->name }}

                </span>

                <form action="/logout" method="POST">

                    @csrf

                    <button class="btn btn-danger">
                        Logout
                    </button>

                </form>

            @endauth

        </div>

    </div>

</nav>

<!-- CONTENT -->

<div class="container py-5">

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

                    <img
                        src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}"
                        class="card-img-top product-image"
                        alt="Product Image"
                    >

                    <div class="card-body d-flex flex-column">

                        <h5 class="fw-bold">
                            {{ $product->name }}
                        </h5>

                        <p class="text-muted small mb-2">

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
                                class="btn btn-dark w-100 mb-2"
                            >
                                View Item
                            </a>

                            <!-- ADD TO CART -->

                            @auth

                                <a
                                    href="/cart/add/{{ $product->id }}"
                                    class="btn btn-warning w-100 mb-2"
                                >
                                    Add to Cart
                                </a>

                            @endauth

                            <!-- VISIT STORE -->

                            <a
                                href="/store/{{ $product->seller_id }}"
                                class="btn btn-outline-secondary w-100"
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
