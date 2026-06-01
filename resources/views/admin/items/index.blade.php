<!DOCTYPE html>
<html>
<head>
    <title>FilkomShop - Manage Items</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f8f9fa;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .title {
            font-size: 30px;
            font-weight: bold;
            color: #202124;
        }

        .title span {
            color: #F4B400;
        }

        .btn-create {
            background: #F4B400;
            color: #202124;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: bold;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #202124;
            color: white;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e0e0e0;
        }

        tr:hover {
            background: #fafafa;
        }

        .btn-edit {
            background: #4285f4;
            color: white;
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 14px;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-inactive {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <div class="title">
            Manage <span>Items</span>
        </div>

        <a
            href="{{ route('products.create') }}"
            class="btn-create">
            + Add Product
        </a>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)

                    <tr>

                        <td>{{ $product->id }}</td>

                        <td>{{ $product->name }}</td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td>{{ $product->stock }}</td>

                        <td>
                            @if($product->is_active)
                                <span class="status-active">
                                    Active
                                </span>
                            @else
                                <span class="status-inactive">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td>
                            <a
                                href="{{ route('products.edit', $product->id) }}"
                                class="btn-edit">
                                Edit
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6">
                            No products found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>