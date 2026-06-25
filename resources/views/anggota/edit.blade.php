@extends('layouts.app')


@section('title','Edit Anggota')


@section('content')


<x-page-header
    title="Edit Anggota"
    subtitle="Update data anggota perpustakaan"
/>



<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">


<form
method="POST"
action="{{ route('anggota.update',$anggota->id) }}">


@csrf

@method('PUT')




<div class="grid grid-cols-1 md:grid-cols-2 gap-5">





<div>


<label class="block mb-2 text-sm font-medium">
Nama Anggota
</label>


<input
type="text"
name="nama"
value="{{ old('nama',$anggota->nama) }}"
class="w-full rounded-lg border-slate-300">


</div>









<div>


<label class="block mb-2 text-sm font-medium">
No Telepon
</label>



<input
type="text"
name="no_telepon"
value="{{ old('no_telepon',$anggota->no_telepon) }}"
class="w-full rounded-lg border-slate-300">


</div>









<div>


<label class="block mb-2 text-sm font-medium">
Tanggal Lahir
</label>



<input
type="date"
name="tgl_lahir"
value="{{ old('tgl_lahir',$anggota->tgl_lahir) }}"
class="w-full rounded-lg border-slate-300">


</div>










<div>


<label class="block mb-2 text-sm font-medium">
Tanggal Daftar
</label>



<input
type="date"
name="tgl_daftar"
value="{{ old('tgl_daftar',$anggota->tgl_daftar) }}"
class="w-full rounded-lg border-slate-300">


</div>









<div class="md:col-span-2">


<label class="block mb-2 text-sm font-medium">
Alamat
</label>



<textarea
name="alamat"
rows="4"
class="w-full rounded-lg border-slate-300">{{ old('alamat',$anggota->alamat) }}</textarea>



</div>






</div>








<div class="mt-6 flex gap-2">


<a
href="{{ route('anggota.index') }}"
class="px-4 py-2 bg-slate-200 rounded-lg">

Kembali

</a>




<button
class="px-4 py-2 bg-indigo-600 text-white rounded-lg">


Update


</button>




</div>






</form>



</div>




@endsection