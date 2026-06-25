@extends('layouts.app')


@section('content')


<x-page-header
title="Tambah Kategori"
/>


<form 
action="{{ route('kategori-buku.store') }}"
method="POST">


@csrf


<input 
name="nama_kategori"
class="border rounded p-2 w-full"
placeholder="Nama kategori">



<button
class="mt-3 bg-indigo-600 text-white px-4 py-2 rounded">

Simpan

</button>



</form>


@endsection