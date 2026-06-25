@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

    <x-page-header title="Detail Transaksi" subtitle="Transaksi #{{ $transaction->id }}" />

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-xl space-y-4">

        <div class="flex items-center justify-between">
            <span class="text-sm text-slate-500">Status</span>
            <x-badge :color="$transaction->statusColor()">{{ ucfirst($transaction->status) }}</x-badge>
        </div>

        <div class="flex items-center justify-between border-t border-slate-100 pt-4">
            <span class="text-sm text-slate-500">Item</span>
            <span class="text-sm font-medium text-slate-700">{{ $transaction->item->name ?? 'Item dihapus' }}</span>
        </div>

        <div class="flex items-center justify-between">
            <span class="text-sm text-slate-500">Tipe</span>
            <span class="text-sm font-medium text-slate-700">{{ $transaction->type === 'borrow' ? 'Pinjam' : 'Jual/Beli' }}</span>
        </div>

        <div class="flex items-center justify-between">
            <span class="text-sm text-slate-500">Jumlah</span>
            <span class="text-sm font-medium text-slate-700">{{ $transaction->quantity }}</span>
        </div>

        <div class="flex items-center justify-between">
            <span class="text-sm text-slate-500">Total</span>
            <span class="text-sm font-medium text-slate-700">Rp {{ number_format($transaction->total_price) }}</span>
        </div>

        <div class="flex items-center justify-between">
            <span class="text-sm text-slate-500">Tanggal Transaksi</span>
            <span class="text-sm font-medium text-slate-700">{{ $transaction->transaction_date->format('d M Y') }}</span>
        </div>

        @if($transaction->due_date)
            <div class="flex items-center justify-between">
                <span class="text-sm text-slate-500">Jatuh Tempo</span>
                <span class="text-sm font-medium {{ $transaction->isOverdue() ? 'text-red-600' : 'text-slate-700' }}">
                    {{ $transaction->due_date->format('d M Y') }}
                </span>
            </div>
        @endif

        @if($transaction->notes)
            <div class="border-t border-slate-100 pt-4">
                <span class="text-sm text-slate-500 block mb-1">Catatan</span>
                <p class="text-sm text-slate-700">{{ $transaction->notes }}</p>
            </div>
        @endif

        <div class="pt-2">
            <x-link-button href="{{ route('transactions.index') }}" variant="secondary">Kembali ke Daftar</x-link-button>
        </div>
    </div>

@endsection
