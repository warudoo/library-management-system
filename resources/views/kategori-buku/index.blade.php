@extends('layouts.app')
@section('title','Kategori Buku')
@section('content')
<x-page-header
    title="Kategori Buku"
    subtitle="Kelola kategori koleksi buku perpustakaan"
/>
<div class="mb-5 flex justify-end">

    <a 
        href="{{ route('kategori-buku.create') }}"
        class="inline-flex items-center px-4 py-2 bg-indigo-600 
        border border-transparent rounded-lg font-semibold 
        text-xs text-white uppercase tracking-widest
        hover:bg-indigo-700 transition">
        + Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

<table class="w-full text-sm">

<thead class="bg-slate-50 border-b">
<tr>
<th class="px-5 py-3 text-left">
    No
</th>


<th class="px-5 py-3 text-left">
    Nama Kategori
</th>

<th class="px-5 py-3 text-center">
    Aksi
</th>
</tr>
</thead>
<tbody class="divide-y divide-slate-100">


@forelse($kategori as $row)


<tr>


<td class="px-5 py-3">

{{ $loop->iteration }}

</td>



<td class="px-5 py-3 font-medium">

{{ $row->nama_kategori }}

</td>




<td class="px-5 py-3 text-center">


<a 
href="{{ route('kategori-buku.edit',$row->id) }}"
class="inline-flex px-3 py-1 rounded bg-green-100 text-green-700 text-xs">

Edit

</a>




<form 
action="{{ route('kategori-buku.destroy',$row->id) }}"
method="POST"
class="inline">


@csrf

@method('DELETE')



<button
onclick="return confirm('Hapus kategori ini?')"
class="inline-flex px-3 py-1 rounded bg-red-100 text-red-700 text-xs">


Hapus


</button>


</form>



</td>


</tr>



@empty



<tr>

<td colspan="3"
class="px-5 py-8 text-center text-slate-400">

Belum ada kategori buku.

</td>

</tr>



@endforelse


</tbody>


</table>


</div>


@endsection