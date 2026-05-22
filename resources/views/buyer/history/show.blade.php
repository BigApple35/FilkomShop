<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi #{{ $history->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        .g-body-wrapper {
            font-family: 'Roboto', sans-serif;
            background-color: #F8F9FA;
            color: #202124;
            min-height: 100vh;
            padding: 40px 24px;
            display: flex;
            justify-content: center;
        }

        .g-container {
            max-width: 700px;
            width: 100%;
        }

        .g-top-bar {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .g-btn-back {
            text-decoration: none;
            color: #5F6368;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: background 0.2s;
        }

        .g-btn-back:hover {
            background-color: #E8EAED;
        }

        .g-top-bar h1 {
            font-size: 22px;
            font-weight: 400;
            margin: 0;
            color: #202124;
        }

        .g-card {
            background: #FFFFFF !important;
            border-radius: 12px !important;
            border: 1px solid #DADCE0 !important;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.1), 0 1px 3px 1px rgba(60, 64, 67, 0.05) !important;
            padding: 32px !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .g-info-group {
            margin-bottom: 24px;
        }

        .g-info-label {
            font-size: 13px;
            color: #5F6368;
            font-weight: 500;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .g-info-value {
            font-size: 16px;
            color: #202124;
            line-height: 1.5;
        }

        .g-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            text-transform: capitalize;
        }

        .g-badge::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .g-badge-pending {
            background-color: #FEF7E0;
            color: #B06000;
        }

        .g-badge-pending::before {
            background-color: #F9AB00;
        }

        .g-badge-processing {
            background-color: #E8F0FE;
            color: #1967D2;
        }

        .g-badge-processing::before {
            background-color: #1A73E8;
        }

        .g-badge-shipped {
            background-color: #F3E8FD;
            color: #8430CE;
        }

        .g-badge-shipped::before {
            background-color: #9334E6;
        }

        .g-badge-delivered {
            background-color: #E6F4EA;
            color: #137333;
        }

        .g-badge-delivered::before {
            background-color: #1E8E3E;
        }

        .g-badge-cancelled {
            background-color: #FCE8E6;
            color: #C5221F;
        }

        .g-badge-cancelled::before {
            background-color: #D93025;
        }

        .g-divider {
            height: 1px;
            background-color: #E8EAED;
            margin: 32px 0;
            border: none;
        }

        .g-total-price {
            font-size: 32px;
            color: #1A73E8;
            font-weight: 500;
            margin-top: 8px;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <div class="g-body-wrapper">
        <div class="g-container">
            <div class="g-top-bar">
                <a href="{{ route('history.index') }}" class="g-btn-back">
                    <span class="material-icons-outlined">arrow_back</span>
                </a>
                <h1>Rincian Riwayat</h1>
            </div>
            <div class="g-card">
                <div class="g-info-group">
                    <div class="g-info-label">ID Transaksi</div>
                    <div class="g-info-value" style="font-weight: 500; color: #1A73E8;">#TRX-{{ $history->id }}</div>
                </div>
                <div class="g-info-group">
                    <div class="g-info-label">Status Pesanan</div>
                    <span class="g-badge g-badge-{{ strtolower($history->status) }}">{{ $history->status }}</span>
                </div>
                <div class="g-info-group">
                    <div class="g-info-label">Waktu Checkout</div>
                    <div class="g-info-value">{{ \Carbon\Carbon::parse($history->ordered_at ?? $history->created_at)->format('d M Y, H:i') }} WIB</div>
                </div>
                <div class="g-info-group">
                    <div class="g-info-label">Dikirim Ke</div>
                    <div class="g-info-value">{{ $history->shipping_address }}</div>
                </div>
                <hr class="g-divider">
                <div class="g-info-group" style="margin-bottom: 0;">
                    <div class="g-info-label">Total Belanja</div>
                    <div class="g-total-price">Rp {{ number_format($history->total_amount, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>