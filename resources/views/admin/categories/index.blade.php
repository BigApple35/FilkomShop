<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FilkomShop - Manage Categories</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#f3f4f6;
            padding:40px;
        }

        .container{
            width:90%;
            max-width:1400px;
            margin:auto;
        }

        .header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .title{
            font-size:40px;
            font-weight:700;
            color:#202124;
        }

        .title span{
            color:#F4B400;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:15px 20px;
            border-radius:10px;
            margin-bottom:20px;
        }

        .card{
            background:#fff;
            padding:20px;
            border-radius:20px;
            box-shadow:0 4px 20px rgba(0,0,0,.08);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        thead{
            background:#202124;
            color:white;
        }

        th{
            padding:18px;
            text-align:left;
            font-size:15px;
            font-weight:600;
        }

        td{
            padding:18px;
            border-bottom:1px solid #e5e5e5;
            font-size:15px;
        }

        tr:hover{
            background:#fafafa;
        }

        .btn{
            text-decoration:none;
            border:none;
            padding:9px 16px;
            border-radius:7px;
            cursor:pointer;
            color:white;
            font-size:13px;
            font-weight:500;
        }

        .btn-view{
            background:#4285F4;
        }

        .btn-delete{
            background:#EA4335;
        }

        .btn-view:hover,
        .btn-delete:hover{
            opacity:.9;
        }

        .empty{
            text-align:center;
            color:#777;
            padding:25px;
        }

        .badge{
            background:#f1f3f4;
            color:#5f6368;
            padding:6px 12px;
            border-radius:20px;
            font-size:13px;
            display:inline-block;
        }

        .stats{
            margin-bottom:15px;
            color:#5f6368;
            font-size:14px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <div class="title">
            Manage <span>Categories</span>
        </div>
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="stats">
        Total Categories: <strong>{{ $categories->count() }}</strong>
    </div>

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>

            @forelse($categories as $category)

                <tr>

                    <td>{{ $category->id }}</td>

                    <td>{{ $category->name }}</td>

                    <td>
                        <span class="badge">
                            {{ $category->slug ?? '-' }}
                        </span>
                    </td>

                    <td>

                        <a
                            href="{{ route('categories.show', $category->id) }}"
                            class="btn btn-view">
                            View
                        </a>

                        <form
                            action="{{ route('categories.destroy', $category->id) }}"
                            method="POST"
                            style="display:inline;"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-delete"
                                onclick="return confirm('Delete this category?')">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4" class="empty">
                        No Categories Found
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>
</html>