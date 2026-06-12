<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FILKOMSHOP</title>

    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            /* Google Material Design 3 Palette */
            --md-sys-color-primary: #1a73e8;
            --md-sys-color-primary-container: #e8f0fe;
            --md-sys-color-on-primary-container: #1967d2;
            
            --md-sys-color-secondary: #00796b;
            --md-sys-color-secondary-container: #e0f2f1;
            
            --md-sys-color-success: #1e8e3e;
            --md-sys-color-success-container: #e6f4ea;
            --md-sys-color-on-success-container: #137333;
            
            --md-sys-color-error: #ea4335;
            --md-sys-color-error-container: #fce8e6;
            --md-sys-color-on-error-container: #c5221f;
            
            --md-sys-color-warning: #f9ab00;
            --md-sys-color-warning-container: #fef7e0;
            --md-sys-color-on-warning-container: #b06000;
            
            --md-sys-color-background: #f8f9fa;
            --md-sys-color-surface: #ffffff;
            --md-sys-color-surface-variant: #f1f3f4;
            --md-sys-color-outline: #dadce0;
            
            --md-sys-color-text-primary: #202124;
            --md-sys-color-text-secondary: #5f6368;
            
            --sidebar-width: 260px;
            --header-height: 64px;
            --transition-speed: 0.25s;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--md-sys-color-background);
            color: var(--md-sys-color-text-primary);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* -------------------------------------------------------------
           SIDEBAR
        ------------------------------------------------------------- */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--md-sys-color-surface);
            border-right: 1px solid var(--md-sys-color-outline);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            transition: transform var(--transition-speed) ease;
        }

        .sidebar-brand {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 12px;
            border-bottom: 1px solid var(--md-sys-color-outline);
        }

        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--md-sys-color-primary-container);
            color: var(--md-sys-color-primary);
            width: 36px;
            height: 36px;
            border-radius: 8px;
        }

        .brand-logo .material-symbols-outined {
            font-size: 22px;
        }

        .brand-name {
            font-weight: 700;
            font-size: 16px;
            letter-spacing: -0.2px;
            color: var(--md-sys-color-text-primary);
        }

        .sidebar-nav {
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex-grow: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--md-sys-color-text-secondary);
            text-decoration: none;
            border-radius: 100px;
            font-weight: 500;
            font-size: 14px;
            transition: all var(--transition-speed) ease;
        }

        .nav-item:hover {
            background-color: var(--md-sys-color-surface-variant);
            color: var(--md-sys-color-text-primary);
        }

        .nav-item.active {
            background-color: var(--md-sys-color-primary-container);
            color: var(--md-sys-color-on-primary-container);
            font-weight: 600;
        }

        .nav-item .material-symbols-outlined {
            font-size: 22px;
        }

        .sidebar-divider {
            height: 1px;
            background-color: var(--md-sys-color-outline);
            margin: 8px 12px;
        }

        .sidebar-footer {
            padding: 16px 12px;
        }

        .logout-btn {
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--md-sys-color-on-error-container);
            border-radius: 100px;
            font-weight: 500;
            font-size: 14px;
            transition: all var(--transition-speed) ease;
        }

        .logout-btn:hover {
            background-color: var(--md-sys-color-error-container);
        }

        /* -------------------------------------------------------------
           MAIN CONTENT AREA
        ------------------------------------------------------------- */
        .main-container {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left var(--transition-speed) ease, width var(--transition-speed) ease;
        }

        /* -------------------------------------------------------------
           HEADER
        ------------------------------------------------------------- */
        .header {
            height: var(--header-height);
            background-color: var(--md-sys-color-surface);
            border-bottom: 1px solid var(--md-sys-color-outline);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--md-sys-color-text-secondary);
        }

        .header-search {
            position: relative;
            max-width: 600px;
            width: 400px;
            transition: width 0.3s ease;
        }

        .header-search input {
            width: 100%;
            background-color: var(--md-sys-color-surface-variant);
            border: none;
            border-radius: 28px;
            padding: 12px 16px 12px 48px;
            font-family: inherit;
            font-size: 14px;
            color: var(--md-sys-color-text-primary);
            outline: none;
            transition: background-color 0.2s, box-shadow 0.2s;
        }

        .header-search input:focus {
            background-color: var(--md-sys-color-surface);
            box-shadow: 0 1px 3px 0 rgba(60,64,67,0.3), 0 4px 8px 3px rgba(60,64,67,0.15);
        }

        .header-search .material-symbols-outlined {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--md-sys-color-text-secondary);
            pointer-events: none;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--md-sys-color-text-secondary);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color var(--transition-speed) ease;
        }

        .icon-btn:hover {
            background-color: var(--md-sys-color-surface-variant);
            color: var(--md-sys-color-text-primary);
        }

        .profile-menu {
            position: relative;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--md-sys-color-primary);
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid var(--md-sys-color-outline);
            transition: transform 0.2s ease;
        }

        .avatar:hover {
            transform: scale(1.05);
        }

        /* -------------------------------------------------------------
           CONTENT BODY
        ------------------------------------------------------------- */
        .content {
            padding: 32px;
            flex-grow: 1;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
        }

        .content-header {
            margin-bottom: 24px;
        }

        .content-title {
            font-size: 26px;
            font-weight: 700;
            color: var(--md-sys-color-text-primary);
            letter-spacing: -0.5px;
        }

        .content-subtitle {
            font-size: 14px;
            color: var(--md-sys-color-text-secondary);
            margin-top: 4px;
        }

        /* -------------------------------------------------------------
           METRICS GRID
        ------------------------------------------------------------- */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .metric-card {
            background-color: var(--md-sys-color-surface);
            border: 1px solid var(--md-sys-color-outline);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.25s, transform 0.25s;
        }

        .metric-card:hover {
            box-shadow: 0 4px 12px 0 rgba(60,64,67,0.1);
            transform: translateY(-2px);
        }

        .metric-icon-wrapper {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .metric-icon-wrapper.blue {
            background-color: var(--md-sys-color-primary-container);
            color: var(--md-sys-color-on-primary-container);
        }

        .metric-icon-wrapper.green {
            background-color: var(--md-sys-color-success-container);
            color: var(--md-sys-color-on-success-container);
        }

        .metric-icon-wrapper.amber {
            background-color: var(--md-sys-color-warning-container);
            color: var(--md-sys-color-on-warning-container);
        }

        .metric-icon-wrapper.purple {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        .metric-icon-wrapper.teal {
            background-color: #e0f2f1;
            color: #00796b;
        }

        .metric-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--md-sys-color-text-primary);
            line-height: 1;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .metric-label {
            font-size: 14px;
            color: var(--md-sys-color-text-secondary);
            font-weight: 500;
        }

        .metric-badge {
            position: absolute;
            top: 24px;
            right: 24px;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 100px;
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .metric-badge.positive {
            background-color: var(--md-sys-color-success-container);
            color: var(--md-sys-color-on-success-container);
        }

        /* -------------------------------------------------------------
           DATA SECTIONS (CHART + TABLE)
        ------------------------------------------------------------- */
        .data-grid {
            display: grid;
            grid-template-columns: 1.8fr 1.2fr;
            gap: 24px;
            align-items: start;
        }

        .data-card {
            background-color: var(--md-sys-color-surface);
            border: 1px solid var(--md-sys-color-outline);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            min-height: 480px;
        }

        .data-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .data-card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--md-sys-color-text-primary);
            letter-spacing: -0.2px;
        }

        /* Chart Mode Toggle */
        .chart-toggle-group {
            display: flex;
            background-color: var(--md-sys-color-surface-variant);
            border-radius: 20px;
            padding: 2px;
        }

        .chart-toggle-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px 14px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            border-radius: 18px;
            color: var(--md-sys-color-text-secondary);
            transition: all 0.2s ease;
        }

        .chart-toggle-btn.active {
            background-color: var(--md-sys-color-surface);
            color: var(--md-sys-color-primary);
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .chart-container {
            position: relative;
            flex-grow: 1;
            width: 100%;
            height: 380px;
        }

        /* Recent Transactions Table */
        .transactions-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            overflow-y: auto;
            max-height: 400px;
            padding-right: 4px;
        }

        .transaction-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            border: 1px solid var(--md-sys-color-outline);
            border-radius: 12px;
            transition: background-color 0.2s ease;
        }

        .transaction-row:hover {
            background-color: var(--md-sys-color-surface-variant);
        }

        .trx-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
            max-width: 55%;
        }

        .trx-id {
            font-size: 13px;
            font-weight: 700;
            color: var(--md-sys-color-text-primary);
        }

        .trx-customer {
            font-size: 13px;
            color: var(--md-sys-color-text-secondary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .trx-date {
            font-size: 11px;
            color: var(--md-sys-color-text-secondary);
        }

        .trx-financials {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 6px;
            text-align: right;
        }

        .trx-amount {
            font-size: 14px;
            font-weight: 700;
            color: var(--md-sys-color-text-primary);
        }

        /* Soft status pills */
        .status-pill {
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 100px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .status-pill.pending {
            background-color: var(--md-sys-color-warning-container);
            color: var(--md-sys-color-on-warning-container);
        }

        .status-pill.processing {
            background-color: var(--md-sys-color-primary-container);
            color: var(--md-sys-color-on-primary-container);
        }

        .status-pill.shipped {
            background-color: #e2e3e5;
            color: #383d41;
        }

        .status-pill.delivered {
            background-color: var(--md-sys-color-success-container);
            color: var(--md-sys-color-on-success-container);
        }

        .status-pill.cancelled {
            background-color: var(--md-sys-color-error-container);
            color: var(--md-sys-color-on-error-container);
        }

        .view-trx-link {
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--md-sys-color-primary);
            text-decoration: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            transition: background-color 0.2s;
        }

        .view-trx-link:hover {
            background-color: var(--md-sys-color-primary-container);
        }

        .view-trx-link .material-symbols-outlined {
            font-size: 18px;
        }

        .trx-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Empty state for lists */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            text-align: center;
            color: var(--md-sys-color-text-secondary);
            padding: 40px 20px;
        }

        .empty-state .material-symbols-outlined {
            font-size: 48px;
            color: var(--md-sys-color-outline);
            margin-bottom: 12px;
        }

        /* -------------------------------------------------------------
           RESPONSIVE MEDIA QUERIES
        ------------------------------------------------------------- */
        @media (max-width: 1024px) {
            .data-grid {
                grid-template-columns: 1fr;
            }
            .data-card {
                min-height: auto;
            }
        }

        @media (max-width: 768px) {
            :root {
                --sidebar-width: 0px;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
                width: 260px;
            }
            .main-container {
                margin-left: 0;
                width: 100%;
            }
            .main-container.sidebar-open {
                margin-left: 260px;
                width: calc(100% - 260px);
            }
            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .header-search {
                width: 200px;
            }
            .header {
                padding: 0 16px;
            }
            .content {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <span class="material-symbols-outlined">dashboard</span>
            </div>
            <span class="brand-name">FILKOMSHOP</span>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                <span class="material-symbols-outlined">grid_view</span>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.products.index') }}" class="nav-item">
                <span class="material-symbols-outlined">shopping_bag</span>
                <span>Manage Products</span>
            </a>
            
            <a href="{{ route('admin.categories.index') }}" class="nav-item">
                <span class="material-symbols-outlined">category</span>
                <span>Manage Categories</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-item">
                <span class="material-symbols-outlined">group</span>
                <span>Manage Users</span>
            </a>

            <div class="sidebar-divider"></div>

            <a href="{{ url('/') }}" class="nav-item">
                <span class="material-symbols-outlined">storefront</span>
                <span>View Storefront</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Log out of admin session?');">
                @csrf
                <button type="submit" class="logout-btn">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTAINER -->
    <div class="main-container" id="mainContainer">
        <!-- TOP HEADER -->
        <header class="header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="header-search">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" placeholder="Search orders, clients, items..." disabled>
                </div>
            </div>

            <div class="header-right">
                <button class="icon-btn" title="Help">
                    <span class="material-symbols-outlined">help_outline</span>
                </button>
                <button class="icon-btn" title="Notifications">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                
                <div class="profile-menu">
                    @auth
                        <div class="avatar" title="{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <!-- CONTENT BODY -->
        <main class="content">
            <!-- Content Header -->
            <div class="content-header">
                <h1 class="content-title">Dashboard Overview</h1>
                <p class="content-subtitle">Real-time indicators, products catalog, and transactions intelligence.</p>
            </div>

            <!-- KPI Cards Grid -->
            <section class="metrics-grid">
                <!-- Products Card -->
                <div class="metric-card">
                    <div class="metric-icon-wrapper blue">
                        <span class="material-symbols-outlined">shopping_bag</span>
                    </div>
                    <div class="metric-value">{{ number_format($productsCount) }}</div>
                    <div class="metric-label">Active Products</div>
                    <span class="metric-badge positive">
                        <span class="material-symbols-outlined" style="font-size: 12px;">trending_up</span>
                        <span>+8%</span>
                    </span>
                </div>

                <!-- Customers Card -->
                <div class="metric-card">
                    <div class="metric-icon-wrapper green">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                    <div class="metric-value">{{ number_format($usersCount) }}</div>
                    <div class="metric-label">Registered Buyers</div>
                    <span class="metric-badge positive">
                        <span class="material-symbols-outlined" style="font-size: 12px;">trending_up</span>
                        <span>+14.2%</span>
                    </span>
                </div>

                <!-- Sellers Card -->
                <div class="metric-card">
                    <div class="metric-icon-wrapper amber">
                        <span class="material-symbols-outlined">store</span>
                    </div>
                    <div class="metric-value">{{ number_format($sellersCount) }}</div>
                    <div class="metric-label">Registered Sellers</div>
                    <span class="metric-badge positive">
                        <span class="material-symbols-outlined" style="font-size: 12px;">trending_up</span>
                        <span>+5.1%</span>
                    </span>
                </div>

                <!-- Total Revenue Card -->
                <div class="metric-card">
                    <div class="metric-icon-wrapper teal">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <div class="metric-value" style="font-size: 24px; margin-top: 6px; margin-bottom: 12px;">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </div>
                    <div class="metric-label">Gross Revenue</div>
                    <span class="metric-badge positive" style="background-color: #e0f2f1; color: #00796b;">
                        <span class="material-symbols-outlined" style="font-size: 12px;">trending_up</span>
                        <span>+22.4%</span>
                    </span>
                </div>
            </section>

            <!-- Dual-Column Data Section (Chart + Recent Transactions) -->
            <div class="data-grid">
                <!-- Transaction Line Chart Card -->
                <section class="data-card">
                    <div class="data-card-header">
                        <h2 class="data-card-title">Transaction Analytics</h2>
                        
                        <div class="chart-toggle-group">
                            <button class="chart-toggle-btn active" id="toggleSalesBtn">Sales (Rp)</button>
                            <button class="chart-toggle-btn" id="toggleVolumeBtn">Volume (Qty)</button>
                        </div>
                    </div>

                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </section>

                <!-- Recent Transactions Card -->
                <section class="data-card">
                    <div class="data-card-header">
                        <h2 class="data-card-title">Recent Transactions</h2>
                    </div>

                    <div class="transactions-list">
                        @forelse($recentTransactions as $trx)
                            <div class="transaction-row">
                                <div class="trx-info">
                                    <span class="trx-id">#TRX-{{ $trx->id }}</span>
                                    <span class="trx-customer">{{ $trx->user->name ?? 'Guest User' }}</span>
                                    <span class="trx-date">
                                        {{ \Carbon\Carbon::parse($trx->ordered_at ?? $trx->created_at)->format('d M, H:i') }} WIB
                                    </span>
                                </div>
                                
                                <div class="trx-financials">
                                    <span class="trx-amount">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</span>
                                    <div class="trx-actions">
                                        <span class="status-pill {{ strtolower($trx->status) }}">{{ $trx->status }}</span>
                                        <a href="{{ route('history.show', $trx->id) }}" class="view-trx-link" title="View Transaction Detail">
                                            <span class="material-symbols-outlined">visibility</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <span class="material-symbols-outlined">receipt_long</span>
                                <h3>No Transactions Yet</h3>
                                <p style="font-size: 13px; margin-top: 6px;">Once checkouts are completed, they will appear here instantly.</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- SCRIPTS -->
    <script>
        // Responsive sidebar toggler
        const sidebar = document.getElementById('sidebar');
        const mainContainer = document.getElementById('mainContainer');
        const menuToggle = document.getElementById('menuToggle');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            mainContainer.classList.toggle('sidebar-open');
        });

        // Close sidebar on small screens when clicking outside
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !menuToggle.contains(e.target) && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                    mainContainer.classList.remove('sidebar-open');
                }
            }
        });

        // Data injected from Controller
        const chartLabels = {!! json_encode($chartData['labels']) !!};
        const chartRevenues = {!! json_encode($chartData['revenues']) !!};
        const chartCounts = {!! json_encode($chartData['counts']) !!};

        // Initialize Chart.js
        const ctx = document.getElementById('salesChart').getContext('2d');

        // Create elegant background gradients
        const blueGradient = ctx.createLinearGradient(0, 0, 0, 300);
        blueGradient.addColorStop(0, 'rgba(26, 115, 232, 0.25)');
        blueGradient.addColorStop(1, 'rgba(26, 115, 232, 0.00)');

        const tealGradient = ctx.createLinearGradient(0, 0, 0, 300);
        tealGradient.addColorStop(0, 'rgba(0, 121, 107, 0.25)');
        tealGradient.addColorStop(1, 'rgba(0, 121, 107, 0.00)');

        const chartConfig = {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Gross Sales (Rp)',
                    data: chartRevenues,
                    borderColor: '#1a73e8',
                    borderWidth: 3,
                    backgroundColor: blueGradient,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#1a73e8',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#202124',
                        titleFont: {
                            family: 'Plus Jakarta Sans',
                            weight: 'bold',
                            size: 13
                        },
                        bodyFont: {
                            family: 'Plus Jakarta Sans',
                            size: 12
                        },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                let val = context.raw;
                                if (currentMode === 'sales') {
                                    return 'Sales: Rp ' + val.toLocaleString('id-ID');
                                } else {
                                    return 'Volume: ' + val + ' orders';
                                }
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Plus Jakarta Sans',
                                size: 11
                            },
                            color: '#5f6368'
                        }
                    },
                    y: {
                        grid: {
                            color: '#f1f3f4'
                        },
                        ticks: {
                            font: {
                                family: 'Plus Jakarta Sans',
                                size: 11
                            },
                            color: '#5f6368',
                            callback: function(value) {
                                if (currentMode === 'sales') {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000) + 'M';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000) + 'k';
                                    }
                                    return 'Rp ' + value;
                                }
                                return value;
                            }
                        }
                    }
                }
            }
        };

        let myChart = new Chart(ctx, chartConfig);
        let currentMode = 'sales';

        // Interactive toggle behavior
        const toggleSalesBtn = document.getElementById('toggleSalesBtn');
        const toggleVolumeBtn = document.getElementById('toggleVolumeBtn');

        toggleSalesBtn.addEventListener('click', () => {
            if (currentMode === 'sales') return;
            currentMode = 'sales';
            toggleSalesBtn.classList.add('active');
            toggleVolumeBtn.classList.remove('active');

            myChart.data.datasets[0].label = 'Gross Sales (Rp)';
            myChart.data.datasets[0].data = chartRevenues;
            myChart.data.datasets[0].borderColor = '#1a73e8';
            myChart.data.datasets[0].backgroundColor = blueGradient;
            myChart.data.datasets[0].pointBackgroundColor = '#1a73e8';
            myChart.update();
        });

        toggleVolumeBtn.addEventListener('click', () => {
            if (currentMode === 'volume') return;
            currentMode = 'volume';
            toggleVolumeBtn.classList.add('active');
            toggleSalesBtn.classList.remove('active');

            myChart.data.datasets[0].label = 'Order Volume';
            myChart.data.datasets[0].data = chartCounts;
            myChart.data.datasets[0].borderColor = '#00796b';
            myChart.data.datasets[0].backgroundColor = tealGradient;
            myChart.data.datasets[0].pointBackgroundColor = '#00796b';
            myChart.update();
        });
    </script>
</body>

</html>
