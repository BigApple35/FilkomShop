<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Masuk - Seller</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
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
            max-width: 1000px;
            width: 100%;
        }

        .header {
            margin-bottom: 24px;
            display: flex;
            align-items: center;
        }

        .header h1 {
            font-size: 22px;
            font-weight: 400;
            margin: 0;
            color: #3c4043;
        }

        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th,
        td {
            padding: 16px 24px;
            border-bottom: 1px solid #e8eaed;
        }

        th {
            color: #5f6368;
            font-weight: 500;
            font-size: 14px;
        }

        td {
            font-size: 14px;
            color: #202124;
        }

        tr:hover {
            background-color: #f1f3f4;
        }

        .status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 500;
            background-color: #e8f0fe;
            color: #1967d2;
        }

        .btn {
            text-decoration: none;
            color: #1a73e8;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .btn:hover {
            background-color: #f4fafe;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Pesanan Masuk (Incoming Orders)</h1>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incomingOrders as $order)
                    <tr>
                        <td style="font-weight: 500;">#ORD-{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td><span class="status">{{ ucfirst($order->status) }}</span></td>
                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('seller.orders.show', $order->id) }}" class="btn">
                                <span class="material-icons" style="font-size: 18px;">visibility</span>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #5f6368; padding: 48px;">
                            <span class="material-icons" style="font-size: 48px; color: #dadce0; display: block; margin-bottom: 8px;">inbox</span>
                            Belum ada pesanan masuk saat ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>