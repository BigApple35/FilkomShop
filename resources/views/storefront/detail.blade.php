<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <a href="/" class="btn btn-secondary mb-4">
        Back
    </a>

    <div class="row">

        <div class="col-md-6">

            <img
                src="{{ $product->image_url ?? 'https://via.placeholder.com/500x400' }}"
                class="img-fluid rounded"
            >

        </div>

        <div class="col-md-6">

            <h1>
                {{ $product->name }}
            </h1>

            <h3 class="my-3">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </h3>

            <p>
                {{ $product->description }}
            </p>

            <p>
                Stock: {{ $product->stock }}
            </p>

        </div>

    </div>

</div>

</body>
</html>
