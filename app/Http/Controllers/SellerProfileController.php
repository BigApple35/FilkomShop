<?php

namespace App\Http\Controllers;

use App\Models\SellerProfile;
use Illuminate\Http\Request;

class SellerProfileController extends Controller
{
    public function index()
    {
        $stores = SellerProfile::latest()->get();
        return view('store.index', compact('stores'));
    }

    public function show($id)
    {
        $store = SellerProfile::findOrFail($id);
        return view('store.show', compact('store'));
    }
}
