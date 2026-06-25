@extends('layouts.app')


@section('title','Data Peminjaman')


@section('content')


<x-page-header
    title="Data Peminjaman"
    subtitle="Kelola transaksi peminjaman dan pengembalian buku"
/>



{{-- BUTTON TAMBAH --}}
<div class="mb-5 flex justify-end">


    <a
        href="{{ route('peminjaman.create') }}"
        class="inline-flex items-center px-5 py-3
        bg-indigo-600 text-white rounded-lg
        hover:bg-indigo-700 transition">


        + Tambah Peminjaman


    </a>


</div>






{{-- TABLE --}}
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">


<div class="overflow-x-auto">



<table class="w-full text-sm">





<thead class="bg-slate-50 border-b border-slate-200">


<tr>


<th class="px-5 py-4 text-left">
No
</th>



<th class="px-5 py-4 text-left">
Anggota
</th>




<th class="px-5 py-4 text-left">
Buku
</th>




<th class="px-5 py-4 text-left">
Petugas
</th>





<th class="px-5 py-4 text-left">
Tanggal Pinjam
</th>





<th class="px-5 py-4 text-left">
Lama
</th>




<th class="px-5 py-4 text-left">
Tanggal Kembali
</th>




<th class="px-5 py-4 text-left">
Denda
</th>





<th class="px-5 py-4 text-center">
Status
</th>





<th class="px-5 py-4 text-center">
Aksi
</th>




</tr>


</thead>









<tbody class="divide-y divide-slate-100">



@forelse($peminjaman as $p)



<tr class="hover:bg-slate-50 transition">






{{-- NOMOR --}}
<td class="px-5 py-4">


{{ $loop->iteration }}


</td>







{{-- ANGGOTA --}}
<td class="px-5 py-4 font-semibold text-slate-700">


{{ $p->anggota->nama ?? '-' }}


</td>







{{-- BUKU --}}
<td class="px-5 py-4">



@foreach($p->detail as $d)



<span class="inline-flex px-3 py-1 rounded-full
bg-indigo-50 text-indigo-700 text-xs">


{{ $d->buku->judul_buku ?? '-' }}


</span>



@endforeach




</td>









{{-- PETUGAS --}}
<td class="px-5 py-4">


{{ $p->user->name ?? '-' }}


</td>









{{-- TANGGAL PINJAM --}}
<td class="px-5 py-4">


{{ 
    \Carbon\Carbon::parse($p->tgl_pinjam)
    ->format('d M Y')
}}


</td>









{{-- LAMA --}}
<td class="px-5 py-4">


{{ $p->lama_pinjam }} Hari


</td>










{{-- TANGGAL KEMBALI --}}
<td class="px-5 py-4">



@if($p->detail->first()->tgl_kembali)



{{ 
    \Carbon\Carbon::parse(
        $p->detail->first()->tgl_kembali
    )->format('d M Y')
}}



@else


<span class="text-slate-400">

Belum kembali

</span>



@endif



</td>









{{-- DENDA --}}
<td class="px-5 py-4">


Rp {{ number_format(
    $p->nominal_denda,
    0,
    ',',
    '.'
) }}


</td>









{{-- STATUS --}}
<td class="px-5 py-4 text-center">



@if($p->detail->first()->tgl_kembali)



<span class="px-3 py-1 rounded-full
bg-green-100 text-green-700 text-xs">


Selesai


</span>




@else



<span class="px-3 py-1 rounded-full
bg-yellow-100 text-yellow-700 text-xs">


Dipinjam


</span>



@endif




</td>










{{-- AKSI --}}
<td class="px-5 py-4">



<div class="flex justify-center gap-2">






{{-- BUTTON KEMBALIKAN --}}
@if(!$p->detail->first()->tgl_kembali)



<form
method="POST"
action="{{ route('peminjaman.kembali',$p->id) }}">


@csrf

@method('PATCH')



<button
class="px-3 py-1 rounded-lg
bg-green-100 text-green-700
hover:bg-green-200 text-xs">


Kembalikan


</button>



</form>



@endif







{{-- DELETE --}}
<form
method="POST"
action="{{ route('peminjaman.destroy',$p->id) }}">


@csrf

@method('DELETE')



<button
onclick="return confirm('Hapus data peminjaman ini?')"
class="px-3 py-1 rounded-lg
bg-red-100 text-red-700
hover:bg-red-200 text-xs">


Hapus


</button>



</form>





</div>




</td>








</tr>







@empty




<tr>


<td
colspan="10"
class="px-5 py-10 text-center text-slate-400">


Belum ada transaksi peminjaman.


</td>



</tr>





@endforelse




</tbody>



</table>




</div>



</div>





@endsection