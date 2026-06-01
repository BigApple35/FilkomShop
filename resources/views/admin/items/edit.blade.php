<!DOCTYPE html>
<html>
<head>
    <title>FilkomShop - Edit Product</title>

    <style>
        *{
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#f8f9fa;
            margin:0;
            padding:40px;
        }

        .container{
            max-width:800px;
            margin:auto;
        }

        .card{
            background:white;
            border-radius:20px;
            padding:35px;
            box-shadow:0 4px 20px rgba(0,0,0,.08);
        }

        .title{
            color:#202124;
            font-size:28px;
            font-weight:700;
            margin-bottom:30px;
        }

        .title span{
            color:#F4B400;
        }

        label{
            display:block;
            margin-top:15px;
            margin-bottom:8px;
            color:#5f6368;
            font-weight:600;
        }

        input,
        textarea,
        select{
            width:100%;
            padding:12px 15px;
            border:1px solid #dadce0;
            border-radius:12px;
            font-size:14px;
        }

        input:focus,
        textarea:focus,
        select:focus{
            outline:none;
            border-color:#F4B400;
        }

        textarea{
            resize:vertical;
            min-height:120px;
        }

        .btn{
            margin-top:25px;
            background:#F4B400;
            color:#202124;
            border:none;
            padding:14px 30px;
            border-radius:12px;
            font-weight:bold;
            cursor:pointer;
        }

        .btn:hover{
            opacity:.9;
        }

        .error{
            color:red;
            margin-bottom:15px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <div class="title">
            Edit <span>Product</span>
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

        <form action="{{ route('products.update', $product->id) }}" method="POST">

            @csrf
            @method('PUT')

            <label>Seller ID</label>
            <input
                type="number"
                name="seller_id"
                value="{{ old('seller_id', $product->seller_id) }}"
                required>

            <label>Category ID</label>
            <input
                type="number"
                name="category_id"
                value="{{ old('category_id', $product->category_id) }}"
                required>

            <label>Product Name</label>
            <input
                type="text"
                name="name"
                value="{{ old('name', $product->name) }}"
                required>

            <label>Description</label>
            <textarea name="description" required>{{ old('description', $product->description) }}</textarea>

            <label>Price</label>
            <input
                type="number"
                step="0.01"
                name="price"
                value="{{ old('price', $product->price) }}"
                required>

            <label>Stock</label>
            <input
                type="number"
                name="stock"
                value="{{ old('stock', $product->stock) }}"
                required>

            <label>Image URL</label>
            <input
                type="text"
                name="image_url"
                value="{{ old('image_url', $product->image_url) }}">

            <label>Status</label>
            <select name="is_active">

                <option value="1"
                    {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>
                    Active
                </option>

                <option value="0"
                    {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>

            <button type="submit" class="btn">
                Update Product
            </button>

        </form>

    </div>

</div>

</body>
</html>