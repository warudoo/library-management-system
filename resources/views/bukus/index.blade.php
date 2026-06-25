@extends('layouts.app')


@section('title','Data Buku')


@section('content')


<x-page-header
    title="Data Buku"
    subtitle="Kelola koleksi buku perpustakaan"
/>



<div class="mb-5 flex justify-end">

    <a 
        href="{{ route('buku.create') }}"
        class="px-5 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">

        + Tambah Buku

    </a>

</div>





<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">


<div class="overflow-x-auto">


<table class="w-full text-sm">



<thead class="bg-slate-50 border-b">

<tr>


<th class="px-5 py-4 text-left">No</th>

<th class="px-5 py-4 text-left">Judul Buku</th>

<th class="px-5 py-4 text-left">Kategori</th>

<th class="px-5 py-4 text-left">Pengarang</th>

<th class="px-5 py-4 text-left">Penerbit</th>

<th class="px-5 py-4 text-left">Tahun</th>

<th class="px-5 py-4 text-left">ISBN</th>

<th class="px-5 py-4 text-left">Halaman</th>

<th class="px-5 py-4 text-left">Stok</th>

<th class="px-5 py-4 text-center">Aksi</th>


</tr>


</thead>





<tbody class="divide-y divide-slate-100">



@forelse($buku as $row)



<tr class="hover:bg-slate-50 transition">



<td class="px-5 py-4">

{{ $loop->iteration }}

</td>




<td class="px-5 py-4 font-semibold">

{{ $row->judul_buku }}

</td>





<td class="px-5 py-4">


<span class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs">


{{ $row->kategori->nama_kategori ?? '-' }}


</span>


</td>





<td class="px-5 py-4">

{{ $row->pengarang }}

</td>




<td class="px-5 py-4">

{{ $row->penerbit }}

</td>





<td class="px-5 py-4">

{{ $row->tahun }}

</td>




<td class="px-5 py-4">

{{ $row->isbn }}

</td>




<td class="px-5 py-4">

{{ $row->jml_halaman }} Hal

</td>







{{-- STOK --}}
<td class="px-5 py-4">


@if($row->stok > 0)



<span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">


{{ $row->stok }} tersedia


</span>




@else




<span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">


Habis


</span>



@endif


</td>








{{-- AKSI --}}
<td class="px-5 py-4">


<div class="flex justify-center gap-2">



<a 
href="{{ route('buku.edit',$row->id) }}"
class="px-3 py-1 rounded-lg bg-yellow-100 text-yellow-700 text-xs">


Edit


</a>






<form 
method="POST"
action="{{ route('buku.destroy',$row->id) }}">


@csrf

@method('DELETE')



<button
onclick="return confirm('Hapus buku ini?')"
class="px-3 py-1 rounded-lg bg-red-100 text-red-700 text-xs">


Hapus


</button>




</form>



</div>



</td>





</tr>






@empty




<tr>


<td colspan="10"
class="px-5 py-10 text-center text-slate-400">


Belum ada data buku.


</td>


</tr>




@endforelse




</tbody>



</table>



</div>



</div>




@endsection