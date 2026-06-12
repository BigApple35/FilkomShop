<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details – FILKOMSHOP</title>
    <meta name="description" content="View order details for your FILKOMSHOP store.">
</head>
<body>

@section('page-title', 'Order Details')
@include('layouts.seller_sidebar')

<style>
    .page-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }
    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0;
        color: var(--md-sys-color-text-primary);
    }
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: var(--md-sys-color-text-secondary);
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 100px;
        border: 1px solid var(--md-sys-color-outline);
        background: var(--md-sys-color-surface);
        transition: all 0.2s ease;
        flex-shrink: 0;
    }
    .btn-back:hover {
        background: var(--md-sys-color-surface-variant);
        color: var(--md-sys-color-text-primary);
    }
    .btn-back .material-symbols-outlined { font-size: 18px; }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }
    @media (max-width: 768px) {
        .detail-grid { grid-template-columns: 1fr; }
    }

    .card {
        background: var(--md-sys-color-surface);
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 20px;
        overflow: hidden;
    }
    .card-header {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--md-sys-color-outline);
    }
    .card-header h2 {
        font-size: 15px;
        font-weight: 700;
        margin: 0;
        color: var(--md-sys-color-text-primary);
    }
    .card-header .material-symbols-outlined {
        font-size: 20px;
        color: var(--md-sys-color-primary);
    }
    .card-body {
        padding: 24px;
    }

    .info-row {
        display: flex;
        flex-direction: column;
        gap: 4px;
        margin-bottom: 20px;
    }
    .info-row:last-child { margin-bottom: 0; }
    .info-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--md-sys-color-text-secondary);
    }
    .info-value {
        font-size: 15px;
        font-weight: 600;
        color: var(--md-sys-color-text-primary);
        line-height: 1.4;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 12px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }
    .badge-pending    { background: var(--md-sys-color-warning-container); color: var(--md-sys-color-on-warning-container); }
    .badge-processing { background: var(--md-sys-color-secondary-container); color: #1a73e8; }
    .badge-shipped    { background: #e8eaf6; color: #3949ab; }
    .badge-delivered  { background: var(--md-sys-color-success-container); color: var(--md-sys-color-on-success-container); }
    .badge-cancelled  { background: var(--md-sys-color-error-container); color: var(--md-sys-color-on-error-container); }

    .revenue-highlight {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px 24px;
        background: linear-gradient(135deg, var(--md-sys-color-primary-container), var(--md-sys-color-surface-variant));
        border-radius: 16px;
        margin-top: 24px;
    }
    .revenue-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: var(--md-sys-color-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        flex-shrink: 0;
    }
    .revenue-icon .material-symbols-outlined { font-size: 24px; }
    .revenue-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--md-sys-color-text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .revenue-amount {
        font-size: 28px;
        font-weight: 800;
        color: var(--md-sys-color-primary);
    }
</style>

    <div class="page-header">
        <a href="{{ route('seller.orders.index') }}" class="btn-back">
            <span class="material-symbols-outlined">arrow_back</span>
            Orders
        </a>
        <h1>Order #ORD-{{ $order->id }}</h1>
    </div>

    <div class="detail-grid">
        <!-- Order Info -->
        <div class="card">
            <div class="card-header">
                <span class="material-symbols-outlined">info</span>
                <h2>Order Information</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <span class="info-label">Order ID</span>
                    <span class="info-value">#ORD-{{ $order->id }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span>
                        <span class="badge badge-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Transaction Date</span>
                    <span class="info-value">
                        {{ \Carbon\Carbon::parse($order->ordered_at ?? $order->created_at)->format('d F Y, H:i') }} WIB
                    </span>
                </div>
            </div>
        </div>

        <!-- Shipping Info -->
        <div class="card">
            <div class="card-header">
                <span class="material-symbols-outlined">local_shipping</span>
                <h2>Shipping Details</h2>
            </div>
            <div class="card-body">
                <div class="info-row">
                    <span class="info-label">Shipping Address</span>
                    <span class="info-value">{{ $order->shipping_address ?? '—' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Customer</span>
                    <span class="info-value">{{ $order->user?->name ?? 'Guest' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Customer Email</span>
                    <span class="info-value">{{ $order->user?->email ?? '—' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Highlight -->
    <div class="revenue-highlight">
        <div class="revenue-icon">
            <span class="material-symbols-outlined">payments</span>
        </div>
        <div>
            <div class="revenue-label">Total Order Amount</div>
            <div class="revenue-amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
        </div>
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