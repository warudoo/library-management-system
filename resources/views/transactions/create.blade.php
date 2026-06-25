@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')

    <x-page-header title="Transaksi Baru" subtitle="Catat peminjaman atau pembelian item." />

    <div
        class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-xl"
        x-data="{ type: '{{ old('type', 'borrow') }}' }"
    >
        <form action="{{ route('transactions.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Pilih tipe transaksi: menentukan apakah due_date wajib diisi --}}
            <div>
                <x-input-label value="Tipe Transaksi" />
                <div class="mt-1 grid grid-cols-2 gap-3">
                    <label class="flex items-center justify-center gap-2 border rounded-lg px-3 py-2.5 cursor-pointer transition"
                           :class="type === 'borrow' ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-slate-200 text-slate-500'">
                        <input type="radio" name="type" value="borrow" x-model="type" class="hidden">
                        Pinjam
                    </label>
                    <label class="flex items-center justify-center gap-2 border rounded-lg px-3 py-2.5 cursor-pointer transition"
                           :class="type === 'sale' ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-slate-200 text-slate-500'">
                        <input type="radio" name="type" value="sale" x-model="type" class="hidden">
                        Jual / Beli
                    </label>
                </div>
                <x-input-error :messages="$errors->get('type')" class="mt-1" />
            </div>

            {{-- Dropdown item, hanya yang stoknya > 0 (dikirim dari controller) --}}
            <div>
                <x-input-label for="item_id" value="Item" />
                <x-select id="item_id" name="item_id" class="mt-1">
                    <option value="">-- Pilih Item --</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}" @selected(old('item_id') == $item->id) data-stock="{{ $item->stock }}">
                            {{ $item->name }} (stok: {{ $item->stock }})
                        </option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('item_id')" class="mt-1" />
                @if($items->isEmpty())
                    <p class="text-xs text-amber-600 mt-1">Belum ada item dengan stok tersedia.</p>
                @endif
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="quantity" value="Jumlah" />
                    <x-text-input id="quantity" name="quantity" type="number" min="1" class="mt-1 block w-full" value="{{ old('quantity', 1) }}" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-1" />
                </div>

                <div>
                    <x-input-label for="transaction_date" value="Tanggal Transaksi" />
                    <x-text-input id="transaction_date" name="transaction_date" type="date" class="mt-1 block w-full" value="{{ old('transaction_date', now()->toDateString()) }}" />
                    <x-input-error :messages="$errors->get('transaction_date')" class="mt-1" />
                </div>
            </div>

            {{-- Hanya tampil & wajib diisi kalau tipe = pinjam --}}
            <div x-show="type === 'borrow'" x-cloak>
                <x-input-label for="due_date" value="Jatuh Tempo Pengembalian" />
                <x-text-input id="due_date" name="due_date" type="date" class="mt-1 block w-full" value="{{ old('due_date') }}" />
                <x-input-error :messages="$errors->get('due_date')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="notes" value="Catatan (opsional)" />
                <textarea id="notes" name="notes" rows="2" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes') }}</textarea>
                <x-input-error :messages="$errors->get('notes')" class="mt-1" />
            </div>

            <div class="flex items-center gap-3 pt-2">
                <x-primary-button>Simpan Transaksi</x-primary-button>
                <x-link-button href="{{ route('transactions.index') }}" variant="secondary">Batal</x-link-button>
            </div>
        </form>
    </div>

@endsection
