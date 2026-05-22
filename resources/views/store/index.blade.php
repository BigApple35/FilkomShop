<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Toko - FilkomShop</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #202124;
            margin: 0;
            padding: 32px;
            display: flex;
            justify-content: center;
        }
        .container { max-width: 1000px; width: 100%; }
        .header { margin-bottom: 24px; display: flex; align-items: center; }
        .header h1 { font-size: 22px; font-weight: 400; margin: 0; color: #3c4043; }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }
        
        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15);
            padding: 24px;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s;
            text-decoration: none;
            color: inherit;
        }
        .card:hover {
            box-shadow: 0 4px 6px 2px rgba(60,64,67,0.15);
        }
        
        .shop-icon {
            background-color: #e8f0fe;
            color: #1a73e8;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        
        .shop-name { font-size: 18px; font-weight: 500; margin: 0 0 8px 0; }
        .shop-desc { font-size: 14px; color: #5f6368; margin: 0; flex-grow: 1; line-height: 1.5; }
        
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 48px;
            color: #5f6368;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Daftar Toko FilkomShop</h1>
        </div>

        <div class="grid">
            @forelse ($stores as $store)
                <a href="{{ route('stores.show', $store->id) }}" class="card">
                    <div class="shop-icon">
                        <span class="material-icons">storefront</span>
                    </div>
                    <h2 class="shop-name">{{ $store->shop_name }}</h2>
                    <p class="shop-desc">
                        {{ $store->description ? \Illuminate\Support\Str::limit($store->description, 80) : 'Belum ada deskripsi toko.' }}
                    </p>
                </a>
            @empty
                <div class="empty-state">
                    <span class="material-icons" style="font-size: 48px; color: #dadce0; margin-bottom: 8px;">store_mall_directory</span>
                    <p style="margin:0;">Belum ada toko yang terdaftar saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>