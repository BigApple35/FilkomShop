@extends('auth.layout')

@section('title', 'Create your Filkom Shop Account')

@section('content')
<div class="google-card w-full max-w-[780px] p-6 md:p-10 flex flex-col justify-between min-h-[580px]">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
        
        <!-- Left Side: Registration Form (7 columns on desktop) -->
        <div class="md:col-span-7">
            <!-- Branding -->
            <div class="mb-6">
                <span class="text-2xl font-bold tracking-tight select-none">
                    <span class="text-[#4285F4]">F</span><span class="text-[#EA4335]">i</span><span class="text-[#FBBC05]">l</span><span class="text-[#34A853]">k</span><span class="text-[#4285F4]">o</span><span class="text-[#EA4335]">m</span><span class="ml-[2px]" style="color:#4285F4">S</span><span style="color:#EA4335">h</span><span style="color:#FBBC05">o</span><span style="color:#34A853">p</span>
                </span>
                
                <h1 class="text-xl font-normal text-[#202124] mt-2">Create your Filkom Shop Account</h1>
                <p class="text-sm text-[#5f6368] mt-1">Join our premium marketplace community</p>
            </div>

            <form id="registerForm" method="POST" action="{{ route('register') }}" class="mt-6">
                @csrf

                <!-- Name Input -->
                <div class="google-input-group">
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder=" " required autofocus
                        class="google-input @error('name') is-invalid @enderror" />
                    <label for="name" class="google-label">Full name</label>
                    
                    @error('name')
                        <div class="text-[12px] text-[#d93025] mt-1.5 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="google-input-group">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder=" " required
                        class="google-input @error('email') is-invalid @enderror" />
                    <label for="email" class="google-label">Email address</label>
                    <span class="text-[11px] text-[#5f6368] mt-1 block px-1">You will use this email to sign in</span>
                    
                    @error('email')
                        <div class="text-[12px] text-[#d93025] mt-1.5 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Passwords Grid (Two columns on desktop) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Password Input -->
                    <div class="google-input-group">
                        <input type="password" id="password" name="password" placeholder=" " required
                            class="google-input @error('password') is-invalid @enderror" />
                        <label for="password" class="google-label">Password</label>
                    </div>

                    <!-- Password Confirmation Input -->
                    <div class="google-input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder=" " required
                            class="google-input" />
                        <label for="password_confirmation" class="google-label">Confirm password</label>
                    </div>
                </div>
                
                @error('password')
                    <div class="text-[12px] text-[#d93025] -mt-2 mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </div>
                @enderror
                
                <span class="text-[11px] text-[#5f6368] -mt-1 mb-6 block px-1">Use 8 or more characters with a mix of letters, numbers & symbols</span>

                <!-- Role Selector (Google Material Styled Segment Controller) -->
                <div class="mb-6 mt-4">
                    <span class="block text-xs font-medium text-[#5f6368] mb-2.5 uppercase tracking-wider px-1">I want to join as a:</span>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" id="btnCustomer" onclick="selectRole('customer')"
                            class="google-segment-btn active py-2.5 px-4 rounded text-sm text-center font-medium transition cursor-pointer">
                            Customer / Buyer
                        </button>
                        <button type="button" id="btnSeller" onclick="selectRole('seller')"
                            class="google-segment-btn py-2.5 px-4 rounded text-sm text-center font-medium transition cursor-pointer">
                            Seller / Store
                        </button>
                    </div>
                    <input type="hidden" name="role" id="roleVal" value="{{ old('role', 'customer') }}">
                </div>
            </form>
        </div>

        <!-- Right Side: Graphic Illustration (5 columns on desktop) -->
        <div class="hidden md:col-span-5 md:flex flex-col items-center justify-center self-center text-center px-4 mt-8">
            <!-- Modern Google-style SVG Illustration -->
            <svg class="w-40 h-40 mb-6 select-none" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Outer decorative circle -->
                <circle cx="60" cy="60" r="54" stroke="#dadce0" stroke-width="1.5" stroke-dasharray="4 4" />
                
                <!-- Colorful modern design elements -->
                <!-- Green Circle -->
                <circle cx="28" cy="40" r="10" fill="#34A853" fill-opacity="0.15" />
                <circle cx="28" cy="40" r="3" fill="#34A853" />
                
                <!-- Yellow Rectangle/Box -->
                <rect x="84" y="32" width="14" height="14" rx="3" fill="#FBBC05" fill-opacity="0.15" />
                <rect x="89" y="37" width="4" height="4" rx="1" fill="#FBBC05" />
                
                <!-- Red Triangle/Polygon -->
                <path d="M60 88L65.5 97.5H54.5L60 88Z" fill="#EA4335" />
                
                <!-- Center Shield / Safe Shopping Icon -->
                <rect x="42" y="44" width="36" height="40" rx="6" fill="#4285F4" fill-opacity="0.1" stroke="#4285F4" stroke-width="2" />
                
                <!-- Shield Checkmark -->
                <path d="M52 64.5L57 69.5L68 58.5" stroke="#4285F4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                
                <!-- Floating Mini Cart Representation -->
                <rect x="74" y="68" width="18" height="14" rx="3" fill="#34A853" />
                <path d="M78 72H88" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" />
                <path d="M80 75H86" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" />
            </svg>
            
            <p class="text-sm font-medium text-[#202124]">One account. All of Filkom Shop working for you.</p>
            <p class="text-xs text-[#5f6368] mt-2 max-w-[200px]">Access premium sellers, secure checkout, and easy order tracking with a single login.</p>
        </div>
        
    </div>

    <!-- Actions Footer -->
    <div class="flex items-center justify-between mt-8 border-t border-gray-100 pt-6">
        <a href="{{ route('login') }}" class="google-btn-text text-sm">
            Sign in instead
        </a>
        
        <button type="submit" form="registerForm" class="google-btn-primary text-sm shadow-sm">
            Register
        </button>
    </div>
</div>

<!-- Inline Javascript for Google Role Selection -->
<script>
    function selectRole(role) {
        document.getElementById('roleVal').value = role;
        
        const btnCustomer = document.getElementById('btnCustomer');
        const btnSeller = document.getElementById('btnSeller');
        
        if (role === 'customer') {
            btnCustomer.classList.add('active');
            btnSeller.classList.remove('active');
        } else {
            btnSeller.classList.add('active');
            btnCustomer.classList.remove('active');
        }
    }
    
    // Set initial state on load based on old or default value
    window.addEventListener('DOMContentLoaded', () => {
        const currentRole = document.getElementById('roleVal').value;
        selectRole(currentRole);
    });
</script>
@endsection
