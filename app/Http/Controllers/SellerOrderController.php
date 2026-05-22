<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SellerOrderController extends Controller
{
    public function index()
    {
        $incomingOrders = Order::orderBy('created_at', 'desc')->get();
        return view('seller.orders.index', compact('incomingOrders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('seller.orders.show', compact('order'));
    }
}
