<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - FILKOMSHOP</title>
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
            font-weight: 400;
        }

        .fs-nav-center {
            display: flex;
            gap: 8px;
            align-items: center;
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
            max-width: 1100px;
            margin: 104px auto 40px auto;
            padding: 0 24px;
            min-height: 80vh;
        }

        .fs-header {
            margin-bottom: 24px;
        }

        .fs-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 8px 0;
            color: #212529;
        }

        .fs-subtitle {
            color: #6C757D;
            font-size: 15px;
            margin: 0;
        }

        .fs-card {
            background: #FFFFFF;
            border-radius: 8px;
            border: 1px solid #E9ECEF;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .fs-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .fs-table th,
        .fs-table td {
            padding: 16px 24px;
            border-bottom: 1px solid #E9ECEF;
        }

        .fs-table th {
            color: #495057;
            font-weight: 600;
            font-size: 14px;
            background-color: #F8F9FA;
        }

        .fs-table td {
            font-size: 15px;
            color: #212529;
            vertical-align: middle;
        }

        .fs-table tr:hover td {
            background-color: #F8F9FA;
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

        .fs-btn-action {
            text-decoration: none;
            color: #212529;
            font-weight: 600;
            font-size: 13px;
            padding: 6px 16px;
            border-radius: 4px;
            border: 1px solid #CED4DA;
            background: #FFFFFF;
            cursor: pointer;
            display: inline-block;
        }

        .fs-btn-action:hover {
            background: #E9ECEF;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')

    <div class="fs-container">
        <div class="fs-header">
            <h1 class="fs-title">Incoming Orders</h1>
            <p class="fs-subtitle">Manage all orders received from customers. Total: {{ count($incomingOrders) }} orders.</p>
        </div>

        <div class="fs-card">
            <table class="fs-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total Amount</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incomingOrders as $order)
                    <tr>
                        <td style="font-weight: 600;">#ORD-{{ $order->id }}</td>
                        <td>
                            <div>{{ $order->created_at->format('d M Y') }}</div>
                            <div style="color: #6C757D; font-size: 13px;">{{ $order->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            <span class="fs-badge fs-badge-{{ strtolower($order->status) }}">{{ $order->status }}</span>
                        </td>
                        <td style="font-weight: 600;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('seller.orders.show', $order->id) }}" class="fs-btn-action">View Details</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 48px; color: #6C757D;">
                            <div style="font-size: 20px; font-weight: 600; color: #212529; margin-bottom: 8px;">No Orders Yet</div>
                            Customer purchases will appear here.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>