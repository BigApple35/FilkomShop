<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($productDetail) ? 'Edit Product' : 'Add Product' }} – FILKOMSHOP</title>
    <meta name="description" content="{{ isset($productDetail) ? 'Edit your product listing' : 'Add a new product to your shop' }} on FILKOMSHOP.">
</head>
<body>

@section('page-title', isset($productDetail) ? 'Edit Product' : 'Add New Product')
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

    /* Form Card */
    .form-card {
        background: var(--md-sys-color-surface);
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 24px;
        padding: 32px;
        max-width: 900px;
    }

    /* Error alert */
    .alert-error {
        background: var(--md-sys-color-error-container);
        color: var(--md-sys-color-on-error-container);
        padding: 14px 20px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 24px;
    }
    .alert-error ul { margin: 6px 0 0 0; padding-left: 20px; }
    .alert-error li { margin-bottom: 2px; }

    /* Form Groups */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    @media (max-width: 640px) { .form-grid { grid-template-columns: 1fr; } }
    .form-full { grid-column: 1 / -1; }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 20px;
    }
    .form-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: var(--md-sys-color-text-secondary);
    }
    .form-input, .form-textarea, .form-select {
        padding: 12px 16px;
        border-radius: 14px;
        border: 1px solid var(--md-sys-color-outline);
        background: var(--md-sys-color-surface);
        font-family: inherit;
        font-size: 14px;
        font-weight: 500;
        color: var(--md-sys-color-text-primary);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        width: 100%;
        box-sizing: border-box;
    }
    .form-input:focus, .form-textarea:focus, .form-select:focus {
        border-color: var(--md-sys-color-primary);
        box-shadow: 0 0 0 3px rgba(13,126,85,0.12);
    }
    .form-textarea { resize: vertical; min-height: 120px; }

    /* Toggle */
    .toggle-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        background: var(--md-sys-color-surface-variant);
        border-radius: 14px;
        cursor: pointer;
    }
    .toggle-row input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--md-sys-color-primary);
        cursor: pointer;
    }
    .toggle-label {
        font-size: 14px;
        font-weight: 600;
        color: var(--md-sys-color-text-primary);
        cursor: pointer;
        user-select: none;
    }

    /* File input */
    .file-input {
        padding: 10px 16px;
        border-radius: 14px;
        border: 1px dashed var(--md-sys-color-outline);
        background: var(--md-sys-color-surface-variant);
        font-family: inherit;
        font-size: 13px;
        color: var(--md-sys-color-text-secondary);
        cursor: pointer;
        width: 100%;
        box-sizing: border-box;
    }

    /* Existing Photos */
    .photos-section {
        background: var(--md-sys-color-surface-variant);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .photos-section-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: var(--md-sys-color-text-secondary);
        margin-bottom: 12px;
    }
    .photos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
    }
    .photos-grid img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid var(--md-sys-color-outline);
    }

    /* Submit buttons */
    .form-actions {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 12px;
        padding-top: 24px;
        border-top: 1px solid var(--md-sys-color-outline);
        margin-top: 8px;
        align-items: center;
    }
    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 28px;
        border-radius: 100px;
        background: var(--md-sys-color-primary);
        color: #fff;
        font-family: inherit;
        font-size: 15px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-submit:hover { background: var(--md-sys-color-on-primary-container); }
    .btn-submit .material-symbols-outlined { font-size: 20px; }
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 14px 20px;
        border-radius: 100px;
        background: var(--md-sys-color-surface-variant);
        color: var(--md-sys-color-text-secondary);
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid var(--md-sys-color-outline);
        transition: all 0.2s;
    }
    .btn-cancel:hover {
        background: var(--md-sys-color-outline);
        color: var(--md-sys-color-text-primary);
    }
</style>

    <!-- Page Header -->
    <div class="page-header">
        <a href="{{ route('seller.products.index') }}" class="btn-back">
            <span class="material-symbols-outlined">arrow_back</span>
            My Products
        </a>
        <h1>{{ isset($productDetail) ? 'Edit Product' : 'Add New Product' }}</h1>
    </div>

    <!-- Form Card -->
    <div class="form-card">

        @if ($errors->any())
        <div class="alert-error">
            <strong>Please fix the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form
            action="{{ isset($productDetail) ? route('admin.products.update', $productDetail->id) : route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @if(isset($productDetail))
            @method('PUT')
            @endif

            <!-- Name & Price -->
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="name">Product Name <span style="color:var(--md-sys-color-error)">*</span></label>
                    <input
                        id="name"
                        class="form-input"
                        type="text"
                        name="name"
                        value="{{ old('name', $productDetail->name ?? '') }}"
                        placeholder="e.g. Wireless Earbuds Pro"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="price">Price (Rupiah) <span style="color:var(--md-sys-color-error)">*</span></label>
                    <input
                        id="price"
                        class="form-input"
                        type="number"
                        name="price"
                        min="0"
                        step="0.01"
                        value="{{ old('price', $productDetail->price ?? '') }}"
                        placeholder="e.g. 150000"
                        required
                    >
                </div>
            </div>

            <!-- Stock & Active -->
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label" for="stock">Available Stock <span style="color:var(--md-sys-color-error)">*</span></label>
                    <input
                        id="stock"
                        class="form-input"
                        type="number"
                        name="stock"
                        min="0"
                        value="{{ old('stock', $productDetail->stock ?? '') }}"
                        placeholder="e.g. 50"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select id="category_id" name="category_id" class="form-select">
                        <option value="">— No Category —</option>
                        @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $productDetail->category_id ?? '') == $category->id ? 'selected' : '' }}
                        >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label class="form-label" for="description">Product Description</label>
                <textarea
                    id="description"
                    class="form-textarea"
                    name="description"
                    placeholder="Describe your product — features, materials, usage, etc."
                    rows="5"
                >{{ old('description', $productDetail->description ?? '') }}</textarea>
            </div>

            <!-- Publish Toggle -->
            <div class="form-group">
                <label class="toggle-row" for="is_active">
                    <input
                        id="is_active"
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $productDetail->is_active ?? true) ? 'checked' : '' }}
                    >
                    <span class="toggle-label">Publish this product — visible to customers on the storefront</span>
                </label>
            </div>

            <!-- Existing Photos -->
            @if(isset($productDetail) && ($productDetail->image_urls || $productDetail->image_url))
            <div class="photos-section">
                <div class="photos-section-label">Existing Product Photos</div>
                <div class="photos-grid">
                    @foreach(array_filter(array_merge([$productDetail->image_url], $productDetail->image_urls ?? [])) as $img)
                    @if($img)
                    <img
                        src="{{ asset($img) }}"
                        alt="Product photo"
                        onerror="this.onerror=null; this.style.opacity='0.3';"
                    >
                    @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- New Photos -->
            <div class="form-group">
                <label class="form-label" for="images">
                    {{ isset($productDetail) ? 'Add More Photos' : 'Product Photos' }}
                </label>
                <p style="font-size:12px;color:var(--md-sys-color-text-secondary);margin:0 0 6px;">Upload one or more images (max 2MB each). JPG, PNG, WEBP supported.</p>
                <input
                    id="images"
                    type="file"
                    name="images[]"
                    accept="image/*"
                    multiple
                    class="file-input"
                >
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <span class="material-symbols-outlined">{{ isset($productDetail) ? 'save' : 'add_box' }}</span>
                    {{ isset($productDetail) ? 'Save Changes' : 'Create Product Listing' }}
                </button>
                <a href="{{ route('seller.products.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>

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
