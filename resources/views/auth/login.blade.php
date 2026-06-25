<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — {{ config('app.name', 'Management App') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex">
    {{-- ===== KANAN: Login Form ===== --}}
    <div class="flex-1 flex items-center justify-center bg-slate-50 p-6">
        <div class="w-full max-w-md">

            {{-- Mobile logo --}}
            <div class="flex lg:hidden items-center gap-3 mb-8">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                     style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <div>
                    <p class="text-slate-800 font-semibold text-sm">Management App</p>
                    <p class="text-indigo-500 text-xs">Muhamad Salwarud</p>
                </div>
            </div>

            {{-- Heading --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-slate-800">Perpustakaan System Management</h1>    
                <p class="text-slate-500 text-sm mt-1">Perpustakaan Digital</p>
            </div>              

            {{-- Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 rounded-lg px-4 py-3">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Alamat Email
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="admin@example.com"
                            class="w-full px-4 py-2.5 rounded-xl border text-sm text-slate-800 placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition
                                   @error('email') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror"
                        />
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-slate-700">
                                Password
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-xs text-indigo-600 hover:text-indigo-800 font-medium transition">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-2.5 rounded-xl border text-sm text-slate-800 placeholder-slate-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition
                                   @error('password') border-red-400 bg-red-50 @else border-slate-200 bg-slate-50 @enderror"
                        />
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-2">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        />
                        <label for="remember_me" class="text-sm text-slate-600">
                            Ingat saya
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <button
                        type="submit"
                        class="w-full py-2.5 px-4 rounded-xl text-sm font-semibold text-white transition
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        style="background: linear-gradient(135deg, #6366f1, #7c3aed);"
                        onmouseover="this.style.opacity='0.9'"
                        onmouseout="this.style.opacity='1'"
                    >
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-slate-400 mt-6">
                &copy; {{ date('Y') }} Perpustakaan Digital 2026 - BNSP -MUHAMAD SALWARUD.
            </p>
        </div>
    </div>

</body>
</html>