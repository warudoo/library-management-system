@props(['variant' => 'primary'])

@php
// Variasi warna tombol, dipakai konsisten di semua halaman index
$variants = [
    'primary' => 'bg-indigo-600 text-white hover:bg-indigo-500 focus:ring-indigo-500',
    'secondary' => 'bg-white text-slate-700 border border-slate-300 hover:bg-slate-50 focus:ring-indigo-500',
    'warning' => 'bg-amber-500 text-white hover:bg-amber-400 focus:ring-amber-500',
];
@endphp

<a {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-sm font-medium shadow-sm transition focus:outline-none focus:ring-2 focus:ring-offset-1 {$variants[$variant]}"]) }}>
    {{ $slot }}
</a>
