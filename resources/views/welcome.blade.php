<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>FILKOMSHOP</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
    ])

</head>

<body class="bg-[#f3f3f3] min-h-screen m-0">

    @if(isset($page) && $page === 'access-denied')

        <div class="min-h-screen flex items-center justify-center px-6">

            <div class="bg-white shadow-2xl rounded-3xl p-14 text-center max-w-2xl w-full">

                <div class="text-8xl mb-8">
                    🔒
                </div>

                <h1 class="text-5xl font-extrabold text-red-500 mb-5">
                    Access Denied
                </h1>

                <p class="text-gray-500 text-xl mb-10">
                    You do not have permission to access this page.
                </p>

                <a
                    href="/"
                    class="inline-block bg-[#1f232b] hover:bg-[#343a46] text-white px-8 py-4 rounded-2xl font-semibold transition"
                >
                    Back to Home
                </a>

            </div>

        </div>

    @elseif(isset($page) && $page === 'admin-products')

        <div class="min-h-screen bg-[#f3f3f3]">

            <nav class="fixed left-0 right-0 top-0 w-full z-50 bg-slate-950 shadow-lg border-b border-slate-800" style="background-color: #1f232b;">

                <div class="max-w-7xl mx-auto px-6">

                    <div class="flex justify-between items-center h-16">

                        <div class="flex items-center gap-10">

                            <a
                                href="/"
                                class="text-3xl font-extrabold text-white tracking-wide"
                            >
                                FILKOMSHOP
                            </a>

                            <a
                                href="/"
                                class="text-gray-300 hover:text-white transition"
                            >
                                Home
                            </a>

                        </div>

                        <div class="flex items-center gap-4">

                            <div class="rounded-xl px-3 py-2 shadow-lg">

                                <form
                                    action="{{ route('admin.products.index') }}"
                                    method="GET"
                                    class="flex items-center gap-2"
                                >

                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Search product..."
                                        class="w-64 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none text-white"
                                    >

                                    <button
                                        type="submit"
                                        class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium"
                                    >
                                        Search
                                    </button>

                                </form>

                            </div>

                            <div class="rounded-xl px-3 py-2 shadow-lg">

                                <div class="bg-yellow-400 text-white px-4 py-2 rounded-lg font-semibold">
                                    Admin
                                </div>

                            </div>

                            @auth

                                <div class="rounded-xl px-3 py-2 shadow-lg">

                                    <form
                                        action="{{ route('logout') }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium"
                                        >
                                            Logout
                                        </button>

                                    </form>

                                </div>

                            @endauth

                        </div>

                    </div>

                </div>

            </nav>

            <div class="max-w-7xl mx-auto px-6 pt-28 pb-10">

                <div class="mt-12">

                    <div class="flex justify-between items-center mb-6">

                        <div>

                            <h2 class="text-5xl font-bold text-[#1f232b]">
                                Product List
                            </h2>

                            <p class="text-gray-500 text-2xl">
                                Browse all available products
                            </p>

                        </div>

                    </div>

                    @if(session('success'))

                        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl mb-6">

                            {{ session('success') }}

                        </div>

                    @endif

                    @isset($productDetail)

                        <div class="bg-white rounded-2xl shadow-lg p-10">

                            <h2 class="text-5xl font-bold text-[#1f232b] mb-5">
                                {{ $productDetail->name }}
                            </h2>

                            <div class="space-y-5 text-lg">

                                <div>

                                    <span class="font-semibold text-gray-700">
                                        Price:
                                    </span>

                                    <span class="text-gray-600">
                                        Rp {{ number_format($productDetail->price, 0, ',', '.') }}
                                    </span>

                                </div>

                                <div>

                                    <span class="font-semibold text-gray-700">
                                        Stock:
                                    </span>

                                    <span class="text-gray-600">
                                        {{ $productDetail->stock }}
                                    </span>

                                </div>

                                <div>

                                    <span class="font-semibold text-gray-700">
                                        Description:
                                    </span>

                                    <p class="text-gray-600 mt-2 leading-relaxed">
                                        {{ $productDetail->description }}
                                    </p>

                                </div>

                            </div>

                            <div class="mt-10">

                                <a
                                    href="{{ route('admin.products.index') }}"
                                    class="bg-[#1f232b] hover:bg-[#343a46] text-white px-6 py-3 rounded-xl font-semibold transition"
                                >
                                    Back to Products
                                </a>

                            </div>

                        </div>

                    @else

                        @if($products->count() > 0)

                            <div class="grid grid-cols-1 gap-8">

                                @foreach($products as $product)

                                    <div class="bg-gradient-to-r from-[#1f232b] to-[#343a46] rounded-[2rem] shadow-xl overflow-hidden p-5">

                                        <div class="text-white">

                                            <h3 class="text-3xl font-bold">
                                                {{ $product->name }}
                                            </h3>

                                            <p class="text-2xl mt-2">
                                                Stock: {{ $product->stock }}
                                            </p>

                                        </div>

                                        <div class="flex gap-2 mt-5">

                                            <a
                                                href="{{ route('admin.products.show', $product->id) }}"
                                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-black text-center py-3 rounded-full text-2xl font-bold transition"
                                            >
                                                Read
                                            </a>

                                            <form
                                                action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST"
                                                class="flex-1"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"
                                                    class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-full text-2xl font-bold transition"
                                                >
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                @endforeach
                            </div>

                        @else

                            <div class="bg-white rounded-2xl shadow-md p-20 text-center">

                                <h2 class="text-5xl font-bold text-[#1f232b]">
                                    No Products Yet
                                </h2>

                                <p class="text-gray-500 mt-5 text-xl">
                                    Products will appear here once sellers add items.
                                </p>

                            </div>

                        @endif

                        <div class="mt-10">

                            {{ $products->links() }}

                        </div>

                    @endisset

                </div>

            </div>

            <footer class="bg-[#1f232b] text-white py-6 mt-16">

                <div class="text-center">

                    © 2026 FILKOMSHOP

                </div>

            </footer>

        </div>

    @else

        <div class="min-h-screen flex items-center justify-center">

            <div class="text-center">

                <h1 class="text-5xl font-extrabold text-[#1f232b]">
                    FILKOMSHOP
                </h1>

                <p class="text-gray-500 mt-5 text-xl">
                    Welcome to FilkomShop
                </p>

                <div class="mt-10 flex justify-center gap-4">

                    @guest

                        <a
                            href="{{ route('login') }}"
                            class="bg-[#1f232b] hover:bg-[#343a46] text-white px-6 py-3 rounded-xl font-semibold"
                        >
                            Login
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-3 rounded-xl font-semibold"
                        >
                            Register
                        </a>

                    @else

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="bg-[#1f232b] hover:bg-[#343a46] text-white px-6 py-3 rounded-xl font-semibold"
                        >
                            Open Item Management
                        </a>

                    @endguest

                </div>

            </div>

        </div>

    @endif

</body>

</html>