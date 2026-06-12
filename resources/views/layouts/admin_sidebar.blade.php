<!-- Google Font & Material Symbols -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

<style>
    :root {
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
        padding: 10px 16px 10px 48px;
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
        .header-search {
            width: 200px;
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
            <span class="material-symbols-outlined">dashboard</span>
        </div>
        <span class="brand-name">FILKOMSHOP</span>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <span class="material-symbols-outlined">grid_view</span>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('admin.products.index') }}" class="nav-item {{ Request::is('admin/products*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">shopping_bag</span>
            <span>Manage Products</span>
        </a>
        
        <a href="{{ route('admin.categories.index') }}" class="nav-item {{ Request::is('admin/categories*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">category</span>
            <span>Manage Categories</span>
        </a>

        <a href="{{ route('admin.users.index') }}" class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
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

    <!-- CONTENT WRAPPER -->
    <div class="content-body">
