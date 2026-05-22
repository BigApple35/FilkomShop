<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - Seller</title>
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
            max-width: 1100px;
            width: 100%;
        }

        .g-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .g-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .g-title h1 {
            font-size: 24px;
            font-weight: 400;
            margin: 0;
            color: #202124;
        }

        .g-title .material-icons-outlined {
            color: #1A73E8;
            font-size: 28px;
        }

        .g-card {
            background: #FFFFFF !important;
            border-radius: 12px !important;
            border: 1px solid #DADCE0 !important;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.1), 0 1px 3px 1px rgba(60, 64, 67, 0.05) !important;
            overflow: hidden !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .g-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .g-table th,
        .g-table td {
            padding: 16px 24px;
            border-bottom: 1px solid #E8EAED;
        }

        .g-table th {
            color: #5F6368;
            font-weight: 500;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: #FAFAFA;
        }

        .g-table td {
            font-size: 14px;
            color: #3C4043;
            vertical-align: middle;
        }

        .g-table tr:hover td {
            background-color: #F8F9FA;
        }

        .g-table tr:last-child td {
            border-bottom: none;
        }

        .g-order-id {
            font-weight: 500;
            color: #1A73E8;
        }

        .g-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
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

        .g-btn-outline {
            text-decoration: none;
            color: #1A73E8;
            font-weight: 500;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            border-radius: 20px;
            border: 1px solid #DADCE0;
            transition: all 0.2s ease;
        }

        .g-btn-outline:hover {
            background-color: #F4FAFE;
            border-color: #D2E3FC;
        }

        .g-btn-outline .material-icons-outlined {
            font-size: 18px;
        }

        .g-empty-state {
            padding: 64px 24px;
            text-align: center;
            color: #5F6368;
        }

        .g-empty-icon {
            font-size: 64px;
            color: #DADCE0;
            margin-bottom: 16px;
        }

        .g-empty-state h3 {
            margin: 0 0 8px 0;
            font-weight: 500;
            color: #3C4043;
        }

        .g-empty-state p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <div class="g-body-wrapper">
        <div class="g-container">
            <div class="g-header">
                <div class="g-title">
                    <span class="material-icons-outlined">inventory_2</span>
                    <h1>Pesanan Masuk</h1>
                </div>
                <div style="font-size: 14px; color: #5F6368;">
                    Total: <strong>{{ count($incomingOrders) }}</strong> Pesanan
                </div>
            </div>
            <div class="g-card">
                <table class="g-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Waktu Transaksi</th>
                            <th>Status</th>
                            <th>Total Pembayaran</th>
                            <th style="text-align: center;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($incomingOrders as $order)
                        <tr>
                            <td>
                                <span class="g-order-id">#ORD-{{ $order->id }}</span>
                            </td>
                            <td>
                                <div style="color: #202124;">{{ $order->created_at->format('d M Y') }}</div>
                                <div style="color: #5F6368; font-size: 12px;">{{ $order->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td>
                                <span class="g-badge g-badge-{{ strtolower($order->status) }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td style="font-weight: 500;">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('seller.orders.show', $order->id) }}" class="g-btn-outline">
                                    <span class="material-icons-outlined">visibility</span>
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="g-empty-state">
                                    <span class="material-icons-outlined g-empty-icon">local_shipping</span>
                                    <h3>Belum Ada Pesanan Baru</h3>
                                    <p>Pesanan yang dibeli oleh pelanggan akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>