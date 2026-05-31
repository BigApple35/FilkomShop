<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Menampilkan daftar item
    public function index()
    {
        $items = Item::with('category')->latest()->get();
        return view('items.index', compact('items'));
    }

    // Form tambah item
    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    // Simpan item baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Item::create($validated);

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil ditambahkan.');
    }

    // Detail item
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    // Form edit item
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    // Update item
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name'        => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil diperbarui.');
    }

    // Hapus item
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')
                         ->with('success', 'Item berhasil dihapus.');
    }
}