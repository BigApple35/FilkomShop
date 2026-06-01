@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shopping Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <table class="table">
            <thead>
                <tr><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @forelse(session('cart', []) as $id => $item)
                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="4">Keranjang kosong. <a href="/">Belanja sekarang</a></td></tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr><th colspan="3">Total</th><th>Rp {{ number_format($total, 0, ',', '.') }}</th></tr>
            </tfoot>
        </table>

        <input type="hidden" name="total_amount" value="{{ $total }}">

        <div class="mb-3">
            <label for="shipping_address" class="form-label">Alamat Pengiriman</label>
            <textarea name="shipping_address" id="shipping_address" class="form-control" rows="2" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Proceed to Checkout</button>
    </form>
</div>
@endsection