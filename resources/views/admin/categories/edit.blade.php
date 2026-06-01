<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - FILKOMSHOP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f3f3f3] min-h-screen m-0">

    @include('layouts.admin_sidebar')

    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-[#1f232b] shadow-sm hover:bg-slate-50 transition">
            <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
            Back to List
        </a>
    </div>

    <div class="flex flex-col gap-4 mb-8">
        <h1 class="text-5xl font-bold text-[#1f232b]">
            Edit Category
        </h1>
        <p class="text-gray-500 text-xl">
            Update category classification details
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-850 px-5 py-4 rounded-2xl mb-6 text-sm font-medium shadow-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-8 max-w-2xl w-full">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6 m-0">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="block text-sm font-bold text-[#202124] pl-1">Category Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    required 
                    value="{{ old('name', $category->name) }}"
                    placeholder="e.g. Electronics, Clothing..."
                    class="w-full px-5 py-3.5 border border-slate-200 rounded-2xl outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] bg-slate-50 transition text-sm font-medium text-slate-800"
                />
            </div>

            <div class="space-y-2">
                <label for="slug" class="block text-sm font-bold text-[#202124] pl-1">Slug <span class="text-slate-400 font-normal">(Optional)</span></label>
                <input 
                    type="text" 
                    name="slug" 
                    id="slug" 
                    value="{{ old('slug', $category->slug) }}"
                    placeholder="e.g. electronics-devices"
                    class="w-full px-5 py-3.5 border border-slate-200 rounded-2xl outline-none focus:border-[#1a73e8] focus:ring-1 focus:ring-[#1a73e8] bg-slate-50 transition text-sm font-medium text-slate-800"
                />
                <p class="text-xs text-slate-400 pl-2">Leave empty to automatically generate from the category name.</p>
            </div>

            <div class="pt-4 border-t border-slate-100 flex gap-3">
                <button 
                    type="submit"
                    class="inline-flex items-center justify-center rounded-full bg-[#1a73e8] hover:bg-[#1557b0] px-6 py-3 text-sm font-semibold text-white transition gap-2 shadow-sm"
                >
                    <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                    Update Category
                </button>
                <a 
                    href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white hover:bg-slate-50 px-6 py-3 text-sm font-semibold text-slate-700 transition shadow-sm"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>

    @include('layouts.admin_sidebar_footer')

</body>
</html>