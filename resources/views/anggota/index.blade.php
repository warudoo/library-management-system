@extends('layouts.app')


@section('title','Data Anggota')


@section('content')


<x-page-header
    title="Data Anggota"
    subtitle="Kelola anggota perpustakaan"
/>




<div class="mb-5 flex justify-end">


<a 
href="{{ route('anggota.create') }}"
class="px-5 py-3 bg-indigo-600 text-white rounded-lg">


+ Tambah Anggota


</a>


</div>





<div class="bg-white rounded-xl shadow-sm border overflow-hidden">


<div class="overflow-x-auto">


<table class="w-full text-sm">


<thead class="bg-slate-50">


<tr>


<th class="px-5 py-4 text-left">
No
</th>


<th class="px-5 py-4 text-left">
Nama
</th>


<th class="px-5 py-4 text-left">
Alamat
</th>


<th class="px-5 py-4 text-left">
Telepon
</th>


<th class="px-5 py-4 text-left">
Tanggal Lahir
</th>


<th class="px-5 py-4 text-left">
Daftar
</th>



<th class="px-5 py-4 text-center">
Aksi
</th>



</tr>


</thead>






<tbody class="divide-y">



@forelse($anggota as $a)



<tr>


<td class="px-5 py-4">

{{ $loop->iteration }}

</td>



<td class="px-5 py-4 font-semibold">

{{ $a->nama }}

</td>



<td class="px-5 py-4">

{{ $a->alamat }}

</td>




<td class="px-5 py-4">

{{ $a->no_telepon }}

</td>




<td class="px-5 py-4">

{{ 
\Carbon\Carbon::parse($a->tgl_lahir)
->format('d M Y')
}}

</td>





<td class="px-5 py-4">

{{ 
\Carbon\Carbon::parse($a->tgl_daftar)
->format('d M Y')
}}

</td>








<td class="px-5 py-4">


<div class="flex justify-center gap-2">



<a
href="{{ route('anggota.edit',$a->id) }}"
class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-xs">


Edit


</a>






<form
method="POST"
action="{{ route('anggota.destroy',$a->id) }}">


@csrf

@method('DELETE')



<button
onclick="return confirm('Hapus anggota?')"
class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs">


Hapus


</button>



</form>



</div>



</td>





</tr>






@empty



<tr>


<td colspan="7"
class="text-center py-10 text-slate-400">


Belum ada anggota.


</td>


</tr>



@endforelse




</tbody>



</table>



</div>


</div>



@endsection