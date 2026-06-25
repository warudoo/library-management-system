@props(['label', 'value', 'icon' => null, 'accent' => 'border-indigo-500'])

@php
// Sedikit ikon SVG, biar tidak perlu library icon eksternal
$icons = [
    'tag' => 'M7 7h.01M7 3h5l9 9-8 8-9-9V3z',
    'box' => 'M21 8l-9-5-9 5 9 5 9-5zM3 8v8l9 5 9-5V8',
    'layers' => 'M12 2l9 5-9 5-9-5 9-5zM3 12l9 5 9-5M3 17l9 5 9-5',
    'clock' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
    'alert' => 'M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z',
    'cart' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 4.6A1 1 0 005.6 19H17M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z',
];
$path = $icons[$icon] ?? null;
@endphp

{{-- Card statistik dashboard. Garis warna di kiri = "signature" visual yang
     berulang di tiap card, membedakan kategori data secara cepat. --}}
<div class="bg-white rounded-xl shadow-sm border-l-4 {{ $accent }} border-y border-r border-slate-200 p-5 flex items-center justify-between">
    <div>
        <p class="text-sm text-slate-500">{{ $label }}</p>
        <p class="text-2xl font-bold text-slate-800 mt-1">{{ $value }}</p>
    </div>

    @if($path)
        <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}" />
            </svg>
        </div>
    @endif
</div>
