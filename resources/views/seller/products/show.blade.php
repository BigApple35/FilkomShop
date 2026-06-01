<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $productDetail->name }} – FILKOMSHOP</title>
    <meta name="description" content="Product detail view for {{ $productDetail->name }} in your FILKOMSHOP seller panel.">
</head>
<body>

@section('page-title', 'Product Details')
@include('layouts.seller_sidebar')

<style>
    .page-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }
    .page-header h1 {
        font-size: 22px;
        font-weight: 800;
        margin: 0;
        color: var(--md-sys-color-text-primary);
        flex: 1;
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
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .btn-back:hover { background: var(--md-sys-color-surface-variant); color: var(--md-sys-color-text-primary); }
    .btn-back .material-symbols-outlined { font-size: 18px; }

    .detail-layout {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: 28px;
        align-items: start;
    }
    @media (max-width: 900px) { .detail-layout { grid-template-columns: 1fr; } }

    /* Image Panel */
    .image-panel {
        background: var(--md-sys-color-surface);
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        group: true;
    }
    .image-panel .product-main-img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        display: block;
    }
    .image-placeholder {
        width: 100%;
        height: 380px;
        background: var(--md-sys-color-surface-variant);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--md-sys-color-text-secondary);
    }
    .image-placeholder .material-symbols-outlined { font-size: 56px; opacity: 0.3; }

    /* Upload overlay */
    .upload-form {
        margin: 0;
    }
    .upload-label {
        display: block;
        cursor: pointer;
        position: relative;
    }
    .upload-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }
    .upload-label:hover .upload-overlay { background: rgba(0,0,0,0.35); }
    .upload-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.95);
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 13px;
        font-weight: 700;
        color: var(--md-sys-color-text-primary);
        opacity: 0;
        transition: opacity 0.2s;
    }
    .upload-badge .material-symbols-outlined { font-size: 16px; }
    .upload-label:hover .upload-badge { opacity: 1; }

    /* Info Panel */
    .info-panel {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .card {
        background: var(--md-sys-color-surface);
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 20px;
        padding: 24px;
    }

    .product-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--md-sys-color-text-primary);
        line-height: 1.25;
        margin-bottom: 6px;
    }
    .product-meta {
        font-size: 13px;
        color: var(--md-sys-color-text-secondary);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .product-meta .material-symbols-outlined { font-size: 16px; }

    .stats-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 16px;
    }
    .stat-box {
        padding: 14px 16px;
        border-radius: 14px;
        background: var(--md-sys-color-surface-variant);
    }
    .stat-box-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--md-sys-color-text-secondary);
        margin-bottom: 4px;
    }
    .stat-box-value {
        font-size: 20px;
        font-weight: 800;
        color: var(--md-sys-color-text-primary);
    }
    .stat-box-value.price { color: var(--md-sys-color-primary); }

    .badge-active { background: var(--md-sys-color-success-container); color: var(--md-sys-color-on-success-container); padding: 4px 12px; border-radius: 100px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }
    .badge-inactive { background: var(--md-sys-color-error-container); color: var(--md-sys-color-on-error-container); padding: 4px 12px; border-radius: 100px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }

    .description-box {
        font-size: 14px;
        color: var(--md-sys-color-text-secondary);
        line-height: 1.65;
        white-space: pre-line;
    }

    .section-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--md-sys-color-text-secondary);
        margin-bottom: 12px;
    }

    /* Action Buttons */
    .action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px;
        border-radius: 100px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        box-sizing: border-box;
    }
    .btn-edit { background: var(--md-sys-color-primary); color: #fff; }
    .btn-edit:hover { background: var(--md-sys-color-on-primary-container); }
    .btn-delete { background: var(--md-sys-color-error-container); color: var(--md-sys-color-on-error-container); }
    .btn-delete:hover { background: var(--md-sys-color-error); color: #fff; }
    .action-btn .material-symbols-outlined { font-size: 20px; }
</style>

    <!-- Page Header -->
    <div class="page-header">
        <a href="{{ route('seller.products.index') }}" class="btn-back">
            <span class="material-symbols-outlined">arrow_back</span>
            My Products
        </a>
        <h1>{{ $productDetail->name }}</h1>
    </div>

    @if(session('success'))
    <div style="background:var(--md-sys-color-success-container);color:var(--md-sys-color-on-success-container);padding:14px 20px;border-radius:14px;font-size:14px;font-weight:600;margin-bottom:20px;display:flex;align-items:center;gap:8px;">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <div class="detail-layout">

        <!-- Image Panel -->
        <div class="image-panel">
            <form class="upload-form" action="{{ route('admin.products.image.upload', $productDetail->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="imgInput" name="image" accept="image/*" style="display:none;" onchange="this.form.submit()">
                <label class="upload-label" for="imgInput">
                    @php
                        $mainImg = (is_array($productDetail->image_urls) && isset($productDetail->image_urls[0]))
                            ? $productDetail->image_urls[0]
                            : $productDetail->image_url;
                    @endphp
                    @if($mainImg)
                        <img src="{{ asset($mainImg) }}" alt="{{ $productDetail->name }}" class="product-main-img"
                             onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='flex';">
                        <div class="image-placeholder" style="display:none;">
                            <span class="material-symbols-outlined">image_not_supported</span>
                        </div>
                    @else
                        <div class="image-placeholder">
                            <span class="material-symbols-outlined">add_photo_alternate</span>
                        </div>
                    @endif
                    <div class="upload-overlay">
                        <span class="upload-badge">
                            <span class="material-symbols-outlined">photo_camera</span>
                            Change Photo
                        </span>
                    </div>
                </label>
            </form>
        </div>

        <!-- Info Panel -->
        <div class="info-panel">

            <!-- Main Info Card -->
            <div class="card">
                <div class="product-title">{{ $productDetail->name }}</div>
                <div class="product-meta">
                    <span class="material-symbols-outlined">store</span>
                    {{ $productDetail->seller->shop_name ?? Auth::user()->name }}
                    &nbsp;·&nbsp;
                    @if($productDetail->is_active)
                        <span class="badge-active"><span class="material-symbols-outlined" style="font-size:14px;">visibility</span>Active</span>
                    @else
                        <span class="badge-inactive"><span class="material-symbols-outlined" style="font-size:14px;">visibility_off</span>Inactive</span>
                    @endif
                </div>
                <div class="stats-row">
                    <div class="stat-box">
                        <div class="stat-box-label">Price</div>
                        <div class="stat-box-value price">Rp {{ number_format($productDetail->price, 0, ',', '.') }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-box-label">Stock</div>
                        <div class="stat-box-value">{{ $productDetail->stock }}</div>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            @if($productDetail->description)
            <div class="card">
                <div class="section-label">Description</div>
                <div class="description-box">{{ $productDetail->description }}</div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div style="display:flex;flex-direction:column;gap:10px;">
                <a href="{{ route('seller.products.edit', $productDetail->id) }}" class="action-btn btn-edit">
                    <span class="material-symbols-outlined">edit</span>
                    Edit Product Details
                </a>
                <form action="{{ route('admin.products.destroy', $productDetail->id) }}" method="POST" style="margin:0;">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="action-btn btn-delete"
                        onclick="return confirm('Are you sure you want to delete \'{{ addslashes($productDetail->name) }}\'? This cannot be undone.')"
                    >
                        <span class="material-symbols-outlined">delete</span>
                        Delete Product Listing
                    </button>
                </form>
            </div>

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
