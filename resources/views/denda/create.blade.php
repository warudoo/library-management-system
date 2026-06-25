@extends('layouts.app')


@section('title','Tambah Denda')


@section('content')


<x-page-header
title="Tambah Denda"
/>



<div class="bg-white rounded-xl p-6 border">


<form action="{{ route('denda.store') }}"
method="POST">


@csrf




<label>

Nominal Denda

</label>



<input
type="number"
name="nominal"
placeholder="Contoh: 5000"
class="w-full rounded-lg border-slate-300">





<div class="mt-5 flex gap-2">


<a href="{{ route('denda.index') }}"
class="px-4 py-2 bg-slate-200 rounded">

Kembali

</a>



<button
class="px-4 py-2 bg-indigo-600 text-white rounded">


Simpan


</button>


</div>



</form>



</div>




@endsection