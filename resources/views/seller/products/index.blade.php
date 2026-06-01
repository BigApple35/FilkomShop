<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products – FILKOMSHOP</title>
    <meta name="description" content="Manage your product listings on FILKOMSHOP seller panel.">
</head>
<body>

@section('page-title', 'My Products')
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

    /* Search bar */
    .search-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }
    .search-bar form {
        display: flex;
        gap: 10px;
        width: 100%;
        max-width: 500px;
    }
    .search-input {
        flex: 1;
        padding: 10px 16px 10px 40px;
        border-radius: 100px;
        border: 1px solid var(--md-sys-color-outline);
        background: var(--md-sys-color-surface);
        font-family: inherit;
        font-size: 14px;
        color: var(--md-sys-color-text-primary);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .search-input:focus {
        border-color: var(--md-sys-color-primary);
        box-shadow: 0 0 0 3px rgba(13,126,85,0.12);
    }
    .search-wrap {
        position: relative;
        flex: 1;
    }
    .search-wrap .material-symbols-outlined {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: var(--md-sys-color-text-secondary);
        pointer-events: none;
    }
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        border-radius: 100px;
        background: var(--md-sys-color-primary);
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        font-family: inherit;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-primary:hover { background: var(--md-sys-color-on-primary-container); }
    .btn-primary .material-symbols-outlined { font-size: 18px; }

    /* Alert */
    .alert-success {
        background: var(--md-sys-color-success-container);
        color: var(--md-sys-color-on-success-container);
        padding: 14px 20px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Product Grid */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    .product-card {
        background: var(--md-sys-color-surface);
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .product-card:hover {
        box-shadow: 0 4px 20px rgba(13,126,85,0.12);
        transform: translateY(-2px);
    }

    .product-img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        background: var(--md-sys-color-surface-variant);
        display: block;
    }
    .product-img-placeholder {
        width: 100%;
        height: 160px;
        background: var(--md-sys-color-surface-variant);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--md-sys-color-text-secondary);
    }
    .product-img-placeholder .material-symbols-outlined { font-size: 36px; opacity: 0.4; }

    .product-body {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .product-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--md-sys-color-text-primary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-chips {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }
    .chip {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 100px;
    }
    .chip-price { background: var(--md-sys-color-secondary-container); color: #1a73e8; }
    .chip-stock { background: var(--md-sys-color-success-container); color: var(--md-sys-color-on-success-container); }
    .chip-inactive { background: var(--md-sys-color-error-container); color: var(--md-sys-color-on-error-container); }

    .product-actions {
        padding: 12px 16px;
        border-top: 1px solid var(--md-sys-color-outline);
        display: flex;
        gap: 8px;
    }
    .btn-view-sm, .btn-edit-sm, .btn-delete-sm {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 700;
        padding: 8px 4px;
        border-radius: 100px;
        text-decoration: none;
        transition: all 0.2s;
        font-family: inherit;
        cursor: pointer;
        border: none;
    }
    .btn-view-sm { background: var(--md-sys-color-surface-variant); color: var(--md-sys-color-text-primary); }
    .btn-view-sm:hover { background: var(--md-sys-color-outline); }
    .btn-edit-sm { background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container); }
    .btn-edit-sm:hover { background: var(--md-sys-color-primary); color: #fff; }
    .btn-delete-sm { background: var(--md-sys-color-error-container); color: var(--md-sys-color-on-error-container); }
    .btn-delete-sm:hover { background: var(--md-sys-color-error); color: #fff; }
    .btn-view-sm .material-symbols-outlined,
    .btn-edit-sm .material-symbols-outlined,
    .btn-delete-sm .material-symbols-outlined { font-size: 15px; }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 64px 20px;
        background: var(--md-sys-color-surface);
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 20px;
        color: var(--md-sys-color-text-secondary);
    }
    .empty-state .material-symbols-outlined { font-size: 56px; opacity: 0.35; display: block; margin-bottom: 12px; }
    .empty-state strong { font-size: 18px; font-weight: 700; color: var(--md-sys-color-text-primary); display: block; }
    .empty-state p { font-size: 14px; margin: 6px 0 20px; }

    /* Pagination */
    .pagination-wrap {
        margin-top: 28px;
    }
</style>

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>My Products</h1>
            <p>Manage and update your product listings</p>
        </div>
        <a href="{{ route('seller.products.create') }}" class="btn-primary">
            <span class="material-symbols-outlined">add</span>
            Add Product
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert-success">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <!-- Search -->
    <div class="search-bar">
        <form method="GET" action="{{ route('seller.products.index') }}">
            <div class="search-wrap">
                <span class="material-symbols-outlined">search</span>
                <input
                    class="search-input"
                    type="text"
                    name="search"
                    placeholder="Search your products..."
                    value="{{ request('search') }}"
                >
            </div>
            <button type="submit" class="btn-primary">Search</button>
        </form>
    </div>

    <!-- Product Grid -->
    @if($products->count() > 0)
    <div class="products-grid">
        @foreach($products as $product)
        <div class="product-card">
            @if($product->image_url)
                <img
                    src="{{ asset($product->image_url) }}"
                    alt="{{ $product->name }}"
                    class="product-img"
                    onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';"
                >
                <div class="product-img-placeholder" style="display:none;">
                    <span class="material-symbols-outlined">image_not_supported</span>
                </div>
            @else
                <div class="product-img-placeholder">
                    <span class="material-symbols-outlined">image_not_supported</span>
                </div>
            @endif

            <div class="product-body">
                <div class="product-name" title="{{ $product->name }}">{{ $product->name }}</div>
                <div class="product-chips">
                    <span class="chip chip-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    <span class="chip chip-stock">Stock: {{ $product->stock }}</span>
                    @if(!$product->is_active)
                    <span class="chip chip-inactive">Inactive</span>
                    @endif
                </div>
            </div>

            <div class="product-actions">
                <a href="{{ route('seller.products.show', $product->id) }}" class="btn-view-sm">
                    <span class="material-symbols-outlined">visibility</span>
                    View
                </a>
                <a href="{{ route('seller.products.edit', $product->id) }}" class="btn-edit-sm">
                    <span class="material-symbols-outlined">edit</span>
                    Edit
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="flex:1; margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete-sm" style="width:100%;" onclick="return confirm('Delete \'{{ addslashes($product->name) }}\'? This cannot be undone.')">
                        <span class="material-symbols-outlined">delete</span>
                        Del
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-wrap">{{ $products->links() }}</div>

    @else
    <div class="empty-state">
        <span class="material-symbols-outlined">inventory_2</span>
        <strong>No Products Yet</strong>
        <p>You haven't added any products to your shop. Start by adding your first item.</p>
        <a href="{{ route('seller.products.create') }}" class="btn-primary" style="display:inline-flex; margin: 0 auto;">
            <span class="material-symbols-outlined">add</span>
            Add Your First Product
        </a>
    </div>
    @endif

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
