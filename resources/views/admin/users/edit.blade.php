<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Pengguna - FILKOMSHOP Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f3f3f3] min-h-screen m-0">

    <nav class="fixed left-0 right-0 top-0 w-full z-50 shadow-lg border-b border-slate-800" style="background-color: #1f232b;">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-10">
                    <a href="{{ url('/') }}" class="text-3xl font-extrabold text-white tracking-wide">FILKOMSHOP</a>
                    <a href="{{ route('admin.products.index') }}" class="text-gray-300 hover:text-white transition">Product List</a>
                    <a href="{{ route('admin.users.index') }}" class="text-white font-semibold">Manage Users</a>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                    <div class="bg-white/10 border border-white/20 px-4 py-2 rounded-xl flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white text-[#1f232b] flex items-center justify-center font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="text-left">
                            <div class="text-white font-semibold leading-tight">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-300">{{ ucfirst(Auth::user()->role) }}</div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="bg-white hover:bg-gray-100 text-black px-4 py-2 rounded-lg font-medium transition">Logout</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 pt-28 pb-10">
        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-xl p-8 max-w-3xl mx-auto">

            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between mb-8">
                <div>
                    <h1 class="text-5xl font-bold text-[#1f232b]">Edit User</h1>
                    <p class="text-slate-500 mt-3">Perbarui data profil, email, kredensial, atau peran pengguna sistem.</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-[#1f232b] hover:bg-slate-50 transition">
                    Back to List
                </a>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="name">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-slate-400" required />
                    @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="email">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-slate-400" required />
                    @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="password">New Password</label>
                    <input id="password" name="password" type="password" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none focus:border-slate-400" />
                    <p class="text-sm text-slate-400 mt-2 pl-2">Biarkan kosong jika tidak ingin mengubah password user.</p>
                    @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2" for="role">Role Status</label>
                    <select id="role" name="role" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-slate-900 focus:outline-none" required>
                        <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="seller" {{ old('role', $user->role) == 'seller' ? 'selected' : '' }}>Seller</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="grid gap-4 sm:grid-cols-2 pt-4">
                    <button type="submit" class="w-full rounded-full bg-[#1f232b] px-6 py-4 text-lg font-semibold text-white hover:bg-[#343a46] transition">
                        Update User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="w-full inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-6 py-4 text-lg font-semibold text-[#1f232b] hover:bg-slate-50 transition">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>

</body>

</html>