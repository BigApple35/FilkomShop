<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.index', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
       {
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email',
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = auth()->user();

    if ($request->hasFile('profile_photo')) {

        $photo = $request->file('profile_photo')
            ->store('profile_photos', 'public');

        $user->profile_photo = $photo;
    }

    $user->name = $request->name;
    $user->email = $request->email;

    $user->save();

    return redirect()->back()
        ->with('success', 'Profile berhasil diupdate');
 
    }
}
}