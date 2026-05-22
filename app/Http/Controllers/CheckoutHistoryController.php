<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutHistoryController extends Controller
{
    public function index()
    {
        $histories = Order::orderBy('created_at', 'desc')->get();
        return view('buyer.history.index', compact('histories'));
    }

    public function show($id)
    {
        $history = Order::findOrFail($id);
        return view('buyer.history.show', compact('history'));
    }

    public function destroy($id)
    {
        $history = Order::findOrFail($id);
        $history->delete();

        return redirect()->route('history.index')->with('success', 'Riwayat transaksi berhasil dihapus dari daftar.');
    }
}
