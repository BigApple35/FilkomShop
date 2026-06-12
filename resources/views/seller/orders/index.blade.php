<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incoming Orders – FILKOMSHOP</title>
    <meta name="description" content="Manage all customer orders for your FILKOMSHOP store.">
</head>
<body>

@section('page-title', 'Incoming Orders')
@include('layouts.seller_sidebar')

<style>
    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 28px;
    }
    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 4px 0;
        color: var(--md-sys-color-text-primary);
    }
    .page-header p {
        font-size: 14px;
        color: var(--md-sys-color-text-secondary);
        margin: 0;
    }

    .card {
        background: var(--md-sys-color-surface);
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 20px;
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    .data-table th {
        font-size: 12px;
        font-weight: 600;
        color: var(--md-sys-color-text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 20px;
        border-bottom: 1px solid var(--md-sys-color-outline);
        text-align: left;
        background: var(--md-sys-color-surface-variant);
        white-space: nowrap;
    }
    .data-table td {
        font-size: 14px;
        color: var(--md-sys-color-text-primary);
        padding: 16px 20px;
        border-bottom: 1px solid var(--md-sys-color-outline);
        vertical-align: middle;
    }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background-color: var(--md-sys-color-surface-variant); }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 12px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
        white-space: nowrap;
    }
    .badge-pending    { background: var(--md-sys-color-warning-container); color: var(--md-sys-color-on-warning-container); }
    .badge-processing { background: var(--md-sys-color-secondary-container); color: #1a73e8; }
    .badge-shipped    { background: #e8eaf6; color: #3949ab; }
    .badge-delivered  { background: var(--md-sys-color-success-container); color: var(--md-sys-color-on-success-container); }
    .badge-cancelled  { background: var(--md-sys-color-error-container); color: var(--md-sys-color-on-error-container); }

    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 600;
        color: var(--md-sys-color-primary);
        text-decoration: none;
        padding: 7px 16px;
        border-radius: 100px;
        border: 1px solid var(--md-sys-color-primary-container);
        background: var(--md-sys-color-primary-container);
        transition: all 0.2s ease;
    }
    .btn-view:hover {
        background: var(--md-sys-color-primary);
        color: #fff;
        border-color: var(--md-sys-color-primary);
    }
    .btn-view .material-symbols-outlined { font-size: 16px; }

    .empty-state {
        text-align: center;
        padding: 64px 20px;
        color: var(--md-sys-color-text-secondary);
    }
    .empty-state .material-symbols-outlined {
        font-size: 56px;
        margin-bottom: 12px;
        opacity: 0.35;
        display: block;
    }
    .empty-state p { margin: 4px 0; font-size: 14px; }
    .empty-state strong { font-size: 16px; font-weight: 700; color: var(--md-sys-color-text-primary); }
</style>

    <div class="page-header">
        <div>
            <h1>Incoming Orders</h1>
            <p>All customer purchases for your shop — <strong>{{ count($incomingOrders) }}</strong> orders found.</p>
        </div>
        <a href="{{ route('seller.dashboard') }}" style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:var(--md-sys-color-text-secondary);text-decoration:none;">
            <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
            Back to Dashboard
        </a>
    </div>

    <div class="card">
        @if($incomingOrders->isEmpty())
            <div class="empty-state">
                <span class="material-symbols-outlined">receipt_long</span>
                <strong>No Orders Yet</strong>
                <p>Customer orders will appear here once purchases are made.</p>
            </div>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total Amount</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($incomingOrders as $order)
                    <tr>
                        <td style="font-weight:700; color:var(--md-sys-color-primary);">#ORD-{{ $order->id }}</td>
                        <td>
                            <div style="font-weight:600;">{{ $order->created_at->format('d M Y') }}</div>
                            <div style="color:var(--md-sys-color-text-secondary);font-size:12px;">{{ $order->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            <span class="badge badge-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                        </td>
                        <td style="font-weight:700;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td style="text-align:center;">
                            <a href="{{ route('seller.orders.show', $order->id) }}" class="btn-view">
                                Details <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div><!-- /.content-body -->
</div><!-- /.main-container -->

<script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');
    const mainCont   = document.getElementById('mainContainer');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            mainCont.classList.toggle('sidebar-open');
        });
    }
</script>

</body>
</html>