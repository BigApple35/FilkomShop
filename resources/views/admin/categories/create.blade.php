@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container">
    <h1>Tambah Kategori Baru</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug (opsional)</label>
            <input type="text" name="slug" id="slug" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection