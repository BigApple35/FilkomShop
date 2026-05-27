<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if (
            !Auth::check() ||
            Auth::user()->role !== 'admin'
        ) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        $products = Products::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                );
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('welcome', [
            'page' => 'admin-products',
            'products' => $products,
        ]);
    }

    public function show(Products $products)
    {
        if (
            !Auth::check() ||
            Auth::user()->role !== 'admin'
        ) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        $allProducts = Products::latest()
            ->paginate(10);

        return view('welcome', [
            'page' => 'admin-products',
            'products' => $allProducts,
            'productDetail' => $products,
        ]);
    }

    public function destroy(Products $products)
    {
        if (
            !Auth::check() ||
            Auth::user()->role !== 'admin'
        ) {
            return response()->view(
                'welcome',
                [
                    'page' => 'access-denied',
                ],
                403
            );
        }

        $products->delete();

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Product deleted successfully.'
            );
    }
}