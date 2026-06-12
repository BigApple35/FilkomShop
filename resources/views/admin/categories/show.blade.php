<!DOCTYPE html>
<html>
<head>
    <title>Category Detail</title>

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
            width:800px;
            margin:auto;
        }

        .title{
            font-size:28px;
            font-weight:bold;
            color:#202124;
            margin-bottom:25px;
        }

        .title span{
            color:#F4B400;
        }

        .card{
            background:white;
            border-radius:20px;
            padding:30px;
            box-shadow:0 3px 15px rgba(0,0,0,.08);
        }

        .row{
            margin-bottom:20px;
            padding-bottom:15px;
            border-bottom:1px solid #eee;
        }

        .label{
            display:block;
            font-size:14px;
            color:#5f6368;
            margin-bottom:5px;
            font-weight:600;
        }

        .value{
            font-size:18px;
            color:#202124;
        }

        .actions{
            margin-top:30px;
        }

        .btn{
            text-decoration:none;
            padding:10px 18px;
            border-radius:8px;
            font-size:14px;
            font-weight:600;
            color:white;
            display:inline-block;
        }

        .btn-back{
            background:#F4B400;
            color:#202124;
        }

        .btn-back:hover{
            opacity:.9;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="title">
        Category <span>Detail</span>
    </div>

    <div class="card">

        <div class="row">
            <span class="label">Category ID</span>
            <div class="value">
                {{ $category->id }}
            </div>
        </div>

        <div class="row">
            <span class="label">Category Name</span>
            <div class="value">
                {{ $category->name }}
            </div>
        </div>

        <div class="row">
            <span class="label">Slug</span>
            <div class="value">
                {{ $category->slug ?? '-' }}
            </div>
        </div>

        <div class="row">
            <span class="label">Created At</span>
            <div class="value">
                {{ $category->created_at }}
            </div>
        </div>

        <div class="actions">
            <a
                href="{{ route('categories.index') }}"
                class="btn btn-back">
                ← Back to Categories
            </a>
        </div>

    </div>

</div>

</body>
</html>