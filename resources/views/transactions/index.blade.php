@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')

    <x-page-header
        title="Transaksi"
        subtitle="{{ auth()->user()->isAdmin() ? 'Semua riwayat peminjaman & penjualan item.' : 'Riwayat peminjaman & pembelian kamu.' }}"
    >
        <x-slot name="actions">
            <x-link-button href="{{ route('transactions.create') }}" variant="primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Transaksi Baru
            </x-link-button>
        </x-slot>
    </x-page-header>

    {{-- Filter status & tipe --}}
    <form method="GET" action="{{ route('transactions.index') }}" class="mb-4 flex flex-wrap gap-2">
        <x-select name="status" class="w-auto" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            @foreach(['pending', 'active', 'returned', 'completed', 'cancelled'] as $status)
                <option value="{{ $status }}" @selected(request('status') == $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </x-select>

        <x-select name="type" class="w-auto" onchange="this.form.submit()">
            <option value="">Semua Tipe</option>
            <option value="borrow" @selected(request('type') == 'borrow')>Pinjam</option>
            <option value="sale" @selected(request('type') == 'sale')>Jual/Beli</option>
        </x-select>

        @if(request('status') || request('type'))
            <x-link-button href="{{ route('transactions.index') }}" variant="secondary">Reset Filter</x-link-button>
        @endif
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 text-left">
                    <tr>
                        <th class="px-4 py-3 font-medium">Item</th>
                        @if(auth()->user()->isAdmin())
                            <th class="px-4 py-3 font-medium">Atas Nama</th>
                        @endif
                        <th class="px-4 py-3 font-medium">Tipe</th>
                        <th class="px-4 py-3 font-medium">Qty</th>
                        <th class="px-4 py-3 font-medium">Total</th>
                        <th class="px-4 py-3 font-medium">Jatuh Tempo</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($transactions as $trx)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $trx->item->name ?? 'Item dihapus' }}</td>

                            @if(auth()->user()->isAdmin())
                                <td class="px-4 py-3 text-slate-500">{{ $trx->user->name ?? '-' }}</td>
                            @endif

                            <td class="px-4 py-3 text-slate-500">
                                {{ $trx->type === 'borrow' ? 'Pinjam' : 'Jual/Beli' }}
                            </td>
                            <td class="px-4 py-3 text-slate-500">{{ $trx->quantity }}</td>
                            <td class="px-4 py-3 text-slate-500">Rp {{ number_format($trx->total_price) }}</td>
                            <td class="px-4 py-3">
                                @if($trx->due_date)
                                    <span class="{{ $trx->isOverdue() ? 'text-red-600 font-medium' : 'text-slate-500' }}">
                                        {{ $trx->due_date->format('d M Y') }}
                                        @if($trx->isOverdue()) (Telat) @endif
                                    </span>
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <x-badge :color="$trx->statusColor()">{{ ucfirst($trx->status) }}</x-badge>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- Tombol "Kembalikan" hanya muncul untuk peminjaman yang masih aktif --}}
                                    @if($trx->isBorrow() && $trx->status === 'active')
                                        <form action="{{ route('transactions.updateStatus', $trx->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="returned">
                                            <button type="submit" class="text-xs font-medium px-2.5 py-1.5 rounded-md bg-emerald-600 text-white hover:bg-emerald-500 transition">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Admin bisa membatalkan transaksi yang masih pending/active --}}
                                    @if(auth()->user()->isAdmin() && in_array($trx->status, ['pending', 'active']))
                                        <form action="{{ route('transactions.updateStatus', $trx->id) }}" method="POST" onsubmit="return confirm('Batalkan transaksi ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="text-xs font-medium px-2.5 py-1.5 rounded-md bg-white border border-red-300 text-red-600 hover:bg-red-50 transition">
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-10 text-center text-slate-400">
                                Belum ada transaksi. Klik "Transaksi Baru" untuk mulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
