@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

    <x-page-header title="Edit User" subtitle="Perbarui data: {{ $user->name }}" />

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-md">
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="name" value="Nama" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name) }}" autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email) }}" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="role" value="Role" />
                <x-select id="role" name="role" class="mt-1">
                    <option value="user" @selected(old('role', $user->role) == 'user')>User</option>
                    <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                </x-select>
                <x-input-error :messages="$errors->get('role')" class="mt-1" />
            </div>

            <div class="flex items-center gap-3 pt-2">
                <x-primary-button>Update</x-primary-button>
                <x-link-button href="{{ route('users.index') }}" variant="secondary">Batal</x-link-button>
            </div>
        </form>
    </div>

@endsection
