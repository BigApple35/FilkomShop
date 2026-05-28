@extends('layouts.app')

@section('title', 'Detail Item')

@section('content')
<h1>Detail Item</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $item->name }}</h5>
        <p class="card-text"><strong>Deskripsi:</strong> {{ $item->description ?? '-' }}</p>
        <p><strong>Kategori:</strong> {{ $item->category->name ?? '-' }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($item->price, 0, ',', '.') }}</p>
        <p><strong>Stok:</strong> {{ $item->stock }}</p>
    </div>
</div>

<a href="{{ route('items.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
<a href="{{ route('items.edit', $item) }}" class="btn btn-warning mt-3">Edit</a>

<form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus item ini?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger mt-3">Hapus</button>
</form>
@endsection