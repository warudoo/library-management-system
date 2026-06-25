@extends('layouts.app')


@section('title','Tambah Buku')


@section('content')


<x-page-header
    title="Tambah Buku"
    subtitle="Masukkan data koleksi buku baru"
/>


<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">


<form action="{{ route('buku.store') }}" method="POST">

@csrf


<div class="grid grid-cols-1 md:grid-cols-2 gap-4">


<div>

<label>Judul Buku</label>

<input
type="text"
name="judul_buku"
class="w-full rounded-lg border-slate-300"
value="{{ old('judul_buku') }}">

</div>



<div>

<label>Kategori</label>

<select
name="kategori_buku_id"
class="w-full rounded-lg border-slate-300">


<option value="">
-- Pilih Kategori --
</option>


@foreach($kategori as $k)

<option value="{{ $k->id }}">

{{ $k->nama_kategori }}

</option>

@endforeach


</select>


</div>





<div>

<label>Pengarang</label>

<input
type="text"
name="pengarang"
class="w-full rounded-lg border-slate-300">

</div>





<div>

<label>Penerbit</label>

<input
type="text"
name="penerbit"
class="w-full rounded-lg border-slate-300">

</div>






<div>

<label>Tahun</label>

<input
type="number"
name="tahun"
min="1901"
max="2155"
placeholder="Contoh: 2026"
class="w-full rounded-lg border-slate-300">

</div>






<div>

<label>ISBN</label>

<input
type="text"
name="isbn"
class="w-full rounded-lg border-slate-300">

</div>






<div>

<label>Tanggal Input</label>

<input
type="date"
name="tgl_input"
value="{{ date('Y-m-d') }}"
class="w-full rounded-lg border-slate-300">

</div>






<div>

<label>Jumlah Halaman</label>

<input
type="number"
name="jml_halaman"
class="w-full rounded-lg border-slate-300">

</div>

<div>

<label>
Stok Buku
</label>


<input
type="number"
name="stok"
value="1"
min="0"
class="w-full rounded-lg border-slate-300">


</div>


</div>





<div class="mt-5 flex gap-2">


<a
href="{{ route('buku.index') }}"
class="px-4 py-2 bg-slate-200 rounded-lg">

Kembali

</a>



<button
class="px-4 py-2 bg-indigo-600 text-white rounded-lg">


Simpan Buku


</button>



</div>



</form>



</div>


@endsection