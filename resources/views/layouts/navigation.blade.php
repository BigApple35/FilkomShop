<!-- Google Font & Material Symbols -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

<style>
    .google-nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 64px;
        background-color: #ffffff !important;
        border-bottom: 1px solid #dadce0 !important;
        box-shadow: 0 1px 2px 0 rgba(60,64,67,0.05) !important;
        z-index: 999;
        display: flex;
        align-items: center;
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    }

    .google-nav-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        box-sizing: border-box;
    }

    /* Brand Logo */
    .google-nav-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #202124 !important;
        font-weight: 800;
        font-size: 20px;
        letter-spacing: -0.5px;
        transition: opacity 0.2s;
    }

    .google-nav-brand:hover {
        opacity: 0.85;
    }

    .brand-accent-f { color: #1a73e8; }
    .brand-accent-i { color: #ea4335; }
    .brand-accent-l { color: #fbbc05; }
    .brand-accent-k { color: #34a853; }

    /* Center Search Bar */
    .google-nav-search {
        position: relative;
        max-width: 460px;
        width: 100%;
        margin: 0 16px;
    }

    .google-nav-search form {
        display: flex;
        align-items: center;
        margin: 0;
    }

    .google-nav-search input {
        width: 100%;
        background-color: #f1f3f4;
        border: 1px solid transparent;
        border-radius: 28px;
        padding: 10px 16px 10px 48px;
        font-family: inherit;
        font-size: 14px;
        color: #202124;
        outline: none;
        transition: background-color 0.2s, box-shadow 0.2s, border-color 0.2s;
        box-sizing: border-box;
        height: 40px;
    }

    .google-nav-search input:focus {
        background-color: #ffffff;
        border-color: #dadce0;
        box-shadow: 0 1px 2px 0 rgba(60,64,67,0.15), 0 1px 3px 1px rgba(60,64,67,0.1);
    }

    .google-nav-search .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #5f6368;
        pointer-events: none;
        font-size: 20px;
    }

    /* Right Section */
    .google-nav-actions {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* Nav Links */
    .google-nav-link {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #5f6368 !important;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 20px;
        transition: all 0.2s ease;
    }

    .google-nav-link:hover {
        background-color: #f1f3f4;
        color: #202124 !important;
    }

    .google-nav-link.active {
        background-color: #e8f0fe;
        color: #1967d2 !important;
    }

    /* Profile Menu & Dropdown */
    .google-profile-menu {
        position: relative;
    }

    .google-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #1a73e8;
        color: #ffffff;
        font-weight: 700;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 2px solid #dadce0;
        transition: border-color 0.2s, transform 0.2s;
        user-select: none;
    }

    .google-avatar:hover {
        border-color: #1a73e8;
        transform: scale(1.03);
    }

    .google-dropdown {
        position: absolute;
        right: 0;
        top: 48px;
        width: 280px;
        background-color: #ffffff;
        border: 1px solid #dadce0;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        padding: 16px 0;
        display: none;
        flex-direction: column;
        z-index: 1000;
        animation: scaleIn 0.15s cubic-bezier(0, 0, 0.2, 1);
    }

    .google-dropdown.active {
        display: flex;
    }

    .google-dropdown-header {
        padding: 0 20px 12px 20px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .google-dropdown-name {
        font-weight: 700;
        font-size: 15px;
        color: #202124;
    }

    .google-dropdown-email {
        font-size: 12px;
        color: #5f6368;
        word-break: break-all;
    }

    .google-dropdown-role {
        align-self: flex-start;
        font-size: 10px;
        font-weight: 700;
        background-color: #e8f0fe;
        color: #1967d2;
        padding: 3px 8px;
        border-radius: 100px;
        text-transform: uppercase;
        margin-top: 4px;
        letter-spacing: 0.5px;
    }

    .google-dropdown-divider {
        height: 1px;
        background-color: #dadce0;
        margin: 8px 0;
    }

    .google-dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 20px;
        color: #3c4043 !important;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: background-color 0.2s;
    }

    .google-dropdown-item:hover {
        background-color: #f1f3f4;
    }

    .google-dropdown-item .material-symbols-outlined {
        font-size: 18px;
        color: #5f6368;
    }

    .google-logout-btn {
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 20px;
        color: #d93025;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        transition: background-color 0.2s;
    }

    .google-logout-btn:hover {
        background-color: #fce8e6;
    }

    .google-logout-btn .material-symbols-outlined {
        font-size: 18px;
        color: #d93025;
    }

    /* Guest Pill Buttons */
    .google-btn-login {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 20px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        color: #1a73e8 !important;
        border: 1px solid #dadce0;
        background-color: #ffffff;
        transition: all 0.2s ease;
    }

    .google-btn-login:hover {
        background-color: #f8f9fa;
        border-color: #1a73e8;
    }

    .google-btn-register {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 20px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        color: #ffffff !important;
        background-color: #1a73e8;
        border: 1px solid #1a73e8;
        transition: all 0.2s ease;
    }

    .google-btn-register:hover {
        background-color: #1557b0;
        border-color: #1557b0;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.95);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .google-nav-search {
            display: none; /* Hide search bar on mobile headers */
        }
        .google-nav-link span:not(.material-symbols-outlined) {
            display: none; /* Icon only on small screens */
        }
        .google-nav-link {
            padding: 8px;
        }
        .google-nav-container {
            padding: 0 16px;
        }
    }
</style>

<header class="google-nav">
    <div class="google-nav-container">
        <!-- Left Side: Brand Logo -->
        <a href="{{ url('/') }}" class="google-nav-brand">
            <span class="brand-accent-f">F</span><span class="brand-accent-i">I</span><span class="brand-accent-l">L</span><span class="brand-accent-k">K</span><span>OMSHOP</span>
        </a>

        <!-- Center Search Bar (functions globally) -->
        <div class="google-nav-search">
            <form action="{{ url('/products') }}" method="GET">
                <span class="material-symbols-outlined search-icon">search</span>
                <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
            </form>
        </div>

        <!-- Right Side Nav Actions -->
        <div class="google-nav-actions">
            <a href="{{ url('/') }}" class="google-nav-link {{ Request::is('/') ? 'active' : '' }}">
                <span class="material-symbols-outlined">storefront</span>
                <span>Store</span>
            </a>

            @auth
                <a href="{{ url('/cart') }}" class="google-nav-link {{ Request::is('cart') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span>Cart</span>
                </a>
                
                <a href="{{ route('history.index') }}" class="google-nav-link {{ Request::is('history*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">receipt_long</span>
                    <span>History</span>
                </a>

                <!-- Profile Dropdown Menu -->
                <div class="google-profile-menu">
                    <div class="google-avatar" id="googleAvatarBtn">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    
                    <div class="google-dropdown" id="googleDropdownMenu">
                        <div class="google-dropdown-header">
                            <span class="google-dropdown-name">{{ Auth::user()->name }}</span>
                            <span class="google-dropdown-email">{{ Auth::user()->email }}</span>
                            <span class="google-dropdown-role">{{ Auth::user()->role }}</span>
                        </div>
                        
                        <div class="google-dropdown-divider"></div>
                        
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="google-dropdown-item">
                                <span class="material-symbols-outlined">grid_view</span>
                                <span>Admin Dashboard</span>
                            </a>
                            <a href="{{ route('admin.products.index') }}" class="google-dropdown-item">
                                <span class="material-symbols-outlined">inventory</span>
                                <span>Manage Products</span>
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="google-dropdown-item">
                                <span class="material-symbols-outlined">group</span>
                                <span>Manage Users</span>
                            </a>
                        @endif

                        @if(Auth::user()->role === 'seller')
                            <a href="{{ route('seller.orders.index') }}" class="google-dropdown-item">
                                <span class="material-symbols-outlined">assignment</span>
                                <span>Incoming Orders</span>
                            </a>
                        @endif

                        <a href="{{ url('/profile') }}" class="google-dropdown-item">
                            <span class="material-symbols-outlined">person</span>
                            <span>Edit Profile</span>
                        </a>

                        <div class="google-dropdown-divider"></div>

                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="google-logout-btn">
                                <span class="material-symbols-outlined">logout</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="google-btn-login">Login</a>
                <a href="{{ route('register') }}" class="google-btn-register">Register</a>
            @endauth
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const avatarBtn = document.getElementById('googleAvatarBtn');
        const dropdownMenu = document.getElementById('googleDropdownMenu');

        if (avatarBtn && dropdownMenu) {
            avatarBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('active');
            });

            document.addEventListener('click', (e) => {
                if (!avatarBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('active');
                }
            });
        }
    });
</script>
