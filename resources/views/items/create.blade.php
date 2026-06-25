@extends('layouts.app')

@section('title', 'Tambah Item')

@section('content')

    <x-page-header title="Tambah Item" subtitle="Lengkapi detail item baru di bawah ini." />

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Dropdown kategori, datanya dikirim dari ItemController@create --}}
            <div>
                <x-input-label for="category_id" value="Kategori" />
                <x-select id="category_id" name="category_id" class="mt-1">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="name" value="Nama Item" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="Contoh: Laravel Dasar" value="{{ old('name') }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="description" value="Deskripsi" />
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="stock" value="Stock" />
                    <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" value="{{ old('stock') }}" />
                    <x-input-error :messages="$errors->get('stock')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="price" value="Harga (Rp)" />
                    <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" value="{{ old('price') }}" />
                    <x-input-error :messages="$errors->get('price')" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="image" value="Gambar (opsional)" />
                <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-slate-500">
                <x-input-error :messages="$errors->get('image')" class="mt-1" />
            </div>

            <div class="flex items-center gap-3 pt-2">
                <x-primary-button>Simpan</x-primary-button>
                <x-link-button href="{{ route('items.index') }}" variant="secondary">Batal</x-link-button>
            </div>
        </form>
    </div>

@endsection
