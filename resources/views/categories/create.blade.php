@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

    <x-page-header title="Tambah Kategori" subtitle="Buat pengelompokan baru untuk item." />

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-md">
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="name" value="Nama Kategori" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="Contoh: Novel" value="{{ old('name') }}" autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div class="flex items-center gap-3 pt-2">
                <x-primary-button>Simpan</x-primary-button>
                <x-link-button href="{{ route('categories.index') }}" variant="secondary">Batal</x-link-button>
            </div>
        </form>
    </div>

@endsection
