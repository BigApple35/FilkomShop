<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <h1 class="mb-4">
        Add Product
    </h1>

    <form action="/admin/products/store" method="POST">

        @csrf

        <div class="mb-3">

            <label>Name</label>

            <input type="text" name="name" class="form-control">

        </div>

        <div class="mb-3">

            <label>Description</label>

            <textarea name="description" class="form-control"></textarea>

        </div>

        <div class="mb-3">

            <label>Price</label>

            <input type="number" name="price" class="form-control">

        </div>

        <div class="mb-3">

            <label>Stock</label>

            <input type="number" name="stock" class="form-control">

        </div>

        <div class="mb-3">

            <label>Image URL</label>

            <input type="text" name="image_url" class="form-control">

        </div>

        <button class="btn btn-dark">
            Save Product
        </button>

    </form>

</div>

</body>
</html>
