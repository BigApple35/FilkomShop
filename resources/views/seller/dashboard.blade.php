<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard – FILKOMSHOP</title>
    <meta name="description" content="Manage your shop, products, and orders from the FILKOMSHOP seller dashboard.">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body>

@section('page-title', 'Seller Dashboard')
@include('layouts.seller_sidebar')

<style>
    /* ── Page-specific styles ─────────────────────────────────────── */
    .page-header {
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

    /* ── Stat Cards ───────────────────────────────────────────────── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: var(--md-sys-color-surface);
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 20px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }
    .stat-card:hover {
        box-shadow: 0 4px 20px rgba(13, 126, 85, 0.10);
        transform: translateY(-2px);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 20px 20px 0 0;
        background: linear-gradient(90deg, var(--accent-start), var(--accent-end));
    }
    .stat-card.green  { --accent-start: #0d7e55; --accent-end: #34d399; }
    .stat-card.blue   { --accent-start: #1a73e8; --accent-end: #60a5fa; }
    .stat-card.amber  { --accent-start: #f59e0b; --accent-end: #fcd34d; }
    .stat-card.rose   { --accent-start: #ef4444; --accent-end: #fb7185; }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .stat-card.green  .stat-icon { background: var(--md-sys-color-primary-container); color: var(--md-sys-color-primary); }
    .stat-card.blue   .stat-icon { background: var(--md-sys-color-secondary-container); color: var(--md-sys-color-secondary); }
    .stat-card.amber  .stat-icon { background: var(--md-sys-color-warning-container); color: var(--md-sys-color-on-warning-container); }
    .stat-card.rose   .stat-icon { background: var(--md-sys-color-error-container); color: var(--md-sys-color-on-error-container); }

    .stat-label {
        font-size: 13px;
        font-weight: 500;
        color: var(--md-sys-color-text-secondary);
        margin-top: 4px;
    }
    .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: var(--md-sys-color-text-primary);
        line-height: 1;
    }
    .stat-sub {
        font-size: 12px;
        color: var(--md-sys-color-text-secondary);
    }
    .stat-sub .positive { color: var(--md-sys-color-success); font-weight: 600; }
    .stat-sub .negative { color: var(--md-sys-color-error); font-weight: 600; }

    /* ── Grid Layout ──────────────────────────────────────────────── */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 1100px) {
        .content-grid { grid-template-columns: 1fr; }
    }

    /* ── Cards ────────────────────────────────────────────────────── */
    .card {
        background: var(--md-sys-color-surface);
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 20px;
        overflow: hidden;
    }
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 24px 0;
    }
    .card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--md-sys-color-text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .card-title .material-symbols-outlined {
        font-size: 20px;
        color: var(--md-sys-color-primary);
    }
    .card-body {
        padding: 20px 24px 24px;
    }

    /* ── Chart ────────────────────────────────────────────────────── */
    .chart-wrapper {
        position: relative;
        height: 260px;
    }

    /* ── Table ────────────────────────────────────────────────────── */
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
        padding: 12px 16px;
        border-bottom: 1px solid var(--md-sys-color-outline);
        text-align: left;
        white-space: nowrap;
    }
    .data-table td {
        font-size: 14px;
        color: var(--md-sys-color-text-primary);
        padding: 14px 16px;
        border-bottom: 1px solid var(--md-sys-color-outline);
        vertical-align: middle;
    }
    .data-table tr:last-child td { border-bottom: none; }
    .data-table tr:hover td { background-color: var(--md-sys-color-surface-variant); }

    /* ── Badges ───────────────────────────────────────────────────── */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
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

    /* ── Quick Actions ────────────────────────────────────────────── */
    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .action-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 12px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        border: 1px solid var(--md-sys-color-outline);
        background: var(--md-sys-color-surface);
        color: var(--md-sys-color-text-primary);
        transition: all 0.2s ease;
        cursor: pointer;
        font-family: inherit;
        width: 100%;
        box-sizing: border-box;
        text-align: left;
    }
    .action-btn:hover {
        background: var(--md-sys-color-surface-variant);
        border-color: var(--md-sys-color-primary);
        color: var(--md-sys-color-primary);
    }
    .action-btn .material-symbols-outlined {
        font-size: 20px;
    }
    .action-btn-primary {
        background: var(--md-sys-color-primary);
        color: #fff;
        border-color: var(--md-sys-color-primary);
    }
    .action-btn-primary:hover {
        background: var(--md-sys-color-on-primary-container);
        color: #fff;
    }

    /* ── Top Products ─────────────────────────────────────────────── */
    .product-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--md-sys-color-outline);
    }
    .product-row:last-child { border-bottom: none; }
    .product-rank {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--md-sys-color-primary-container);
        color: var(--md-sys-color-on-primary-container);
        font-size: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .product-info { flex: 1; min-width: 0; }
    .product-name {
        font-size: 13px;
        font-weight: 600;
        color: var(--md-sys-color-text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-sold {
        font-size: 12px;
        color: var(--md-sys-color-text-secondary);
    }
    .product-revenue {
        font-size: 13px;
        font-weight: 700;
        color: var(--md-sys-color-primary);
        flex-shrink: 0;
    }

    /* ── Empty states ─────────────────────────────────────────────── */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--md-sys-color-text-secondary);
    }
    .empty-state .material-symbols-outlined {
        font-size: 48px;
        margin-bottom: 8px;
        opacity: 0.4;
    }
    .empty-state p { margin: 0; font-size: 14px; }

    /* ── View all link ────────────────────────────────────────────── */
    .view-all-link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 13px;
        font-weight: 600;
        color: var(--md-sys-color-primary);
        text-decoration: none;
    }
    .view-all-link:hover { text-decoration: underline; }
    .view-all-link .material-symbols-outlined { font-size: 16px; }
</style>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Welcome back, {{ Auth::user()->name }} 👋</h1>
        <p>Here's a summary of your shop — <strong>{{ $seller->shop_name }}</strong></p>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid">
        <div class="stat-card green">
            <div class="stat-icon"><span class="material-symbols-outlined">payments</span></div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-sub">From all completed orders</div>
        </div>

        <div class="stat-card blue">
            <div class="stat-icon"><span class="material-symbols-outlined">receipt_long</span></div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-sub">
                @if($pendingFulfillments > 0)
                    <span class="negative">{{ $pendingFulfillments }} pending fulfillment</span>
                @else
                    <span class="positive">All fulfilled</span>
                @endif
            </div>
        </div>

        <div class="stat-card amber">
            <div class="stat-icon"><span class="material-symbols-outlined">inventory_2</span></div>
            <div class="stat-label">Total Products</div>
            <div class="stat-value">{{ $totalProducts }}</div>
            <div class="stat-sub"><span class="positive">{{ $activeProducts }} active</span> listings</div>
        </div>

        <div class="stat-card rose">
            <div class="stat-icon"><span class="material-symbols-outlined">pending_actions</span></div>
            <div class="stat-label">Pending Orders</div>
            <div class="stat-value">{{ $pendingFulfillments }}</div>
            <div class="stat-sub">Awaiting fulfillment</div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">

        <!-- Left Column -->
        <div style="display: flex; flex-direction: column; gap: 24px;">

            <!-- Revenue Chart -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span class="material-symbols-outlined">bar_chart</span>
                        Revenue – Last 10 Days
                    </h2>
                </div>
                <div class="card-body">
                    <div class="chart-wrapper">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span class="material-symbols-outlined">list_alt</span>
                        Recent Orders
                    </h2>
                    <a href="{{ route('seller.orders.index') }}" class="view-all-link">
                        View all <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
                <div class="card-body" style="padding-top: 8px; padding-bottom: 8px;">
                    @if($recentOrders->isEmpty())
                        <div class="empty-state">
                            <div><span class="material-symbols-outlined">receipt_long</span></div>
                            <p>No orders yet. Your incoming orders will appear here.</p>
                        </div>
                    @else
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td style="font-weight: 700; color: var(--md-sys-color-primary);">#ORD-{{ $order->id }}</td>
                                    <td>{{ $order->user?->name ?? 'Guest' }}</td>
                                    <td style="color: var(--md-sys-color-text-secondary); font-size: 13px;">
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($order->status) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td style="font-weight: 700;">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('seller.orders.show', $order->id) }}" class="view-all-link">
                                            Details <span class="material-symbols-outlined">arrow_forward</span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>

        <!-- Right Column -->
        <div style="display: flex; flex-direction: column; gap: 24px;">

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span class="material-symbols-outlined">bolt</span>
                        Quick Actions
                    </h2>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="{{ route('seller.products.create') }}" class="action-btn action-btn-primary">
                            <span class="material-symbols-outlined">add_box</span>
                            Add New Product
                        </a>
                        <a href="{{ route('seller.orders.index') }}" class="action-btn">
                            <span class="material-symbols-outlined">receipt_long</span>
                            Manage Orders
                        </a>
                        <a href="{{ route('seller.products.index') }}" class="action-btn">
                            <span class="material-symbols-outlined">inventory_2</span>
                            Manage Products
                        </a>
                        <a href="{{ url('/') }}" class="action-btn">
                            <span class="material-symbols-outlined">storefront</span>
                            View Storefront
                        </a>
                    </div>
                </div>
            </div>

            <!-- Top Products -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span class="material-symbols-outlined">workspace_premium</span>
                        Top Products
                    </h2>
                </div>
                <div class="card-body">
                    @if($topProducts->isEmpty())
                        <div class="empty-state">
                            <div><span class="material-symbols-outlined">inventory_2</span></div>
                            <p>No sales data yet.</p>
                        </div>
                    @else
                        @foreach($topProducts as $i => $item)
                        <div class="product-row">
                            <div class="product-rank">{{ $i + 1 }}</div>
                            <div class="product-info">
                                <div class="product-name">{{ $item->product?->name ?? 'Unknown Product' }}</div>
                                <div class="product-sold">{{ $item->total_sold }} units sold</div>
                            </div>
                            <div class="product-revenue">Rp {{ number_format($item->revenue, 0, ',', '.') }}</div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Shop Info -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <span class="material-symbols-outlined">store</span>
                        Shop Info
                    </h2>
                </div>
                <div class="card-body">
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <div>
                            <div style="font-size: 12px; color: var(--md-sys-color-text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Shop Name</div>
                            <div style="font-size: 15px; font-weight: 700;">{{ $seller->shop_name }}</div>
                        </div>
                        @if($seller->description)
                        <div>
                            <div style="font-size: 12px; color: var(--md-sys-color-text-secondary); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Description</div>
                            <div style="font-size: 14px; color: var(--md-sys-color-text-secondary); line-height: 1.5;">{{ $seller->description }}</div>
                        </div>
                        @endif
                        <div style="display: flex; align-items: center; gap: 8px; padding: 10px 14px; background: var(--md-sys-color-success-container); border-radius: 12px;">
                            <span class="material-symbols-outlined" style="color: var(--md-sys-color-on-success-container); font-size: 18px;">verified</span>
                            <span style="font-size: 13px; font-weight: 600; color: var(--md-sys-color-on-success-container);">Verified Seller</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div><!-- /.content-body -->
</div><!-- /.main-container -->

<script>
(function() {
    // Chart Data from PHP
    const chartLabels  = @json($chartData['labels']);
    const chartRevenue = @json($chartData['revenues']);
    const chartOrders  = @json($chartData['counts']);

    const ctx = document.getElementById('revenueChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 260);
    gradient.addColorStop(0, 'rgba(13, 126, 85, 0.25)');
    gradient.addColorStop(1, 'rgba(13, 126, 85, 0.00)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: 'Revenue (Rp)',
                    data: chartRevenue,
                    borderColor: '#0d7e55',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#0d7e55',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    yAxisID: 'y',
                },
                {
                    label: 'Orders',
                    data: chartOrders,
                    borderColor: '#1a73e8',
                    backgroundColor: 'transparent',
                    fill: false,
                    tension: 0.4,
                    pointBackgroundColor: '#1a73e8',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    yAxisID: 'y1',
                    borderDash: [5, 4],
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                        color: '#4d6b5e',
                        usePointStyle: true,
                        padding: 16,
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(ctx) {
                            if (ctx.datasetIndex === 0) {
                                return ' Revenue: Rp ' + ctx.parsed.y.toLocaleString('id-ID');
                            }
                            return ' Orders: ' + ctx.parsed.y;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    ticks: { font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 }, color: '#4d6b5e' }
                },
                y: {
                    type: 'linear',
                    position: 'left',
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    ticks: {
                        font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                        color: '#0d7e55',
                        callback: v => 'Rp ' + (v >= 1000 ? (v/1000).toFixed(0) + 'k' : v)
                    }
                },
                y1: {
                    type: 'linear',
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    ticks: {
                        font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                        color: '#1a73e8',
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Mobile sidebar toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');
    const mainCont   = document.getElementById('mainContainer');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            mainCont.classList.toggle('sidebar-open');
        });
    }
})();
</script>

</body>
</html>
