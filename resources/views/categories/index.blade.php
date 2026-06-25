@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')

    <x-page-header title="Data Kategori" subtitle="Kelola pengelompokan untuk item kamu.">
        <x-slot name="actions">
            <x-link-button href="{{ route('categories.create') }}" variant="primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tambah Kategori
            </x-link-button>
        </x-slot>
    </x-page-header>

    {{-- Form pencarian + reset --}}
    <form method="GET" action="{{ route('categories.index') }}" class="mb-4 flex gap-2">
        <input
            type="text"
            name="search"
            placeholder="Cari kategori..."
            value="{{ $search ?? '' }}"
            class="flex-1 max-w-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
        >
        <x-secondary-button type="submit">Cari</x-secondary-button>
        @if($search ?? false)
            <x-link-button href="{{ route('categories.index') }}" variant="secondary">Reset</x-link-button>
        @endif
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-4 py-3 font-medium">Nama Kategori</th>
                    <th class="px-4 py-3 font-medium">Jumlah Item</th>
                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($categories as $category)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $category->name }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $category->items()->count() }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('categories.edit', $category->id) }}">
                                    <x-icon-button variant="edit" />
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini? Item di dalamnya juga ikut terhapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <x-icon-button variant="delete" type="submit" />
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-10 text-center text-slate-400">
                            Belum ada kategori. Klik "Tambah Kategori" untuk mulai.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
