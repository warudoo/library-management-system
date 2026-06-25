@extends('layouts.app')


@section('title','Edit Buku')


@section('content')


<x-page-header
    title="Edit Buku"
    subtitle="Perbarui data koleksi buku"
/>


<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">


<form 
action="{{ route('buku.update',$buku->id) }}" 
method="POST">


@csrf

@method('PUT')



<div class="grid grid-cols-1 md:grid-cols-2 gap-4">



{{-- Judul --}}
<div>

<label class="text-sm font-medium">
Judul Buku
</label>


<input
type="text"
name="judul_buku"
value="{{ old('judul_buku',$buku->judul_buku) }}"
class="w-full rounded-lg border-slate-300">

</div>





{{-- kategori --}}
<div>


<label class="text-sm font-medium">
Kategori
</label>



<select
name="kategori_buku_id"
class="w-full rounded-lg border-slate-300">



@foreach($kategori as $k)


<option 
value="{{ $k->id }}"
{{ $buku->kategori_buku_id == $k->id ? 'selected' : '' }}>


{{ $k->nama_kategori }}


</option>



@endforeach


</select>



</div>






{{-- Pengarang --}}
<div>


<label class="text-sm font-medium">

Pengarang

</label>


<input
type="text"
name="pengarang"
value="{{ old('pengarang',$buku->pengarang) }}"
class="w-full rounded-lg border-slate-300">


</div>







{{-- Penerbit --}}
<div>


<label class="text-sm font-medium">

Penerbit

</label>


<input
type="text"
name="penerbit"
value="{{ old('penerbit',$buku->penerbit) }}"
class="w-full rounded-lg border-slate-300">


</div>







{{-- Tahun --}}
<div>


<label class="text-sm font-medium">

Tahun Terbit

</label>



<input
type="number"
min="1901"
max="2155"
name="tahun"
value="{{ old('tahun',$buku->tahun) }}"
class="w-full rounded-lg border-slate-300">


</div>







{{-- ISBN --}}
<div>


<label class="text-sm font-medium">

ISBN

</label>



<input
type="text"
name="isbn"
value="{{ old('isbn',$buku->isbn) }}"
class="w-full rounded-lg border-slate-300">


</div>






{{-- tanggal --}}
<div>


<label class="text-sm font-medium">

Tanggal Input

</label>



<input
type="date"
name="tgl_input"
value="{{ old('tgl_input',$buku->tgl_input) }}"
class="w-full rounded-lg border-slate-300">


</div>






{{-- halaman --}}
<div>


<label class="text-sm font-medium">

Jumlah Halaman

</label>


<input
type="number"
name="jml_halaman"
value="{{ old('jml_halaman',$buku->jml_halaman) }}"
class="w-full rounded-lg border-slate-300">


</div>

<div>


<label class="text-sm font-medium">

Stok Buku

</label>


<input
type="number"
name="stok"
value="{{ old('stok',$buku->stok) }}"
class="w-full rounded-lg border-slate-300">


</div>

</div>






<div class="mt-6 flex gap-2">



<a
href="{{ route('buku.index') }}"
class="px-4 py-2 bg-slate-200 rounded-lg">

Kembali

</a>




<button
class="px-4 py-2 bg-indigo-600 text-white rounded-lg">

Update Buku

</button>



</div>



</form>


</div>



@endsection
