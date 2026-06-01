<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Seller;

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {

            return redirect()->intended('/');

        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {

            $request->session()->regenerate();

            return redirect()->intended('/');

        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        if (Auth::check()) {

            return redirect()->intended('/');

        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:' . User::class,
            ],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
            'role' => [
                'required',
                'string',
                'in:customer,seller',
            ],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($user->role === 'seller') {
            Seller::create([
                'user_id' => $user->id,
                'shop_name' => $user->name,
            ]);
        }
        Auth::login($user);

        return redirect('/')
            ->with(
                'status',
                'Your account has been created successfully!'
            );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')
            ->with(
                'status',
                'You have been logged out.'
            );
    }

    // =========================
    // MANAGE USERS (ADMIN)
    // =========================

    public function manageUsers(Request $request)
    {
        if (
            !Auth::check()
            || Auth::user()->role !== 'admin'
        ) {

            return view('welcome', [
                'page' => 'access-denied',
            ]);

        }

        $users = User::query()
            ->when(
                $request->search,
                function ($query) use ($request) {

                    $query
                        ->where(
                            'name',
                            'like',
                            '%' . $request->search . '%'
                        )
                        ->orWhere(
                            'email',
                            'like',
                            '%' . $request->search . '%'
                        );

                }
            )
            ->latest()
            ->paginate(10);

        return view('welcome', [
            'page' => 'admin-users',
            'users' => $users,
        ]);
    }

    public function showUser(User $user)
    {
        if (
            !Auth::check()
            || Auth::user()->role !== 'admin'
        ) {

            return view('welcome', [
                'page' => 'access-denied',
            ]);

        }

        return view('welcome', [
            'page' => 'admin-users',
            'userDetail' => $user,
        ]);
    }

    public function deleteUser(User $user)
    {
        if (
            !Auth::check()
            || Auth::user()->role !== 'admin'
        ) {

            return view('welcome', [
                'page' => 'access-denied',
            ]);

        }

        if ($user->id === Auth::id()) {

            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'You cannot delete your own account.'
                );

        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }
}