<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - FILKOMSHOP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f3f3f3] min-h-screen m-0">

    @include('layouts.admin_sidebar')

    <div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center mb-8">
        <div>
            <h1 class="text-5xl font-bold text-[#1f232b]">
                Manage Categories
            </h1>
            <p class="text-gray-500 text-xl mt-2">
                Create, read, and update category classifications
            </p>
        </div>

        <div>
            <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center justify-center rounded-full bg-yellow-450 hover:bg-yellow-500 bg-[#ffc107] text-[#212529] px-6 py-3.5 text-base font-semibold transition gap-2 shadow-sm">
                <span class="material-symbols-outlined text-lg font-bold">add</span>
                Create Category
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-250 text-emerald-800 px-5 py-4 rounded-2xl mb-6 text-sm font-medium flex items-center gap-3 shadow-sm">
        <span class="material-symbols-outlined text-emerald-600">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider w-20">ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Category Name</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-wider text-right pr-12 w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $category)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-5 text-sm font-semibold text-slate-400">#{{ $category->id }}</td>
                        <td class="px-6 py-5 text-base font-extrabold text-[#202124]">{{ $category->name }}</td>
                        <td class="px-6 py-5">
                            <span class="inline-flex items-center text-xs font-bold bg-[#e8f0fe] text-[#1a73e8] border border-[#1a73e8]/10 px-3 py-1 rounded-full">
                                {{ $category->slug ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right pr-12">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="inline-flex items-center justify-center rounded-full border border-slate-250 bg-white hover:bg-slate-50 px-4 py-2 text-xs font-bold text-slate-700 transition gap-1.5 shadow-sm">
                                <span class="material-symbols-outlined text-sm font-bold text-slate-550">edit</span>
                                Edit
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                            <span class="material-symbols-outlined text-slate-300 mb-2" style="font-size: 48px;">category</span>
                            <div class="text-base font-bold text-slate-800">No categories found</div>
                            <div class="text-sm mt-1">Add new classifications to organize your items.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('layouts.admin_sidebar_footer')

</body>
</html>