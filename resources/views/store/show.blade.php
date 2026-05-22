<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store->shop_name }} - Profil Toko</title>
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
        .container { max-width: 600px; width: 100%; }
        
        .top-bar { display: flex; align-items: center; gap: 16px; margin-bottom: 24px; }
        .btn-back {
            text-decoration: none;
            color: #5f6368;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: background 0.2s;
        }
        .btn-back:hover { background-color: #e8eaed; }
        .top-bar h1 { font-size: 22px; font-weight: 400; margin: 0; }
        
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15);
            padding: 32px;
        }
        
        .header-profile {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 32px;
        }
        
        .avatar {
            width: 80px;
            height: 80px;
            background-color: #1a73e8;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }
        
        .info-group { margin-bottom: 24px; }
        .info-label { font-size: 12px; color: #5f6368; font-weight: 500; margin-bottom: 8px; letter-spacing: 0.5px; }
        .info-value { font-size: 15px; color: #202124; line-height: 1.6; }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            color: #3c4043;
            font-size: 15px;
        }
        .contact-item .material-icons { color: #5f6368; font-size: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <a href="{{ route('stores.index') }}" class="btn-back" title="Kembali">
                <span class="material-icons">arrow_back</span>
            </a>
            <h1>Profil Toko</h1>
        </div>

        <div class="card">
            <div class="header-profile">
                <div class="avatar">
                    <span class="material-icons" style="font-size: 40px;">storefront</span>
                </div>
                <div>
                    <h2 style="margin: 0 0 8px 0; font-size: 24px;">{{ $store->shop_name }}</h2>
                    <span style="background: #e8f0fe; color: #1967d2; padding: 4px 12px; border-radius: 16px; font-size: 12px; font-weight: 500;">
                        Official Seller
                    </span>
                </div>
            </div>

            <div class="info-group">
                <div class="info-label">DESKRIPSI TOKO</div>
                <div class="info-value">
                    {{ $store->description ?: 'Toko ini belum menambahkan deskripsi.' }}
                </div>
            </div>

            <div class="info-group">
                <div class="info-label">INFORMASI KONTAK & ALAMAT</div>
                <div class="contact-item">
                    <span class="material-icons">location_on</span>
                    {{ $store->address ?: 'Alamat belum diatur' }}
                </div>
                <div class="contact-item">
                    <span class="material-icons">phone</span>
                    {{ $store->phone ?: 'Nomor telepon belum diatur' }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>