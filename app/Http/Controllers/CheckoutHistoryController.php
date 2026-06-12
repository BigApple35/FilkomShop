<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutHistoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:5',
        ]);

        $user = Auth::user();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $total,
            'shipping_address' => $request->shipping_address,
            'status' => 'pending',
            'ordered_at' => now(),
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'seller_id' => $item['seller_id'] ?? 1,
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'fulfillment_status' => 'pending',
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)->with('success', 'Checkout berhasil!');
    }

    // Tambahkan juga method index dan show jika belum
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest('ordered_at')->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);
        return view('orders.show', compact('order'));
    }
}