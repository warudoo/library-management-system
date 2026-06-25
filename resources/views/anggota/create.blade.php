@extends('layouts.app')


@section('title','Tambah Anggota')


@section('content')


<x-page-header
    title="Tambah Anggota"
    subtitle="Daftarkan anggota perpustakaan baru"
/>



<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">


<form
method="POST"
action="{{ route('anggota.store') }}">


@csrf



<div class="grid grid-cols-1 md:grid-cols-2 gap-5">



{{-- NAMA --}}
<div>


<label class="block mb-2 text-sm font-medium">
Nama Anggota
</label>


<input
type="text"
name="nama"
value="{{ old('nama') }}"
class="w-full rounded-lg border-slate-300"
placeholder="Nama lengkap">


@error('nama')

<p class="text-red-500 text-sm">
{{ $message }}
</p>

@enderror



</div>






{{-- TELEPON --}}
<div>


<label class="block mb-2 text-sm font-medium">
No Telepon
</label>


<input
type="text"
name="no_telepon"
value="{{ old('no_telepon') }}"
class="w-full rounded-lg border-slate-300"
placeholder="08xxxx">


</div>









{{-- TGL LAHIR --}}
<div>


<label class="block mb-2 text-sm font-medium">

Tanggal Lahir

</label>



<input
type="date"
name="tgl_lahir"
class="w-full rounded-lg border-slate-300">



</div>










{{-- TGL DAFTAR --}}
<div>


<label class="block mb-2 text-sm font-medium">

Tanggal Daftar

</label>



<input
type="date"
name="tgl_daftar"
value="{{ date('Y-m-d') }}"
class="w-full rounded-lg border-slate-300">


</div>









{{-- ALAMAT --}}
<div class="md:col-span-2">


<label class="block mb-2 text-sm font-medium">

Alamat

</label>



<textarea
name="alamat"
rows="4"
class="w-full rounded-lg border-slate-300"
placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>



</div>





</div>









<div class="mt-6 flex gap-2">


<a
href="{{ route('anggota.index') }}"
class="px-4 py-2 bg-slate-200 rounded-lg">

Kembali

</a>





<button
class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">


Simpan


</button>



</div>





</form>


</div>



@endsection