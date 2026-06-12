<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - FILKOMSHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F8F9FA;
            color: #212529;
        }

        .fs-navbar {
            background-color: #1A1D20;
            padding: 12px 0;
        }

        .fs-navbar-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .fs-nav-left {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .fs-brand {
            color: #FFFFFF;
            font-size: 22px;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: 0.5px;
        }

        .fs-nav-link {
            color: #FFFFFF;
            text-decoration: none;
            font-size: 15px;
        }

        .fs-nav-center {
            display: flex;
            gap: 8px;
        }

        .fs-search-input {
            padding: 8px 12px;
            border-radius: 4px;
            border: none;
            width: 300px;
            font-size: 14px;
            outline: none;
        }

        .fs-btn-search {
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            background: #FFFFFF;
            color: #212529;
            font-size: 14px;
            cursor: pointer;
        }

        .fs-nav-right {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .fs-btn-login {
            border: 1px solid #FFFFFF;
            color: #FFFFFF;
            padding: 7px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            background: transparent;
        }

        .fs-btn-register {
            background-color: #FFC107;
            color: #212529;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .fs-container {
            max-width: 700px;
            margin: 104px auto 40px auto;
            padding: 0 24px;
        }

        .fs-header {
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .fs-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            color: #212529;
        }

        .fs-btn-back {
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            padding: 8px 16px;
            border: 1px solid #CED4DA;
            border-radius: 4px;
            background: #FFFFFF;
        }

        .fs-card {
            background: #FFFFFF;
            border-radius: 8px;
            border: 1px solid #E9ECEF;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .fs-info-group {
            margin-bottom: 24px;
        }

        .fs-info-label {
            font-size: 14px;
            color: #6C757D;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fs-info-value {
            font-size: 16px;
            color: #212529;
        }

        .fs-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .fs-badge-pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .fs-badge-processing {
            background-color: #CCE5FF;
            color: #004085;
        }

        .fs-badge-shipped {
            background-color: #E2E3E5;
            color: #383D41;
        }

        .fs-badge-delivered {
            background-color: #D4EDDA;
            color: #155724;
        }

        .fs-badge-cancelled {
            background-color: #F8D7DA;
            color: #721C24;
        }

        .fs-divider {
            height: 1px;
            background-color: #E9ECEF;
            margin: 32px 0;
            border: none;
        }

        .fs-total-price {
            font-size: 28px;
            color: #212529;
            font-weight: 700;
            margin-top: 8px;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')

    <div class="fs-container">
        <div class="fs-header">
            <a href="{{ route('history.index') }}" class="fs-btn-back">Back</a>
            <h1 class="fs-title">Transaction Details</h1>
        </div>
        <div class="fs-card">
            <div class="fs-info-group">
                <div class="fs-info-label">Transaction ID</div>
                <div class="fs-info-value" style="font-weight: 700;">#TRX-{{ $history->id }}</div>
            </div>
            <div class="fs-info-group">
                <div class="fs-info-label">Status</div>
                <span class="fs-badge fs-badge-{{ strtolower($history->status) }}">{{ $history->status }}</span>
            </div>
            <div class="fs-info-group">
                <div class="fs-info-label">Checkout Date</div>
                <div class="fs-info-value">{{ \Carbon\Carbon::parse($history->ordered_at ?? $history->created_at)->format('d F Y, H:i') }} WIB</div>
            </div>
            <div class="fs-info-group">
                <div class="fs-info-label">Shipping Address</div>
                <div class="fs-info-value">{{ $history->shipping_address }}</div>
            </div>
            <hr class="fs-divider">
            <div class="fs-info-group" style="margin-bottom: 0;">
                <div class="fs-info-label">Total Amount</div>
                <div class="fs-total-price">Rp {{ number_format($history->total_amount, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</body>

</html>