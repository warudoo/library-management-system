@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

    <x-page-header title="Tambah User" subtitle="Buat akun baru beserta hak aksesnya." />

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-md">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="name" value="Nama" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email') }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="role" value="Role" />
                <x-select id="role" name="role" class="mt-1">
                    <option value="user" @selected(old('role') == 'user')>User</option>
                    <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                </x-select>
                <x-input-error :messages="$errors->get('role')" class="mt-1" />
            </div>

            <div class="flex items-center gap-3 pt-2">
                <x-primary-button>Simpan</x-primary-button>
                <x-link-button href="{{ route('users.index') }}" variant="secondary">Batal</x-link-button>
            </div>
        </form>
    </div>

@endsection
