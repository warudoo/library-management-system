<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| CONTROLLER ITEM
|--------------------------------------------------------------------------
|
| CRUD untuk data item (generic: bisa jadi Buku / Obat / Produk).
| Item selalu terhubung ke satu Category lewat category_id.
*/
class ItemController extends Controller
{
    // Menampilkan semua item, mendukung pencarian via ?search=
    public function index(Request $request)
    {
        $search = $request->search;

        $items = Item::with('category')
            ->when($search, fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->latest()
            ->get();

        return view('items.index', compact('items', 'search'));
    }

    // Form tambah item, butuh daftar kategori untuk dropdown
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('items.create', compact('categories'));
    }

    // Simpan item baru, termasuk upload gambar (opsional)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        // Simpan gambar ke storage/app/public/items jika ada upload
        $validated['image'] = $request->hasFile('image')
            ? $request->file('image')->store('items', 'public')
            : null;

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambah.');
    }

    // Form edit item, sekaligus kirim daftar kategori untuk dropdown
    public function edit(Item $item)
    {
        $categories = Category::orderBy('name')->get();

        return view('items.edit', compact('item', 'categories'));
    }

    // Update data item. Gambar lama dihapus jika ada upload gambar baru
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama supaya storage tidak menumpuk file sampah
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Item berhasil diedit.');
    }

    // Hapus item beserta file gambarnya (jika ada)
    public function destroy(Item $item)
    {
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }
}
