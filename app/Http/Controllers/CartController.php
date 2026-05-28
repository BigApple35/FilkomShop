<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Cart_Items;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Carts::where('user_id', Auth::id())->first();

        $items = [];

        if ($cart) {
            $items = Cart_Items::with('product')
                ->where('cart_id', $cart->id)
                ->get();
        }

        return view('storefront.cart', compact('items'));
    }

    public function add($productId)
    {
        $cart = Carts::firstOrCreate([
            'user_id' => Auth::id()
        ]);

        $item = Cart_Items::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($item) {

            $item->increment('quantity');

        } else {

            Cart_Items::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1
            ]);

        }

        return redirect('/cart');
    }

    public function delete($id)
    {
        Cart_Items::findOrFail($id)->delete();

        return redirect('/cart');
    }
}
