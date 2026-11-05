@extends('layouts.app')

@section('title', 'Login Pengurus - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<div class="relative min-h-[85vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 jungle-pattern overflow-hidden">
    <!-- Ambient Jungle Glows -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl h-96 bg-emerald-950/40 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 max-w-md w-full">
        <!-- Main Card -->
        <div class="bg-white/95 backdrop-blur-xl p-8 sm:p-10 rounded-3xl border border-white/60 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.5)] transition duration-300 hover:shadow-[0_25px_70px_-15px_rgba(16,185,129,0.3)]">
            
            <!-- Header with Official Logo -->
            <div class="text-center space-y-3 mb-8">
                <div class="relative inline-block group">
                    <div class="absolute -inset-1.5 bg-gradient-to-r from-amber-400 to-emerald-500 rounded-full blur opacity-70 group-hover:opacity-100 transition duration-300"></div>
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo RT 12 RW 05" class="relative w-20 h-20 rounded-full mx-auto object-cover border-2 border-white shadow-lg">
                    <span class="absolute -bottom-1 -right-1 bg-amber-400 text-stone-950 text-[10px] font-black px-2 py-0.5 rounded-full border border-white shadow">
                        012
                    </span>
                </div>

                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[11px] font-extrabold uppercase tracking-wider mb-2">
                        <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                        Portal Resmi Pengurus
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-stone-900 tracking-tight">
                        Masuk Pengurus
                    </h2>
                    <p class="text-xs sm:text-sm text-stone-500 mt-1">
                        Unit Penghubung Warga RT 12 RW 05
                    </p>
                </div>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-5" x-data="{ showPassword: false }">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-extrabold text-stone-700 uppercase tracking-wider">
                        Alamat Email
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 group-focus-within:text-emerald-600 transition">
                            <i class="fa-regular fa-envelope text-sm"></i>
                        </div>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email', 'admin@katar012.id') }}" 
                               required 
                               autocomplete="email"
                               placeholder="nama@katar012.id"
                               class="w-full bg-stone-50/80 hover:bg-white border border-stone-200 rounded-2xl pl-10 pr-4 py-3.5 text-sm font-medium text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600 transition shadow-inner">
                    </div>
                </div>

                <!-- Password Input with Toggle Visibility -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label class="block text-xs font-extrabold text-stone-700 uppercase tracking-wider">
                            Kata Sandi
                        </label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 group-focus-within:text-emerald-600 transition">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="••••••••"
                               class="w-full bg-stone-50/80 hover:bg-white border border-stone-200 rounded-2xl pl-10 pr-11 py-3.5 text-sm font-medium text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600 transition shadow-inner">
                        <button type="button" 
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-stone-400 hover:text-stone-700 focus:outline-none transition">
                            <i class="fa-solid text-sm" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 text-stone-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-stone-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="font-semibold">Ingat sesi saya</span>
                    </label>
                    <span class="text-stone-400 text-[11px] flex items-center gap-1">
                        <i class="fa-solid fa-lock text-stone-400"></i> Terenkripsi Aman
                    </span>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-emerald-700 via-green-700 to-emerald-800 hover:from-emerald-800 hover:to-green-900 text-white font-black py-4 px-5 rounded-2xl shadow-lg shadow-emerald-700/30 transition duration-200 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2.5 text-sm tracking-wide border border-emerald-600/30">
                    <i class="fa-solid fa-right-to-bracket text-amber-300"></i>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <!-- Bottom Return Link -->
            <div class="mt-8 pt-6 border-t border-stone-100 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-bold text-stone-500 hover:text-emerald-700 transition px-3 py-1.5 rounded-xl hover:bg-stone-50">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Beranda Publik</span>
                </a>
            </div>

        </div>

        <!-- Security & Identity Footer Badge -->
        <div class="mt-6 text-center text-xs text-stone-400 flex items-center justify-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <span>Unit Penghubung Warga RT 12 RW 05 • Kelurahan Lenteng Agung</span>
        </div>
    </div>
</div>
@endsection
