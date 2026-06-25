@props(['color' => 'bg-slate-100 text-slate-600 ring-slate-500/20'])

{{-- Badge kecil, dipakai untuk status transaksi, role user, dll --}}
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium ring-1 ring-inset {{ $color }}">
    {{ $slot }}
</span>
