<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>
            Shopping Cart
        </h1>

        <a href="/" class="btn btn-dark">
            Back to Store
        </a>

    </div>

    @forelse($items as $item)

        <div class="card mb-3 shadow-sm">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-2">

                        <img
                            src="{{ $item->product->image_url ?? 'https://via.placeholder.com/150' }}"
                            class="img-fluid rounded"
                        >

                    </div>

                    <div class="col-md-4">

                        <h5>
                            {{ $item->product->name }}
                        </h5>

                    </div>

                    <div class="col-md-2">

                        Qty:
                        {{ $item->quantity }}

                    </div>

                    <div class="col-md-2">

                        Rp {{ number_format($item->product->price, 0, ',', '.') }}

                    </div>

                    <div class="col-md-2">

                        <a
                            href="/cart/delete/{{ $item->id }}"
                            class="btn btn-danger"
                        >
                            Delete
                        </a>

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="alert alert-warning text-center">

            Cart is empty

        </div>

    @endforelse

</div>

</body>
</html>
