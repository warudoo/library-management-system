@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')

    <x-page-header title="Edit Item" subtitle="Perbarui detail item: {{ $item->name }}" />

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="category_id" value="Kategori" />
                <x-select id="category_id" name="category_id" class="mt-1">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $item->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="name" value="Nama Item" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $item->name) }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="description" value="Deskripsi" />
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $item->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-1" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="stock" value="Stock" />
                    <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full" value="{{ old('stock', $item->stock) }}" />
                    <x-input-error :messages="$errors->get('stock')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="price" value="Harga (Rp)" />
                    <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" value="{{ old('price', $item->price) }}" />
                    <x-input-error :messages="$errors->get('price')" class="mt-1" />
                </div>
            </div>

            <div>
                <x-input-label for="image" value="Gambar" />

                @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" class="w-20 h-20 object-cover rounded-lg border border-slate-200 mt-2 mb-2">
                @endif

                <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-slate-500">
                <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
                <x-input-error :messages="$errors->get('image')" class="mt-1" />
            </div>

            <div class="flex items-center gap-3 pt-2">
                <x-primary-button>Update</x-primary-button>
                <x-link-button href="{{ route('items.index') }}" variant="secondary">Batal</x-link-button>
            </div>
        </form>
    </div>

@endsection
