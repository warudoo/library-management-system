<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| CONTROLLER CATEGORY
|--------------------------------------------------------------------------
|
| CRUD sederhana untuk pengelompokan item (mis. Novel, Komik, Obat Demam).
*/
class CategoryController extends Controller
{
    // Menampilkan semua kategori, mendukung pencarian via ?search=
    public function index(Request $request)
    {
        $search = $request->search;

        $categories = Category::when($search, fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->latest()
            ->get();

        return view('categories.index', compact('categories', 'search'));
    }

    // Form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:255']);

        Category::create(['name' => $request->name]);

        return redirect()->route('categories.index')->with('success', 'Data berhasil ditambah.');
    }

    // Form edit kategori
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update kategori
    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|max:255']);

        $category->update(['name' => $request->name]);

        return redirect()->route('categories.index')->with('success', 'Data berhasil diedit.');
    }

    // Hapus kategori (item di dalamnya ikut terhapus karena cascadeOnDelete)
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
