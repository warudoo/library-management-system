@props(['type' => 'success'])

@php
// Styling berbeda untuk tiap jenis notifikasi
$styles = [
    'success' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    'error' => 'bg-red-50 text-red-700 border-red-200',
];
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition
    class="mb-4 flex items-start justify-between gap-3 rounded-lg border px-4 py-3 text-sm {{ $styles[$type] ?? $styles['success'] }}"
>
    <span>{{ $slot }}</span>

    {{-- Tombol tutup notifikasi --}}
    <button @click="show = false" class="shrink-0 opacity-60 hover:opacity-100">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
