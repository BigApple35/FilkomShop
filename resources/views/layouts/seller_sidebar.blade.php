<!-- Google Font & Material Symbols -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

<style>
    :root {
        --md-sys-color-primary: #0d7e55;
        --md-sys-color-primary-container: #d7f5e9;
        --md-sys-color-on-primary-container: #065f3f;

        --md-sys-color-secondary: #1a73e8;
        --md-sys-color-secondary-container: #e8f0fe;

        --md-sys-color-success: #1e8e3e;
        --md-sys-color-success-container: #e6f4ea;
        --md-sys-color-on-success-container: #137333;

        --md-sys-color-error: #ea4335;
        --md-sys-color-error-container: #fce8e6;
        --md-sys-color-on-error-container: #c5221f;

        --md-sys-color-warning: #f9ab00;
        --md-sys-color-warning-container: #fef7e0;
        --md-sys-color-on-warning-container: #b06000;

        --md-sys-color-background: #f4f9f6;
        --md-sys-color-surface: #ffffff;
        --md-sys-color-surface-variant: #edf5f1;
        --md-sys-color-outline: #d3e3db;

        --md-sys-color-text-primary: #1a2e25;
        --md-sys-color-text-secondary: #4d6b5e;

        --sidebar-width: 260px;
        --header-height: 64px;
        --transition-speed: 0.25s;
    }

    body {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        background-color: var(--md-sys-color-background) !important;
        color: var(--md-sys-color-text-primary) !important;
        min-height: 100vh;
        margin: 0;
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
        z-index: 1000;
        display: flex;
        flex-direction: column;
        transition: transform var(--transition-speed) ease;
        box-sizing: border-box;
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

    .brand-name {
        font-weight: 700;
        font-size: 16px;
        letter-spacing: -0.2px;
        color: var(--md-sys-color-text-primary);
    }

    .brand-role-badge {
        font-size: 10px;
        font-weight: 600;
        background-color: var(--md-sys-color-primary-container);
        color: var(--md-sys-color-on-primary-container);
        padding: 2px 8px;
        border-radius: 100px;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        margin-left: auto;
    }

    .sidebar-nav {
        padding: 16px 12px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        flex-grow: 1;
    }

    .nav-section-label {
        font-size: 11px;
        font-weight: 600;
        color: var(--md-sys-color-text-secondary);
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 8px 16px 4px;
        margin-top: 4px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: var(--md-sys-color-text-secondary) !important;
        text-decoration: none !important;
        border-radius: 100px;
        font-weight: 500;
        font-size: 14px;
        transition: all var(--transition-speed) ease;
    }

    .nav-item:hover {
        background-color: var(--md-sys-color-surface-variant);
        color: var(--md-sys-color-text-primary) !important;
    }

    .nav-item.active {
        background-color: var(--md-sys-color-primary-container);
        color: var(--md-sys-color-on-primary-container) !important;
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
        font-weight: 600;
        font-family: inherit;
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

    .header-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--md-sys-color-text-primary);
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

    .content-body {
        padding: 32px;
        flex-grow: 1;
        width: 100%;
        box-sizing: border-box;
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
        .header {
            padding: 0 16px;
        }
        .content-body {
            padding: 20px 16px;
        }
    }
</style>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">
            <span class="material-symbols-outlined">store</span>
        </div>
        <span class="brand-name">FILKOMSHOP</span>
        <span class="brand-role-badge">Seller</span>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('seller.dashboard') }}" class="nav-item {{ Request::is('seller/dashboard') ? 'active' : '' }}">
            <span class="material-symbols-outlined">grid_view</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('seller.products.index') }}" class="nav-item {{ Request::is('seller/products*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">inventory_2</span>
            <span>My Products</span>
        </a>

        <a href="{{ route('seller.orders.index') }}" class="nav-item {{ Request::is('seller/orders*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">receipt_long</span>
            <span>Incoming Orders</span>
        </a>

        <div class="sidebar-divider"></div>

        <a href="{{ url('/') }}" class="nav-item">
            <span class="material-symbols-outlined">storefront</span>
            <span>View Storefront</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Log out of seller session?');">
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
            <span class="header-title">@yield('page-title', 'Seller Panel')</span>
        </div>

        <div class="header-right">
            <button class="icon-btn" title="Notifications">
                <span class="material-symbols-outlined">notifications</span>
            </button>

            <div class="profile-menu">
                @auth
                    <div class="avatar" title="{{ Auth::user()->name }} (Seller)">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- CONTENT WRAPPER -->
    <div class="content-body">
