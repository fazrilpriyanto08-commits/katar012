@extends('layouts.app')

@section('title', 'Portal Warga RT 12 RW 05 - Aplikasi Layanan & Komunikasi Lingkungan')

@section('content')
<div x-data="{ 
    activeTab: 'agenda',
    sosModalOpen: false,
    storyModalOpen: false,
    activeStory: { title: '', img: '', desc: '', tag: '' },
    currentSlide: 0,
    totalSlides: 3,
    nextSlide() { this.currentSlide = (this.currentSlide + 1) % this.totalSlides; },
    prevSlide() { this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides; },
    openStory(title, img, desc, tag) {
        this.activeStory = { title, img, desc, tag };
        this.storyModalOpen = true;
    }
}" x-init="setInterval(() => nextSlide(), 6000)" class="relative">

    <!-- APP STATUS BAR & GREETING HERO (JUMANJI LUXURY EDITION) -->
    <section class="relative jungle-pattern text-white pt-6 pb-12 sm:pt-10 sm:pb-16 overflow-hidden border-b border-emerald-900/60">
        <!-- Ambient Atmospheric Glows -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-500/25 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute top-1/4 -right-20 w-80 h-80 bg-amber-500/20 rounded-full blur-[110px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Citizen Top App Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-emerald-800/40">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo RT 12" class="w-12 h-12 rounded-2xl object-cover ring-2 ring-amber-400/80 shadow-lg shadow-emerald-950">
                        <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-stone-900 rounded-full flex items-center justify-center text-[8px] text-white">
                            <i class="fa-solid fa-check"></i>
                        </span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-emerald-300">Selamat Datang di</span>
                            <span class="bg-amber-400 text-stone-950 text-[9px] font-black px-2 py-0.5 rounded-full uppercase tracking-wider">Aplikasi Resmi</span>
                        </div>
                        <h1 class="text-lg sm:text-xl font-black text-white tracking-tight flex items-center gap-1.5">
                            Unit Penghubung Warga RT 12 RW 05
                        </h1>
                    </div>
                </div>

                <!-- Status Lingkungan & Jam Realtime -->
                <div class="flex items-center gap-3 self-start sm:self-auto">
                    <div class="bg-emerald-950/80 border border-emerald-500/40 px-3.5 py-1.5 rounded-xl backdrop-blur-md flex items-center gap-2 text-xs">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <span class="font-bold text-emerald-200">Lingkungan Siaga & Aman</span>
                    </div>
                    <button @click="sosModalOpen = true" class="bg-rose-600 hover:bg-rose-700 text-white font-black text-xs px-3.5 py-2 rounded-xl shadow-lg shadow-rose-900/40 flex items-center gap-1.5 transition transform hover:scale-105 active:scale-95 animate-pulse">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>SOS Darurat</span>
                    </button>
                </div>
            </div>

            <!-- STORY HIGHLIGHTS (INSTAGRAM / WHATSAPP STYLE APP STORIES) -->
            <div class="pt-6 pb-2">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-black uppercase tracking-wider text-amber-300 flex items-center gap-1.5">
                        <i class="fa-solid fa-bolt text-amber-400"></i> Sorotan Kegiatan & Info Lingkungan
                    </span>
                    <span class="text-[11px] text-emerald-300 font-medium">Geser untuk melihat →</span>
                </div>
                
                <div class="flex items-center gap-4 overflow-x-auto pb-3 pt-1 hide-scrollbar">
                    
                    <!-- Story 1: Jumanji -->
                    <button @click="openStory('Kemeriahan HUT RI Jumanji 81', '{{ asset('images/jumanji-hero.jpg') }}', 'Dokumentasi eksklusif pawai dan pentas seni bertema rimba Jumanji pemuda dan warga RT 012.', 'HUT RI Jumanji')" 
                            class="flex flex-col items-center gap-1.5 flex-shrink-0 group focus:outline-none">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full p-0.5 bg-gradient-to-tr from-amber-400 via-emerald-400 to-yellow-300 group-hover:scale-105 transition shadow-lg">
                            <div class="w-full h-full rounded-full overflow-hidden border-2 border-stone-900">
                                <img src="{{ asset('images/jumanji-hero.jpg') }}" alt="Jumanji" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-stone-200 group-hover:text-amber-300 truncate w-18 text-center">HUT Jumanji</span>
                    </button>

                    <!-- Story 2: Sensus Pemuda -->
                    <a href="{{ route('youth.register') }}" class="flex flex-col items-center gap-1.5 flex-shrink-0 group">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full p-0.5 bg-gradient-to-tr from-emerald-500 to-teal-300 group-hover:scale-105 transition shadow-lg">
                            <div class="w-full h-full rounded-full bg-emerald-900 flex items-center justify-center border-2 border-stone-900 text-emerald-300 text-xl">
                                <i class="fa-solid fa-compass"></i>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-stone-200 group-hover:text-emerald-300 truncate w-18 text-center">Sensus 2026</span>
                    </a>

                    <!-- Story 3: Kotak Suara -->
                    <a href="{{ route('aspiration') }}" class="flex flex-col items-center gap-1.5 flex-shrink-0 group">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full p-0.5 bg-gradient-to-tr from-yellow-400 to-amber-500 group-hover:scale-105 transition shadow-lg">
                            <div class="w-full h-full rounded-full bg-amber-950 flex items-center justify-center border-2 border-stone-900 text-amber-300 text-xl">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-stone-200 group-hover:text-amber-300 truncate w-18 text-center">Kotak Suara</span>
                    </a>

                    <!-- Story 4: Hall of Fame -->
                    <a href="{{ route('hall-of-fame') }}" class="flex flex-col items-center gap-1.5 flex-shrink-0 group">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full p-0.5 bg-gradient-to-tr from-amber-400 via-rose-400 to-yellow-300 group-hover:scale-105 transition shadow-lg">
                            <div class="w-full h-full rounded-full bg-stone-900 flex items-center justify-center border-2 border-stone-900 text-amber-400 text-xl">
                                <i class="fa-solid fa-trophy"></i>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-stone-200 group-hover:text-amber-300 truncate w-18 text-center">Juara & Tokoh</span>
                    </a>

                    <!-- Story 5: Galeri Momen -->
                    <a href="{{ route('gallery') }}" class="flex flex-col items-center gap-1.5 flex-shrink-0 group">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full p-0.5 bg-gradient-to-tr from-emerald-400 to-cyan-400 group-hover:scale-105 transition shadow-lg">
                            <div class="w-full h-full rounded-full bg-stone-900 flex items-center justify-center border-2 border-stone-900 text-cyan-300 text-xl">
                                <i class="fa-solid fa-images"></i>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-stone-200 group-hover:text-cyan-300 truncate w-18 text-center">Galeri Foto</span>
                    </a>

                    <!-- Story 6: WhatsApp Pengurus -->
                    <a href="https://wa.me/6281412357231" target="_blank" class="flex flex-col items-center gap-1.5 flex-shrink-0 group">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full p-0.5 bg-gradient-to-tr from-green-400 to-emerald-500 group-hover:scale-105 transition shadow-lg">
                            <div class="w-full h-full rounded-full bg-emerald-950 flex items-center justify-center border-2 border-stone-900 text-green-400 text-xl">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-stone-200 group-hover:text-green-300 truncate w-18 text-center">Chat Humas</span>
                    </a>

                    <!-- Story 7: Kontak SOS -->
                    <button @click="sosModalOpen = true" class="flex flex-col items-center gap-1.5 flex-shrink-0 group focus:outline-none">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full p-0.5 bg-gradient-to-tr from-rose-500 to-red-600 group-hover:scale-105 transition shadow-lg">
                            <div class="w-full h-full rounded-full bg-rose-950 flex items-center justify-center border-2 border-stone-900 text-rose-300 text-xl">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-stone-200 group-hover:text-rose-300 truncate w-18 text-center">Kontak SOS</span>
                    </button>
                </div>
            </div>

            <!-- INTERACTIVE CAROUSEL BANNER SLIDER -->
            <div class="mt-4 relative rounded-3xl overflow-hidden shadow-2xl border border-emerald-500/30 bg-stone-950">
                <!-- Slide 1: Jumanji -->
                <div x-show="currentSlide === 0" x-transition:enter="transition duration-500 ease-out" x-transition:enter-start="opacity-0 scale-98" x-transition:enter-end="opacity-100 scale-100" class="relative min-h-[340px] sm:min-h-[400px] flex items-end">
                    <img src="{{ asset('images/jumanji-hero.jpg') }}" alt="Jumanji HUT RI RT 12" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/60 to-transparent"></div>
                    <div class="relative z-10 p-6 sm:p-10 space-y-3 max-w-2xl">
                        <div class="flex items-center gap-2">
                            <span class="bg-amber-400 text-stone-950 text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider shadow">
                                <i class="fa-solid fa-crown mr-1"></i> Edisi Jumanji
                            </span>
                            <span class="bg-emerald-950/80 backdrop-blur-md text-emerald-300 text-xs font-bold px-3 py-1 rounded-full border border-emerald-500/30">
                                Dokumentasi Resmi
                            </span>
                        </div>
                        <h2 class="text-2xl sm:text-4xl font-black text-white leading-tight drop-shadow-md">
                            Bersatu & Kompak dalam Balutan Petualangan Rimba Jumanji
                        </h2>
                        <p class="text-stone-300 text-xs sm:text-sm leading-relaxed">
                            Potret kekompakan pemuda-pemudi Unit Penghubung Warga RT 12 RW 05 saat menyukseskan perayaan lingkungan bersama seluruh warga.
                        </p>
                        <div class="pt-2 flex flex-wrap gap-3">
                            <a href="{{ route('gallery') }}" class="bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 text-white font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-lg transition flex items-center gap-2">
                                <i class="fa-regular fa-images"></i> Lihat Galeri Momen
                            </a>
                            <a href="{{ route('about') }}" class="bg-stone-900/80 hover:bg-stone-800 text-stone-200 text-xs font-bold px-4 py-2.5 rounded-xl border border-white/20 transition">
                                Tentang Kami
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Sensus Pemuda -->
                <div x-show="currentSlide === 1" x-cloak x-transition:enter="transition duration-500 ease-out" x-transition:enter-start="opacity-0 scale-98" x-transition:enter-end="opacity-100 scale-100" class="relative min-h-[340px] sm:min-h-[400px] flex items-end bg-gradient-to-br from-emerald-950 via-stone-950 to-green-950">
                    <div class="absolute inset-0 opacity-20 pointer-events-none">
                        <i class="fa-solid fa-compass absolute right-10 top-10 text-[200px] text-emerald-400"></i>
                    </div>
                    <div class="relative z-10 p-6 sm:p-10 space-y-3 max-w-2xl">
                        <div class="flex items-center gap-2">
                            <span class="bg-emerald-500 text-white text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider">
                                <i class="fa-solid fa-users mr-1"></i> Sensus Digital 2026
                            </span>
                        </div>
                        <h2 class="text-2xl sm:text-4xl font-black text-white leading-tight">
                            Ayo Pemuda-Pemudi RT 012! Waktunya Tunjukkan Kontribusimu
                        </h2>
                        <p class="text-stone-300 text-xs sm:text-sm leading-relaxed">
                            Sudahkah namamu tercatat dalam Database Pemuda RT 012 RW 05? Dapatkan info kegiatan, wadah bakat olahraga & seni, serta jejaring positif.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('youth.register') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-400 to-yellow-500 hover:from-amber-500 text-stone-950 font-black text-xs px-5 py-2.5 rounded-xl shadow-lg transition">
                                <i class="fa-solid fa-user-plus"></i> Isi Formulir Sensus Online (1 Menit)
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Kotak Suara Warga -->
                <div x-show="currentSlide === 2" x-cloak x-transition:enter="transition duration-500 ease-out" x-transition:enter-start="opacity-0 scale-98" x-transition:enter-end="opacity-100 scale-100" class="relative min-h-[340px] sm:min-h-[400px] flex items-end bg-gradient-to-br from-stone-950 via-green-950 to-emerald-950">
                    <div class="absolute inset-0 opacity-20 pointer-events-none">
                        <i class="fa-solid fa-bullhorn absolute right-10 top-10 text-[200px] text-amber-400"></i>
                    </div>
                    <div class="relative z-10 p-6 sm:p-10 space-y-3 max-w-2xl">
                        <div class="flex items-center gap-2">
                            <span class="bg-amber-400 text-stone-950 text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider">
                                <i class="fa-solid fa-comments mr-1"></i> Layanan Terbuka
                            </span>
                        </div>
                        <h2 class="text-2xl sm:text-4xl font-black text-white leading-tight">
                            Ada Masukan, Saran Fasilitas, atau Ide Acara Warga?
                        </h2>
                        <p class="text-stone-300 text-xs sm:text-sm leading-relaxed">
                            Pengurus RT 012 dan Karang Taruna selalu siap mendengar. Kirimkan pesanmu secara langsung tanpa birokrasi yang rumit.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('aspiration') }}" class="inline-flex items-center gap-2 bg-white text-emerald-900 hover:bg-emerald-50 font-black text-xs px-5 py-2.5 rounded-xl shadow-lg transition">
                                <i class="fa-solid fa-paper-plane"></i> Tulis Aspirasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide Indicators & Nav -->
                <div class="absolute top-4 right-4 z-20 flex items-center gap-1.5 bg-stone-950/70 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10">
                    <button @click="prevSlide()" class="text-stone-400 hover:text-white text-xs px-1"><i class="fa-solid fa-chevron-left"></i></button>
                    <span class="text-xs font-bold text-amber-400" x-text="(currentSlide + 1) + '/' + totalSlides"></span>
                    <button @click="nextSlide()" class="text-stone-400 hover:text-white text-xs px-1"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

        </div>
    </section>

    <!-- 8 SUPER-APP SERVICE TILES (MENU LAYANAN UTAMA WARGA) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 sm:-mt-8 relative z-20">
        <div class="bg-white rounded-3xl p-5 sm:p-7 shadow-xl border border-stone-200/80">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-stone-100">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                    <h2 class="text-xs sm:text-sm font-black text-stone-900 uppercase tracking-wider">Layanan Mandiri Warga RT 012</h2>
                </div>
                <span class="text-[11px] text-stone-400 font-semibold hidden sm:inline">Pusat Navigasi & Aksi Cepat</span>
            </div>

            <!-- 8 App Icon Grid -->
            <div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-8 gap-3 sm:gap-4 text-center">
                
                <!-- 1. Aspirasi -->
                <a href="{{ route('aspiration') }}" class="group flex flex-col items-center gap-2 p-2.5 rounded-2xl hover:bg-amber-50/70 transition duration-200">
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-500 text-stone-950 flex items-center justify-center text-xl shadow-md shadow-amber-400/20 group-hover:scale-110 group-hover:shadow-lg transition">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-stone-800 group-hover:text-amber-700 leading-tight">Kotak Suara</span>
                </a>

                <!-- 2. Sensus Pemuda -->
                <a href="{{ route('youth.register') }}" class="group flex flex-col items-center gap-2 p-2.5 rounded-2xl hover:bg-emerald-50/70 transition duration-200">
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-emerald-600 to-green-700 text-white flex items-center justify-center text-xl shadow-md shadow-emerald-600/20 group-hover:scale-110 group-hover:shadow-lg transition">
                        <i class="fa-solid fa-id-card-clip"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-stone-800 group-hover:text-emerald-700 leading-tight">Sensus Pemuda</span>
                </a>

                <!-- 3. Lapak UMKM (Baru) -->
                <a href="{{ route('umkm.index') }}" class="group flex flex-col items-center gap-2 p-2.5 rounded-2xl hover:bg-amber-50/70 transition duration-200">
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 text-stone-950 flex items-center justify-center text-xl shadow-md shadow-amber-500/20 group-hover:scale-110 group-hover:shadow-lg transition">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-stone-800 group-hover:text-amber-700 leading-tight">Lapak UMKM</span>
                </a>

                <!-- 4. Agenda -->
                <a href="{{ route('events.index') }}" class="group flex flex-col items-center gap-2 p-2.5 rounded-2xl hover:bg-blue-50/70 transition duration-200">
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-xl shadow-md shadow-blue-500/20 group-hover:scale-110 group-hover:shadow-lg transition">
                        <i class="fa-regular fa-calendar-check"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-stone-800 group-hover:text-blue-700 leading-tight">Agenda Acara</span>
                </a>

                <!-- 4. Berita -->
                <a href="{{ route('articles.index') }}" class="group flex flex-col items-center gap-2 p-2.5 rounded-2xl hover:bg-lime-50/70 transition duration-200">
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-lime-500 to-emerald-600 text-white flex items-center justify-center text-xl shadow-md shadow-lime-500/20 group-hover:scale-110 group-hover:shadow-lg transition">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-stone-800 group-hover:text-lime-700 leading-tight">Warta Warga</span>
                </a>

                <!-- 5. Hall of Fame -->
                <a href="{{ route('hall-of-fame') }}" class="group flex flex-col items-center gap-2 p-2.5 rounded-2xl hover:bg-yellow-50/70 transition duration-200">
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-yellow-400 via-amber-400 to-amber-600 text-stone-950 flex items-center justify-center text-xl shadow-md shadow-amber-400/20 group-hover:scale-110 group-hover:shadow-lg transition">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-stone-800 group-hover:text-amber-700 leading-tight">Hall of Fame</span>
                </a>

                <!-- 6. Profil Pengurus -->
                <a href="{{ route('about') }}" class="group flex flex-col items-center gap-2 p-2.5 rounded-2xl hover:bg-purple-50/70 transition duration-200">
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-700 text-white flex items-center justify-center text-xl shadow-md shadow-purple-500/20 group-hover:scale-110 group-hover:shadow-lg transition">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-stone-800 group-hover:text-purple-700 leading-tight">Profil & RT</span>
                </a>

                <!-- 7. Galeri Foto -->
                <a href="{{ route('gallery') }}" class="group flex flex-col items-center gap-2 p-2.5 rounded-2xl hover:bg-cyan-50/70 transition duration-200">
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-teal-600 text-white flex items-center justify-center text-xl shadow-md shadow-cyan-500/20 group-hover:scale-110 group-hover:shadow-lg transition">
                        <i class="fa-solid fa-camera-retro"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-stone-800 group-hover:text-cyan-700 leading-tight">Galeri Foto</span>
                </a>

                <!-- 8. SOS Kontak -->
                <button @click="sosModalOpen = true" class="group flex flex-col items-center gap-2 p-2.5 rounded-2xl hover:bg-rose-50/70 transition duration-200 focus:outline-none">
                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-rose-500 to-red-600 text-white flex items-center justify-center text-xl shadow-md shadow-rose-500/20 group-hover:scale-110 group-hover:shadow-lg transition">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <span class="text-[11px] sm:text-xs font-bold text-rose-700 group-hover:text-rose-800 leading-tight">Kontak SOS</span>
                </button>

            </div>
        </div>
    </section>

    <!-- LIVE CITIZEN RADAR / METRIC TILES (INFO TRANSPARANSI LINGKUNGAN) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            
            <div class="bg-gradient-to-br from-emerald-50 to-white p-4 rounded-2xl border border-emerald-200/80 shadow-sm flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-lg shadow-sm">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <div class="text-xl sm:text-2xl font-black text-stone-900">{{ $stats['total_youth'] }}</div>
                    <div class="text-[11px] font-bold text-emerald-800">Pemuda Terdata</div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-white p-4 rounded-2xl border border-blue-200/80 shadow-sm flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center text-lg shadow-sm">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <div>
                    <div class="text-xl sm:text-2xl font-black text-stone-900">{{ $stats['total_events'] }}</div>
                    <div class="text-[11px] font-bold text-blue-800">Agenda Kegiatan</div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-amber-50 to-white p-4 rounded-2xl border border-amber-200/80 shadow-sm flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-amber-500 text-stone-950 flex items-center justify-center text-lg shadow-sm">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <div>
                    <div class="text-xl sm:text-2xl font-black text-stone-900">{{ $stats['total_aspirations'] }}</div>
                    <div class="text-[11px] font-bold text-amber-800">Suara Warga Masuk</div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-stone-100 to-white p-4 rounded-2xl border border-stone-200 shadow-sm flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-xl bg-stone-900 text-amber-300 flex items-center justify-center text-lg shadow-sm">
                    <i class="fa-solid fa-trophy"></i>
                </div>
                <div>
                    <div class="text-xl sm:text-2xl font-black text-stone-900">{{ $stats['total_honorees'] }}</div>
                    <div class="text-[11px] font-bold text-stone-600">Tokoh & Prestasi</div>
                </div>
            </div>

        </div>
    </section>

    <!-- INTERACTIVE APP FEED (SEGMENTED TABS - MOBILE APP EXPERIENCE) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        
        <!-- Tab Selector Bar -->
        <div class="bg-stone-200/70 p-1.5 rounded-2xl flex items-center gap-1 max-w-xl mx-auto sm:mx-0 overflow-x-auto hide-scrollbar">
            <button @click="activeTab = 'agenda'" 
                    class="flex-1 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-extrabold transition whitespace-nowrap flex items-center justify-center gap-2"
                    :class="activeTab === 'agenda' ? 'bg-white text-emerald-800 shadow-md' : 'text-stone-600 hover:text-stone-900'">
                <i class="fa-regular fa-calendar-check text-emerald-600"></i>
                <span>Agenda Terdekat</span>
            </button>
            <button @click="activeTab = 'berita'" 
                    class="flex-1 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-extrabold transition whitespace-nowrap flex items-center justify-center gap-2"
                    :class="activeTab === 'berita' ? 'bg-white text-emerald-800 shadow-md' : 'text-stone-600 hover:text-stone-900'">
                <i class="fa-regular fa-newspaper text-lime-600"></i>
                <span>Kabar Warta</span>
            </button>
            <button @click="activeTab = 'aspirasi'" 
                    class="flex-1 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-extrabold transition whitespace-nowrap flex items-center justify-center gap-2"
                    :class="activeTab === 'aspirasi' ? 'bg-white text-emerald-800 shadow-md' : 'text-stone-600 hover:text-stone-900'">
                <i class="fa-solid fa-comments text-amber-500"></i>
                <span>Suara Warga</span>
            </button>
        </div>

        <!-- TAB CONTENT 1: AGENDA -->
        <div x-show="activeTab === 'agenda'" x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base sm:text-lg font-black text-stone-900 flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-emerald-600"></i>
                    <span>Jadwal Kegiatan Mendatang</span>
                </h3>
                <a href="{{ route('events.index') }}" class="text-xs font-extrabold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                    Lihat Kalender Lengkap <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse($upcomingEvents as $event)
                    <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col group">
                        <div class="relative h-40 overflow-hidden bg-stone-900">
                            <img src="{{ $event->image ?: 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-2.5 right-2.5 bg-stone-950/85 backdrop-blur-md text-amber-300 text-[10px] font-black px-2.5 py-0.5 rounded-full border border-amber-400/20">
                                {{ $event->status }}
                            </div>
                            <div class="absolute bottom-2.5 left-2.5 bg-white/95 backdrop-blur-md text-stone-900 rounded-xl px-2.5 py-1 shadow text-center">
                                <div class="text-[9px] font-bold text-emerald-700 uppercase leading-none">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('M') }}</div>
                                <div class="text-base font-black leading-none mt-0.5">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</div>
                            </div>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
                            <div>
                                <div class="text-[11px] font-bold text-emerald-700 flex items-center gap-1 mb-1">
                                    <i class="fa-regular fa-clock"></i> {{ $event->start_time ?? '08:00' }} WIB
                                </div>
                                <h4 class="font-extrabold text-stone-900 text-sm group-hover:text-emerald-700 transition line-clamp-2 leading-snug">
                                    <a href="{{ route('events.show', $event->slug) }}">{{ $event->title }}</a>
                                </h4>
                                <p class="text-[11px] text-stone-500 line-clamp-2 mt-1">{{ $event->description }}</p>
                            </div>
                            <div class="pt-2.5 border-t border-stone-100 flex items-center justify-between text-[11px]">
                                <span class="text-stone-400 truncate max-w-[140px] flex items-center gap-1">
                                    <i class="fa-solid fa-location-dot text-rose-500"></i> {{ $event->location }}
                                </span>
                                <a href="{{ route('events.show', $event->slug) }}" class="font-bold text-emerald-700 hover:text-emerald-900">
                                    Rincian →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 bg-white p-8 rounded-2xl text-center border border-stone-200">
                        <i class="fa-regular fa-calendar-xmark text-3xl text-stone-300 mb-2"></i>
                        <p class="text-stone-500 text-sm">Belum ada agenda terdekat saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- TAB CONTENT 2: BERITA -->
        <div x-show="activeTab === 'berita'" x-cloak x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base sm:text-lg font-black text-stone-900 flex items-center gap-2">
                    <i class="fa-regular fa-newspaper text-lime-600"></i>
                    <span>Kabar & Pengumuman Terbaru</span>
                </h3>
                <a href="{{ route('articles.index') }}" class="text-xs font-extrabold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                    Semua Berita <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($latestArticles as $art)
                    <article class="bg-white rounded-2xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col group">
                        <div class="relative h-44 overflow-hidden bg-stone-900">
                            <img src="{{ $art->image ?: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $art->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <span class="absolute bottom-2.5 left-2.5 bg-stone-950/80 backdrop-blur-md text-amber-300 text-[10px] font-black px-2.5 py-0.5 rounded-lg border border-stone-800">
                                {{ $art->category }}
                            </span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                            <div>
                                <div class="text-[11px] text-stone-400 mb-1">
                                    {{ \Carbon\Carbon::parse($art->published_at)->diffForHumans() }} • <span class="font-semibold text-stone-600">{{ $art->author }}</span>
                                </div>
                                <h4 class="font-extrabold text-stone-900 text-sm sm:text-base group-hover:text-emerald-700 transition line-clamp-2 leading-snug">
                                    <a href="{{ route('articles.show', $art->slug) }}">{{ $art->title }}</a>
                                </h4>
                                <p class="text-[11px] text-stone-500 line-clamp-2 mt-1">
                                    {{ $art->excerpt ?: Str::limit(strip_tags($art->content), 90) }}
                                </p>
                            </div>
                            <div class="pt-3 border-t border-stone-100">
                                <a href="{{ route('articles.show', $art->slug) }}" class="inline-flex items-center gap-1 text-xs font-black text-emerald-700 hover:text-emerald-900">
                                    Baca Selengkapnya <i class="fa-solid fa-chevron-right text-[9px]"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <!-- TAB CONTENT 3: ASPIRASI WARGA TERBARU -->
        <div x-show="activeTab === 'aspirasi'" x-cloak x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base sm:text-lg font-black text-stone-900 flex items-center gap-2">
                    <i class="fa-solid fa-clipboard-check text-amber-500"></i>
                    <span>Tindak Lanjut Suara & Aspirasi Warga</span>
                </h3>
                <a href="{{ route('aspiration') }}" class="text-xs font-extrabold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                    Kirim Aspirasi Baru <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse($latestAspirations as $asp)
                    <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm space-y-3 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-black text-stone-800 flex items-center gap-1.5">
                                    <i class="fa-regular fa-user text-emerald-600"></i> {{ $asp->name }}
                                </span>
                                <span class="text-[9px] font-extrabold px-2 py-0.5 rounded-full {{ $asp->status == 'Selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $asp->status }}
                                </span>
                            </div>
                            <span class="text-[10px] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md inline-block mb-1.5">
                                {{ $asp->category }}
                            </span>
                            <p class="text-xs text-stone-600 italic leading-relaxed">"{{ Str::limit($asp->message, 100) }}"</p>
                        </div>
                        @if($asp->admin_notes)
                            <div class="text-[11px] text-emerald-800 bg-emerald-50 p-2.5 rounded-xl border border-emerald-100">
                                <div class="font-extrabold text-[10px] uppercase text-emerald-700 mb-0.5">Tanggapan Pengurus:</div>
                                {{ $asp->admin_notes }}
                            </div>
                        @else
                            <div class="text-[10px] text-stone-400 italic">Sedang dalam peninjauan pengurus...</div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-3 bg-white p-8 rounded-2xl text-center border border-stone-200">
                        <p class="text-stone-500 text-sm">Belum ada aspirasi yang ditayangkan.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </section>

    <!-- PASAR & LAPAK UMKM WARGA RT 12 (ETALASE USAHA & JAJANAN TETANGGA) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <div class="bg-gradient-to-b from-amber-50/50 via-white to-stone-50 rounded-3xl p-6 sm:p-8 border border-amber-200/80 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/15 text-amber-900 border border-amber-400/40 text-[10px] font-black uppercase tracking-wider mb-1">
                        <i class="fa-solid fa-basket-shopping text-amber-600"></i>
                        <span>Ekonomi & Usaha Tetangga Sendiri</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-black text-stone-900">
                        Pasar & Lapak UMKM Warga RT 12
                    </h3>
                    <p class="text-xs text-stone-500 mt-0.5">Beli jajanan, sembako, dan sewa jasa langsung dari tetangga satu RT.</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('umkm.index') }}" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold text-xs shadow-md shadow-emerald-700/20 transition flex items-center gap-1.5">
                        <span>Lihat Semua Toko</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($featuredBusinesses as $b)
                    <div class="bg-white rounded-2xl border border-stone-200/90 overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition duration-200 flex flex-col justify-between group">
                        <div>
                            <div class="relative h-40 bg-stone-900 overflow-hidden">
                                <img src="{{ $b->image ?: 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80' }}"
                                     alt="{{ $b->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-md text-[9px] font-black uppercase tracking-wider backdrop-blur-md bg-stone-950/80 text-amber-300 border border-stone-800">
                                    {{ $b->category }}
                                </span>
                                <span class="absolute top-2.5 right-2.5 bg-emerald-600/95 backdrop-blur-md text-white px-2 py-0.5 rounded-md text-[9px] font-black border border-emerald-400/40 shadow flex items-center gap-1">
                                    <i class="fa-solid fa-circle-check text-emerald-200"></i>
                                    <span>Warga RT 12</span>
                                </span>
                            </div>

                            <div class="p-4 space-y-2">
                                <div>
                                    <h4 class="font-extrabold text-stone-900 text-sm group-hover:text-emerald-700 transition line-clamp-1">
                                        {{ $b->name }}
                                    </h4>
                                    <div class="text-[11px] font-semibold text-stone-500 mt-0.5">
                                        Pemilik: <strong class="text-stone-700">{{ $b->owner_name }}</strong>
                                    </div>
                                </div>
                                <p class="text-[11px] text-stone-600 line-clamp-2 leading-relaxed">
                                    {{ $b->description }}
                                </p>
                                <div class="pt-2 border-t border-stone-100 flex items-center justify-between text-[11px]">
                                    <span class="text-stone-400">Harga:</span>
                                    <span class="font-extrabold text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200/50">
                                        {{ $b->price_range }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 pt-0">
                            <a href="{{ $b->whatsapp_link }}" target="_blank"
                               class="w-full py-2 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs flex items-center justify-center gap-1.5 transition">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Pesan via WhatsApp</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-stone-400 text-xs">
                        Belum ada toko yang terdaftar.
                    </div>
                @endforelse
            </div>

            <!-- Callout Daftar UMKM -->
            <div class="mt-6 p-4 rounded-2xl bg-gradient-to-r from-amber-500/10 via-emerald-500/10 to-transparent border border-amber-400/30 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500 text-stone-950 flex items-center justify-center font-black text-lg flex-shrink-0">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div>
                        <div class="font-black text-xs sm:text-sm text-stone-900">Punya Usaha Jajanan, Sembako, atau Jasa di Lingkungan RT 12?</div>
                        <div class="text-[11px] text-stone-500">Promosikan gratis ke seluruh warga di aplikasi ini. Langsung terhubung ke nomor WhatsApp Anda.</div>
                    </div>
                </div>
                <a href="{{ route('umkm.index') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-stone-950 font-black text-xs rounded-xl transition text-center whitespace-nowrap">
                    Daftarkan Usaha Saya
                </a>
            </div>
        </div>
    </section>

    <!-- PWA / DOWNLOAD MOBILE APP BANNER (SOLUSI KHUSUS UNTUK APLIKASI WARGA) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-16">
        <div class="bg-gradient-to-br from-emerald-950 via-stone-900 to-green-950 text-white rounded-3xl p-6 sm:p-10 border border-emerald-800/80 shadow-2xl relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                <div class="lg:col-span-4 text-center lg:text-left flex flex-col items-center lg:items-start">
                    <div class="w-16 h-16 rounded-2xl bg-amber-400 text-stone-950 flex items-center justify-center text-3xl shadow-lg mb-4">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                    </div>
                    <span class="bg-emerald-900/80 border border-emerald-400/30 text-emerald-300 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest mb-2">
                        Siap Diinstall di Android & iPhone
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-white leading-tight">
                        Pasang Aplikasi Warga RT 12
                    </h3>
                    <div class="mt-4">
                        <button type="button" onclick="window.triggerPwaInstall()" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-stone-950 font-black text-xs sm:text-sm shadow-xl shadow-amber-400/20 transition hover:scale-105 active:scale-95">
                            <i class="fa-solid fa-download"></i>
                            <span>Pasang Aplikasi ke Layar HP</span>
                        </button>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-4">
                    <p class="text-stone-300 text-xs sm:text-sm leading-relaxed">
                        Agar warga mudah membuka layanan tanpa mengetik alamat website berulang kali, portal ini telah dilengkapi dukungan <strong class="text-amber-300 font-extrabold">Web App / PWA</strong>. Anda dapat mengunduh atau menyematkannya langsung ke beranda HP Anda!
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-sm flex-shrink-0">
                                <i class="fa-brands fa-android"></i>
                            </div>
                            <div>
                                <div class="font-extrabold text-xs text-white">Pengguna Android / Chrome</div>
                                <div class="text-[11px] text-stone-400 mt-0.5">Klik titik 3 di browser → Pilih <strong>"Tambahkan ke Layar Utama"</strong>.</div>
                            </div>
                        </div>

                        <div class="bg-white/5 border border-white/10 rounded-2xl p-4 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold text-sm flex-shrink-0">
                                <i class="fa-brands fa-apple"></i>
                            </div>
                            <div>
                                <div class="font-extrabold text-xs text-white">Pengguna iPhone / Safari</div>
                                <div class="text-[11px] text-stone-400 mt-0.5">Klik ikon Share (kotak panah) → Pilih <strong>"Add to Home Screen"</strong>.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL POPUP STORY (PREVIEW HIGHLIGHT) -->
    <div x-show="storyModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md"
         x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         @keydown.escape.window="storyModalOpen = false">
        <div class="relative max-w-lg w-full bg-stone-950 rounded-3xl overflow-hidden border border-emerald-600/40 shadow-2xl" @click.outside="storyModalOpen = false">
            <button @click="storyModalOpen = false" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-stone-900/80 text-white flex items-center justify-center hover:bg-stone-800 border border-white/20">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="relative h-80 sm:h-96 bg-stone-900">
                <img :src="activeStory.img" :alt="activeStory.title" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/40 to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4 text-white space-y-1.5">
                    <span class="text-[10px] font-black uppercase tracking-wider bg-amber-400 text-stone-950 px-2.5 py-0.5 rounded-md" x-text="activeStory.tag"></span>
                    <h3 class="text-lg font-black text-white" x-text="activeStory.title"></h3>
                    <p class="text-xs text-stone-300 leading-relaxed" x-text="activeStory.desc"></p>
                </div>
            </div>
            <div class="p-4 bg-stone-950 flex justify-end">
                <a href="{{ route('gallery') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-4 py-2 rounded-xl transition">
                    Lihat Seluruh Galeri →
                </a>
            </div>
        </div>
    </div>

    <!-- MODAL POPUP SOS DARURAT (EMERGENCY CONTACTS DIALER) -->
    <div x-show="sosModalOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md"
         x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         @keydown.escape.window="sosModalOpen = false">
        <div class="relative max-w-md w-full bg-white rounded-3xl overflow-hidden shadow-2xl border border-rose-300 p-6 space-y-5" @click.outside="sosModalOpen = false">
            <div class="flex items-center justify-between border-b border-rose-100 pb-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center text-lg font-black">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div>
                        <h3 class="font-black text-stone-900 text-base">Kontak Darurat RT 012</h3>
                        <p class="text-[11px] text-stone-500">Hubungi langsung untuk keadaan mendesak</p>
                    </div>
                </div>
                <button @click="sosModalOpen = false" class="text-stone-400 hover:text-stone-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="space-y-2.5">
                <!-- Ketua RT -->
                <a href="https://wa.me/6281412357231?text=HALO%20PAK%20RT%20012%2C%20SAYA%20WARGA%20MEMBUTUHKAN%20BANTUAN%20DARURAT!" target="_blank"
                   class="flex items-center justify-between p-3.5 rounded-2xl bg-rose-50/70 hover:bg-rose-100/70 border border-rose-200 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-user-shield"></i></div>
                        <div>
                            <div class="font-bold text-xs text-stone-900">Ketua RT 012 & Humas</div>
                            <div class="text-[10px] text-stone-500">0814-1235-7231 (Pelayanan & Keamanan)</div>
                        </div>
                    </div>
                    <span class="text-xs font-black text-rose-700 group-hover:underline">WhatsApp →</span>
                </a>

                <!-- Koordinator Keamanan / Pos Ronda -->
                <a href="https://wa.me/6281412357231?text=DARURAT%20POS%20RONDA%20RT%20012!" target="_blank"
                   class="flex items-center justify-between p-3.5 rounded-2xl bg-stone-50 hover:bg-stone-100 border border-stone-200 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-stone-800 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-shield"></i></div>
                        <div>
                            <div class="font-bold text-xs text-stone-900">Posko Ronda & Keamanan</div>
                            <div class="text-[10px] text-stone-500">Gg. H. Saatun RT 012 RW 05</div>
                        </div>
                    </div>
                    <span class="text-xs font-black text-stone-700 group-hover:underline">Hubungi →</span>
                </a>

                <!-- Layanan Bhabinkamtibmas / Polsek -->
                <a href="tel:110" class="flex items-center justify-between p-3.5 rounded-2xl bg-stone-50 hover:bg-stone-100 border border-stone-200 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-building-shield"></i></div>
                        <div>
                            <div class="font-bold text-xs text-stone-900">Polisi (Call Center)</div>
                            <div class="text-[10px] text-stone-500">Telepon Darurat 110</div>
                        </div>
                    </div>
                    <span class="text-xs font-black text-blue-700 group-hover:underline">Panggil 110 →</span>
                </a>

                <!-- Ambulans / Medis -->
                <a href="tel:119" class="flex items-center justify-between p-3.5 rounded-2xl bg-stone-50 hover:bg-stone-100 border border-stone-200 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-sm"><i class="fa-solid fa-truck-medical"></i></div>
                        <div>
                            <div class="font-bold text-xs text-stone-900">Ambulans Gawat Darurat</div>
                            <div class="text-[10px] text-stone-500">Layanan Kesehatan 119</div>
                        </div>
                    </div>
                    <span class="text-xs font-black text-emerald-700 group-hover:underline">Panggil 119 →</span>
                </a>
            </div>

            <p class="text-[10px] text-stone-400 text-center">Simpan halaman ini di HP Anda untuk akses cepat kapan pun dibutuhkan.</p>
        </div>
    </div>

</div>
@endsection
