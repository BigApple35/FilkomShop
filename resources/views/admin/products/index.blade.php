<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <div class="d-flex justify-content-between mb-4">

        <h1>
            Manage Products
        </h1>

        <a href="/admin/products/create" class="btn btn-dark">
            Add Product
        </a>

    </div>

    <table class="table table-bordered">

        <thead class="table-dark">

            <tr>

                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

            @foreach($products as $product)

                <tr>

                    <td>{{ $product->name }}</td>

                    <td>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td>{{ $product->stock }}</td>

                    <td>

                        <a
                            href="/admin/products/edit/{{ $product->id }}"
                            class="btn btn-warning btn-sm"
                        >
                            Edit
                        </a>

                        <a
                            href="/admin/products/delete/{{ $product->id }}"
                            class="btn btn-danger btn-sm"
                        >
                            Delete
                        </a>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

</body>
</html>
