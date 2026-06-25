@extends('layouts.app')


@section('title','Tambah Peminjaman')


@section('content')


<x-page-header
    title="Tambah Peminjaman"
    subtitle="Input transaksi peminjaman buku"
/>



<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">


<form 
action="{{ route('peminjaman.store') }}"
method="POST">


@csrf



<div class="grid grid-cols-1 md:grid-cols-2 gap-5">



{{-- ANGGOTA --}}
<div>


<label class="block text-sm font-medium mb-2">

Anggota

</label>



<select 
name="anggota_id"
class="w-full rounded-lg border-slate-300">


<option value="">

-- Pilih Anggota --

</option>



@foreach($anggota as $a)


<option value="{{ $a->id }}">

{{ $a->nama }}

</option>


@endforeach


</select>


@error('anggota_id')

<p class="text-red-500 text-sm">

{{ $message }}

</p>

@enderror


</div>









{{-- BUKU --}}
<div>


<label class="block text-sm font-medium mb-2">

Buku

</label>



<select 
name="buku_id"
class="w-full rounded-lg border-slate-300">


<option value="">

-- Pilih Buku --

</option>



@foreach($buku as $b)


<option value="{{ $b->id }}">

{{ $b->judul_buku }}

</option>


@endforeach



</select>



@error('buku_id')


<p class="text-red-500 text-sm">

{{ $message }}

</p>


@enderror



</div>









{{-- TANGGAL PINJAM --}}
<div>


<label class="block text-sm font-medium mb-2">

Tanggal Pinjam

</label>




<input
type="date"
name="tgl_pinjam"
value="{{ date('Y-m-d') }}"
class="w-full rounded-lg border-slate-300">



</div>










{{-- LAMA PINJAM --}}
<div>


<label class="block text-sm font-medium mb-2">

Lama Pinjam (Hari)

</label>




<input
type="number"
name="lama_pinjam"
placeholder="Contoh: 7"
class="w-full rounded-lg border-slate-300">



</div>





</div>








<div class="mt-6 flex gap-2">



<a 
href="{{ route('peminjaman.index') }}"
class="px-4 py-2 bg-slate-200 rounded-lg">


Kembali


</a>





<button
class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">


Simpan Peminjaman


</button>



</div>





</form>


</div>



@endsection