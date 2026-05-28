@extends('layouts.app')

@section('title', 'Daftar Item')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Item</h1>
    <a href="{{ route('items.create') }}" class="btn btn-primary">+ Tambah Item</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->category->name ?? '-' }}</td>
            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            <td>{{ $item->stock }}</td>
            <td>
                <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-info">Detail</a>
                <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus item ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data item.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection