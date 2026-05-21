<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }}</title>
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

        .container {
            max-width: 600px;
            width: 100%;
        }

        .top-bar {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

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

        .btn-back:hover {
            background-color: #e8eaed;
        }

        .top-bar h1 {
            font-size: 22px;
            font-weight: 400;
            margin: 0;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
            padding: 24px 32px;
        }

        .info-group {
            margin-bottom: 20px;
        }

        .info-label {
            font-size: 12px;
            color: #5f6368;
            font-weight: 500;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 16px;
            color: #202124;
        }

        .status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 500;
            background-color: #e8f0fe;
            color: #1967d2;
            margin-top: 4px;
        }

        .divider {
            height: 1px;
            background-color: #e8eaed;
            margin: 24px 0;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <a href="{{ route('seller.orders.index') }}" class="btn-back" title="Kembali">
                <span class="material-icons">arrow_back</span>
            </a>
            <h1>Detail Pesanan</h1>
        </div>

        <div class="card">
            <div class="info-group">
                <div class="info-label">ID PESANAN</div>
                <div class="info-value" style="font-weight: 500;">#ORD-{{ $order->id }}</div>
            </div>

            <div class="info-group">
                <div class="info-label">STATUS PESANAN</div>
                <span class="status">{{ ucfirst($order->status) }}</span>
            </div>

            <div class="info-group">
                <div class="info-label">TANGGAL MASUK</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($order->ordered_at)->format('d M Y, H:i') }} WIB</div>
            </div>

            <div class="info-group">
                <div class="info-label">ALAMAT PENGIRIMAN</div>
                <div class="info-value">{{ $order->shipping_address }}</div>
            </div>

            <hr class="divider">

            <div class="info-group" style="margin-bottom: 0;">
                <div class="info-label">TOTAL PEMBAYARAN</div>
                <div class="info-value" style="font-size: 28px; color: #1a73e8; font-weight: 400;">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>