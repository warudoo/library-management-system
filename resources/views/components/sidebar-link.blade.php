@props(['active' => false, 'icon' => null])

@php
// Daftar path ikon SVG sederhana, supaya tidak perlu library icon eksternal
$icons = [
    'home' => 'M3 12l9-9 9 9M5 10v10h14V10',
    'swap' => 'M7 16V4m0 0L3 8m4-4l4 4m6 4v12m0 0l4-4m-4 4l-4-4',
    'tag' => 'M7 7h.01M7 3h5l9 9-8 8-9-9V3z',
    'box' => 'M21 8l-9-5-9 5 9 5 9-5zM3 8v8l9 5 9-5V8',
    'users' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-6 0 4 4 0 016 0z',
];
$path = $icons[$icon] ?? null;
@endphp

<a
    {{ $attributes }}
    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition
           {{ $active ? 'bg-indigo-500 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
>
    @if($path)
        <svg class="w-4.5 h-4.5 shrink-0" width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}" />
        </svg>
    @endif
    <span>{{ $slot }}</span>
</a>
