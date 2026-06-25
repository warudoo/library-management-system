@extends('layouts.app')
@section('title','Data Denda')
@section('content')

<x-page-header
    title="Data Denda"
    subtitle="Kelola nominal denda keterlambatan"
/>
<div class="mb-5 flex justify-end">
    <a href="{{ route('denda.create') }}"
    class="px-5 py-3 bg-indigo-600 text-white rounded-lg">
    + Tambah Denda
    </a>
</div>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">

    <thead class="bg-slate-50">
    <tr>
    <th class="px-5 py-4 text-left">
        No
    </th>
    <th class="px-5 py-4 text-left">
        Nominal Denda
    </th>
    <th class="px-5 py-4 text-center">
        Aksi
    </th>
    </tr>
    </thead>
    <tbody>
        @forelse($denda as $row)

        <tr class="border-t">
        <td class="px-5 py-4">
        {{ $loop->iteration }}
        </td>
        <td class="px-5 py-4 font-semibold">
        Rp {{ number_format($row->nominal,0,',','.') }}

        </td>
        <td class="px-5 py-4">
            <div class="flex justify-center gap-2">
            <a href="{{ route('denda.edit',$row->id) }}"
            class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded">
            Edit
            </a>
        <form action="{{ route('denda.destroy',$row->id) }}"
        method="POST">
        @csrf
        @method('DELETE')
            <button
            onclick="return confirm('Hapus denda?')"
            class="px-3 py-1 bg-red-100 text-red-700 rounded">
            Hapus
            </button>
        </form>
    </div>
</td>
</tr>
@empty
    <tr>
    <td colspan="3"
    class="text-center py-8 text-slate-400">
    Belum ada data denda.
    </td>
</tr>
@endforelse
</tbody>
</table>
</div>

@endsection