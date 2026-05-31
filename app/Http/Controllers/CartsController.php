<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Cart_Items;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cart = Carts::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $items = $cart->items()->with('product')->get();

        return view('welcome', [
            'page' => 'cart',
            'cart' => $cart,
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used — cart is managed via store/update/destroy
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $product = Products::find($request->product_id);

        if (!$product || !$product->is_active) {
            return back()->with('error', 'Product not available');
        }

        $quantity = $request->quantity ?? 1;

        if ($quantity > $product->stock) {
            $quantity = $product->stock;
        }

        $cart = Carts::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $existing = $cart->items()->where('product_id', $product->id)->first();

        if ($existing) {
            $newQty = $existing->quantity + $quantity;
            $existing->quantity = min($newQty, $product->stock);
            $existing->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart');
    }

    public function checkout()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cart = Carts::firstOrCreate(['user_id' => $user->id]);
        $items = $cart->items()->with('product')->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $messages = [];
        $processed = false;

        DB::transaction(function () use ($items, $cart, &$messages, &$processed) {
            foreach ($items as $item) {
                $product = $item->product;
                $productName = $product?->name ?? 'Unknown product';

                if (!$product || !$product->is_active) {
                    $messages[] = "Product '{$productName}' is no longer available and was removed from your cart.";
                    $item->delete();
                    continue;
                }

                if ($product->stock <= 0) {
                    $messages[] = "Product '{$product->name}' is out of stock and was removed from your cart.";
                    $item->delete();
                    continue;
                }

                $purchaseQty = min($item->quantity, $product->stock);
                $product->stock -= $purchaseQty;
                $product->save();
                $item->delete();
                $processed = true;

                if ($purchaseQty < $item->quantity) {
                    $messages[] = "Product '{$product->name}' quantity reduced to {$purchaseQty} due to available stock.";
                }
            }
        });

        if (!$processed) {
            return redirect()->route('cart.index')->with('error', implode(' ', $messages));
        }

        $success = 'Checkout completed successfully. Stock has been updated.';
        if (!empty($messages)) {
            $success .= ' ' . implode(' ', $messages);
        }

        return redirect()->route('cart.index')->with('success', $success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Carts $carts)
    {
        // Not used — index displays the logged-in user's cart
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carts $carts)
    {
        // Not used
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $item = Cart_Items::find($cartItemId);

        if (!$item) {
            return back()->with('error', 'Cart item not found');
        }

        // Ensure item belongs to user's cart
        if ($item->cart->user_id !== $user->id) {
            return back()->with('error', 'Not authorized');
        }

        $product = $item->product;

        $qty = $request->quantity;

        if ($qty > $product->stock) {
            $qty = $product->stock;
        }

        $item->quantity = $qty;
        $item->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cartItemId)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $item = Cart_Items::find($cartItemId);

        if (!$item) {
            return back()->with('error', 'Cart item not found');
        }

        if ($item->cart->user_id !== $user->id) {
            return back()->with('error', 'Not authorized');
        }

        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
}
