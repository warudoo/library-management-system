@extends('layouts.app')

@section('title', 'Data Item')

@section('content')

    <x-page-header title="Data Item" subtitle="Kelola seluruh item/barang yang tersedia.">
        <x-slot name="actions">
            <x-link-button href="{{ route('items.create') }}" variant="primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tambah Item
            </x-link-button>
        </x-slot>
    </x-page-header>

    {{-- Form pencarian --}}
    <form method="GET" action="{{ route('items.index') }}" class="mb-4 flex gap-2">
        <input
            type="text"
            name="search"
            placeholder="Cari nama item..."
            value="{{ $search ?? '' }}"
            class="flex-1 max-w-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
        >
        <x-secondary-button type="submit">Cari</x-secondary-button>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 text-left">
                    <tr>
                        <th class="px-4 py-3 font-medium">Gambar</th>
                        <th class="px-4 py-3 font-medium">Nama</th>
                        <th class="px-4 py-3 font-medium">Kategori</th>
                        <th class="px-4 py-3 font-medium">Stock</th>
                        <th class="px-4 py-3 font-medium">Harga</th>
                        <th class="px-4 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($items as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3">
                                @if($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}" class="w-12 h-12 object-cover rounded-lg border border-slate-200">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-300 text-xs">N/A</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $item->name }}</td>
                            <td class="px-4 py-3 text-slate-500">{{ $item->category->name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <x-badge :color="$item->stock > 0 ? 'bg-emerald-100 text-emerald-700 ring-emerald-600/20' : 'bg-red-100 text-red-700 ring-red-600/20'">
                                    {{ $item->stock }}
                                </x-badge>
                            </td>
                            <td class="px-4 py-3 text-slate-600">Rp {{ number_format($item->price) }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('items.edit', $item->id) }}">
                                        <x-icon-button variant="edit" />
                                    </a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-icon-button variant="delete" type="submit" />
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-slate-400">
                                Belum ada data item. Klik "Tambah Item" untuk mulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
