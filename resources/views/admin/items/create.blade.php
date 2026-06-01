<!DOCTYPE html>
<html>
<head>
    <title>FilkomShop - Create Product</title>

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
            max-width: 800px;
            margin: auto;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 4px 20px rgba(0,0,0,.08);
        }

        .title {
            color: #202124;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .title span {
            color: #F4B400;
        }

        label {
            display: block;
            margin-bottom: 8px;
            margin-top: 15px;
            color: #5f6368;
            font-weight: 600;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #dadce0;
            border-radius: 12px;
            font-size: 14px;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #F4B400;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn {
            margin-top: 25px;
            background: #F4B400;
            color: #202124;
            border: none;
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            opacity: .9;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <div class="title">
            Create <span>Product</span>
        </div>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <label>Seller ID</label>
            <input type="number" name="seller_id">

            <label>Category ID</label>
            <input type="number" name="category_id">

            <label>Product Name</label>
            <input type="text" name="name">

            <label>Description</label>
            <textarea name="description"></textarea>

            <label>Price</label>
            <input type="number" step="0.01" name="price">

            <label>Stock</label>
            <input type="number" name="stock">

            <label>Image URL</label>
            <input type="text" name="image_url">

            <label>Status</label>
            <select name="is_active">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>

            <button type="submit" class="btn">
                Save Product
            </button>

        </form>

    </div>

</div>

</body>
</html>