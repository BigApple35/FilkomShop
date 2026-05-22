<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email'
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('profile.index');
    }
}