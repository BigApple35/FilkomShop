<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display profile page.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.index', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update user profile.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'string', 'email'],
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Profile berhasil diupdate');
    }
}