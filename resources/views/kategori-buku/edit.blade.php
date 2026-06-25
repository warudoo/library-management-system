@extends('layouts.app')


@section('content')


<x-page-header
title="Edit Kategori"
/>


<form 
method="POST"
action="{{ route('kategori-buku.update',$kategori_buku->id) }}">


@csrf

@method('PUT')


<input 
name="nama_kategori"
value="{{ $kategori_buku->nama_kategori }}"
class="border rounded p-2 w-full">



<button
class="mt-3 bg-indigo-600 text-white px-4 py-2 rounded">

Update

</button>



</form>


@endsection