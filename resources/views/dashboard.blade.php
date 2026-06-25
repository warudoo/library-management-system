@extends('layouts.app')


@section('title','Dashboard')


@section('content')


<x-page-header
    title="Selamat datang, {{ auth()->user()->name }} 👋"
    subtitle="Ringkasan sistem manajemen perpustakaan"
/>





{{-- ===============================
    STATISTIK UTAMA
================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">



    <x-stat-card 
        label="Total Anggota"
        :value="$totalAnggota"
        icon="users"
        accent="border-indigo-500"
    />




    <x-stat-card 
        label="Total Buku"
        :value="$totalBuku"
        icon="box"
        accent="border-blue-500"
    />





    <x-stat-card 
        label="Kategori Buku"
        :value="$totalKategori"
        icon="tag"
        accent="border-purple-500"
    />





    <x-stat-card 
        label="Sedang Dipinjam"
        :value="$totalAktif"
        icon="clock"
        accent="border-yellow-500"
    />



</div>







{{-- ===============================
    BARIS KEDUA
================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">




<div class="bg-white rounded-xl shadow-sm border-l-4 border-green-500 p-5">


<p class="text-sm text-slate-500">

Total Transaksi

</p>



<h2 class="text-3xl font-bold mt-2">

{{ $totalPinjam }}

</h2>



</div>








<div class="bg-white rounded-xl shadow-sm border-l-4 border-red-500 p-5">


<p class="text-sm text-slate-500">

Terlambat

</p>



<h2 class="text-3xl font-bold mt-2">

{{ $totalTerlambat }}

</h2>



</div>









<div class="bg-white rounded-xl shadow-sm border-l-4 border-emerald-500 p-5">


<p class="text-sm text-slate-500">

Total Denda

</p>




<h2 class="text-3xl font-bold mt-2">


Rp {{ number_format(
    $totalDenda,
    0,
    ',',
    '.'
) }}


</h2>



</div>





</div>










{{-- ===============================
    AKTIVITAS TERBARU
================================ --}}

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">



<div class="px-5 py-4 border-b flex justify-between">


<h3 class="font-semibold">

Peminjaman Terbaru

</h3>



<a 
href="{{ route('peminjaman.index') }}"
class="text-sm text-indigo-600 hover:underline">


Lihat semua


</a>



</div>







@if($recentTransactions->isEmpty())



<p class="px-5 py-8 text-center text-slate-400">


Belum ada transaksi.


</p>




@else





<div class="divide-y divide-slate-100">



@foreach($recentTransactions as $trx)




<div class="px-5 py-4 flex justify-between items-center">






<div>




<p class="font-medium text-slate-700">


{{ $trx->anggota->nama ?? '-' }}



</p>






<p class="text-sm text-slate-400">



@foreach($trx->detail as $d)


{{ $d->buku->judul_buku ?? '-' }}


@endforeach


•
{{ 
\Carbon\Carbon::parse($trx->tgl_pinjam)
->format('d M Y')
}}



</p>





</div>








@if($trx->detail->first()->tgl_kembali)



<span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">

Selesai

</span>




@else




<span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs">


Dipinjam


</span>




@endif









</div>





@endforeach




</div>




@endif






</div>







@endsection