@extends('auth.layout')

@section('title', 'Sign in - Filkom Shop')

@section('content')
<div class="google-card w-full max-w-[450px] p-6 md:p-10 flex flex-col justify-between min-h-[500px]">
    <!-- Top Branding & Headers -->
    <div>
        <div class="text-center mb-6">
            <span class="text-[26px] font-bold tracking-tight select-none">
                <span class="text-[#4285F4]">F</span><span class="text-[#EA4335]">i</span><span class="text-[#FBBC05]">l</span><span class="text-[#34A853]">k</span><span class="text-[#4285F4]">o</span><span class="text-[#EA4335]">m</span><span class="ml-[2px]" style="color:#4285F4">S</span><span style="color:#EA4335">h</span><span style="color:#FBBC05">o</span><span style="color:#34A853">p</span>
            </span>
            
            <h1 class="text-2xl font-normal text-[#202124] mt-3">Sign in</h1>
            <p class="text-base text-[#5f6368] mt-1.5">to continue to Filkom Shop</p>
        </div>

        <!-- Session Status (Successful registration redirect or general status) -->
        @if (session('status'))
            <div class="bg-green-50 text-green-700 text-sm p-3 rounded mb-4 border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        <form id="loginForm" method="POST" action="{{ route('login') }}" class="mt-8">
            @csrf

            <!-- Email Input -->
            <div class="google-input-group">
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder=" " required autofocus
                    class="google-input @error('email') is-invalid @enderror" />
                <label for="email" class="google-label">Email address</label>
                
                @error('email')
                    <div class="text-[12px] text-[#d93025] mt-1.5 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="google-input-group">
                <input type="password" id="password" name="password" placeholder=" " required
                    class="google-input @error('password') is-invalid @enderror" />
                <label for="password" class="google-label">Enter your password</label>
                
                @error('password')
                    <div class="text-[12px] text-[#d93025] mt-1.5 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-8 mt-4">
                <label class="flex items-center select-none cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 border border-gray-300 rounded text-[#1a73e8] focus:ring-[#1a73e8] focus:ring-opacity-25 transition">
                    <span class="ml-2 text-sm text-[#5f6368]">Remember me</span>
                </label>
                
                <a href="#" class="text-sm font-medium text-[#1a73e8] hover:text-[#1557b0] hover:underline">Forgot password?</a>
            </div>
        </form>
    </div>

    <!-- Actions Footer -->
    <div class="flex items-center justify-between mt-6">
        <a href="{{ route('register') }}" class="google-btn-text text-sm">
            Create account
        </a>
        
        <button type="submit" form="loginForm" class="google-btn-primary text-sm shadow-sm">
            Sign in
        </button>
    </div>
</div>
@endsection
