<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Management System')</title>

    {{-- Font Figtree, sama seperti halaman login/register --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    {{-- Font & Tailwind dimuat lewat Vite (sama seperti halaman auth Breeze) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-800">

    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">

        {{-- =====================================================
             SIDEBAR
             Menu utama navigasi. Di mobile disembunyikan, dibuka
             lewat tombol hamburger (Alpine.js, sudah dibundel Breeze).
        ====================================================== --}}
        <aside
            class="fixed inset-y-0 left-0 z-40 w-64 bg-slate-900 text-slate-200 flex flex-col
                   transform transition-transform duration-200 ease-in-out
                   lg:translate-x-0 lg:static lg:flex"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            {{-- Brand --}}
            <div class="flex items-center gap-2 px-5 h-16 border-b border-slate-800">
                <span class="text-2xl">📚</span>
                <div class="leading-tight">
                    <p class="font-semibold text-white text-sm">Perpustakaan Digital</p>
                    <p class="text-[11px] text-slate-400">Muhamad Salwarud</p>
                </div>
            </div>

            {{-- Menu --}}  
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <x-sidebar-link 
                href="/dashboard" 
                :active="request()->is('dashboard')" 
                icon="home">
                Dashboard
            </x-sidebar-link>
            <x-sidebar-link 
                href="{{ route('peminjaman.index') }}" 
                :active="request()->is('peminjaman*')" 
                icon="swap">
                Peminjaman
            </x-sidebar-link>

            @if(auth()->user()->isAdmin())
                <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-slate-500">
                    Master Data
                </p>
                <x-sidebar-link 
                href="{{ route('anggota.index') }}" 
                :active="request()->is('anggota*')" 
                icon="users">
                Anggota
                </x-sidebar-link>
                <x-sidebar-link 
                href="{{ route('kategori-buku.index') }}" 
                :active="request()->is('kategori-buku*')" 
                icon="tag">
                Kategori Buku
                </x-sidebar-link>
                <x-sidebar-link 
                href="{{ route('buku.index') }}" 
                :active="request()->is('buku*')" 
                icon="box">
                Buku
                </x-sidebar-link>
                <x-sidebar-link 
                href="{{ route('denda.index') }}" 
                :active="request()->is('denda*')" 
                icon="tag">
                Denda
                </x-sidebar-link>
                <p class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-slate-500">
                    Laporan
                </p>
                <x-sidebar-link 
                    href="{{ route('laporan.anggota') }}" 
                    :active="request()->is('laporan/anggota')" 
                    icon="users">
                    Laporan Anggota
                </x-sidebar-link>
                <x-sidebar-link 
                    href="{{ route('laporan.buku') }}" 
                    :active="request()->is('laporan/buku')" 
                    icon="box">
                    Laporan Buku
                </x-sidebar-link>
                <x-sidebar-link 
                    href="{{ route('laporan.peminjaman') }}" 
                    :active="request()->is('laporan/peminjaman')" 
                    icon="swap">
                    Laporan Peminjaman
                </x-sidebar-link>
            @endif
        </nav>

            {{-- User info + logout --}}
            <div class="border-t border-slate-800 p-3">
                <div class="flex items-center gap-2 px-2 py-2 rounded-lg bg-slate-800/60 mb-2">
                    <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-sm font-semibold uppercase">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="leading-tight overflow-hidden">
                        <p class="text-sm text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-slate-400 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-slate-800 transition">
                    Profil Saya
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-red-300 hover:bg-red-500/10 transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Overlay saat sidebar mobile terbuka --}}
        <div
            x-show="sidebarOpen"
            x-cloak
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black/40 z-30 lg:hidden"
        ></div>

        {{-- =====================================================
             KONTEN UTAMA
        ====================================================== --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Topbar (mobile: tombol buka sidebar) --}}
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-8">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-md text-slate-600 hover:bg-slate-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>

                <h1 class="font-semibold text-slate-800">
                    {{-- Kalau dipakai sebagai <x-app-layout> (lihat profile/edit), judul
                         datang dari slot "header". Kalau dipakai via @extends, pakai @yield. --}}
                    @if(isset($header))
                        {{ $header }}
                    @else
                        @yield('title', 'Dashboard')
                    @endif
                </h1>

                <div class="w-6 lg:hidden"></div> {{-- spacer biar judul tetap center di mobile --}}
            </header>

            {{-- Notifikasi sukses / error global --}}
            <div class="px-4 lg:px-8 pt-4">
                @if(session('success'))
                    <x-alert type="success">{{ session('success') }}</x-alert>
                @endif

                @if($errors->any())
                    <x-alert type="error">
                        <div class="font-semibold">Terjadi kesalahan pada input form:</div>
                        <ul class="mt-2 list-disc list-inside text-sm leading-6 text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-alert>
                @endif

                @if(session('error'))
                    <x-alert type="error">{{ session('error') }}</x-alert>
                @endif
            </div>

            <main class="flex-1 px-4 lg:px-8 py-6">
                {{--
                    Layout ini dipakai dengan 2 cara:
                    1. @extends('layouts.app') + @section('content')  -> dipakai semua halaman CRUD
                    2. <x-app-layout> ... </x-app-layout>             -> dipakai halaman profile (Breeze)
                    $slot otomatis terisi untuk cara ke-2, jadi kita tampilkan itu jika ada.
                --}}
                {{ $slot ?? '' }}
                @yield('content', '')
            </main>
        </div>
    </div>

</body>
</html>
