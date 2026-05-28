<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>
            Edit Product
        </h1>

        <a href="/admin/products" class="btn btn-secondary">
            Back
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <form
                action="/admin/products/update/{{ $product->id }}"
                method="POST"
            >

                @csrf

                <!-- PRODUCT NAME -->

                <div class="mb-3">

                    <label class="form-label">
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ $product->name }}"
                        required
                    >

                </div>

                <!-- DESCRIPTION -->

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                    >{{ $product->description }}</textarea>

                </div>

                <!-- PRICE -->

                <div class="mb-3">

                    <label class="form-label">
                        Price
                    </label>

                    <input
                        type="number"
                        name="price"
                        class="form-control"
                        value="{{ $product->price }}"
                        required
                    >

                </div>

                <!-- STOCK -->

                <div class="mb-3">

                    <label class="form-label">
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        value="{{ $product->stock }}"
                        required
                    >

                </div>

                <!-- IMAGE URL -->

                <div class="mb-4">

                    <label class="form-label">
                        Image URL
                    </label>

                    <input
                        type="text"
                        name="image_url"
                        class="form-control"
                        value="{{ $product->image_url }}"
                    >

                </div>

                <!-- IMAGE PREVIEW -->

                @if($product->image_url)

                    <div class="mb-4">

                        <label class="form-label">
                            Current Image
                        </label>

                        <div>

                            <img
                                src="{{ $product->image_url }}"
                                alt="Product Image"
                                class="img-fluid rounded"
                                style="max-width: 250px;"
                            >

                        </div>

                    </div>

                @endif

                <!-- BUTTON -->

                <button class="btn btn-dark">

                    Update Product

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
