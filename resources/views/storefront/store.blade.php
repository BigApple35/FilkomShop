<!DOCTYPE html>
<html>
<head>
    <title>Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <a href="/" class="btn btn-secondary mb-4">
        Back
    </a>

    <h1 class="mb-4">
        {{ $seller->store_name ?? 'Seller Store' }}
    </h1>

    <div class="row">

        @forelse($products as $product)

            <div class="col-md-3 mb-4">

                <div class="card h-100 shadow-sm">

                    <img
                        src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200' }}"
                        class="card-img-top"
                        style="height:200px; object-fit:cover;"
                    >

                    <div class="card-body">

                        <h5>
                            {{ $product->name }}
                        </h5>

                        <p>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <a
                            href="/product/{{ $product->id }}"
                            class="btn btn-dark"
                        >
                            View Item
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <h5>
                No products found
            </h5>

        @endforelse

    </div>

</div>

</body>
</html>
