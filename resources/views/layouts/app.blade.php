<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#064e3b">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Warga RT 12">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.jpg') }}">
    <title>@yield('title', 'Unit Penghubung Warga RT 12 RW 05 - Portal Resmi')</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        jungle: { 50:'#f2fbf5',100:'#e1f6e8',200:'#c3ecd2',500:'#15803d',600:'#166534',700:'#14532d',800:'#0f3f22',900:'#0a2e18',950:'#041a0d' },
                        safari: { 50:'#fdfbf7',100:'#f9f4ea',300:'#e8d2a6',400:'#d4af37',500:'#c59b27',600:'#a37b19' }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .jungle-pattern {
            background-color: #04190e;
            background-image: 
                radial-gradient(circle at 15% 25%, rgba(16,185,129,0.22) 0%, transparent 45%),
                radial-gradient(circle at 85% 75%, rgba(217,119,6,0.18) 0%, transparent 45%),
                radial-gradient(rgba(52,211,153,0.15) 1.2px, transparent 1.2px);
            background-size: 100% 100%, 100% 100%, 36px 36px;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f5f5f4; }
        ::-webkit-scrollbar-thumb { background: #15803d; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #166534; }
        /* Hide scrollbar for mobile nav */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        /* Animations */
        @keyframes fadeInUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
        @keyframes slideInRight { from { opacity:0; transform:translateX(30px); } to { opacity:1; transform:translateX(0); } }
        @keyframes float { 0%,100% { transform:translateY(0); } 50% { transform:translateY(-8px); } }
        @keyframes pulse-glow { 0%,100% { box-shadow: 0 0 5px rgba(16,185,129,0.4); } 50% { box-shadow: 0 0 20px rgba(16,185,129,0.7); } }
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        .animate-slide-in-right { animation: slideInRight 0.5s ease-out forwards; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        /* Toast notification */
        .toast-enter { animation: slideInRight 0.4s ease-out; }
        .toast-leave { animation: slideInRight 0.3s ease-in reverse; }
        /* Bottom nav safe area */
        .pb-safe { padding-bottom: env(safe-area-inset-bottom, 0px); }
        /* Reading progress bar */
        #reading-progress { transition: width 0.1s linear; }
    </style>
    @stack('styles')
</head>
<body class="bg-stone-50 text-stone-800 antialiased flex flex-col min-h-screen font-sans selection:bg-emerald-600 selection:text-white" 
      x-data="{ 
          mobileMenuOpen: false, 
          moreMenuOpen: false,
          showBackToTop: false,
          scrolled: false,
          init() {
              window.addEventListener('scroll', () => {
                  this.showBackToTop = window.scrollY > 400;
                  this.scrolled = window.scrollY > 20;
              });
          }
      }">

    <!-- Reading Progress Bar -->
    <div id="reading-progress" class="fixed top-0 left-0 h-[3px] bg-gradient-to-r from-emerald-500 via-amber-400 to-emerald-500 z-[100] transition-all" style="width: 0%"></div>

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-emerald-950 via-green-900 to-stone-900 text-white text-[11px] sm:text-xs py-1.5 px-4 border-b border-emerald-800/30 hidden sm:block">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2 overflow-hidden">
                <span class="bg-amber-400 text-stone-950 text-[9px] font-black px-2 py-0.5 rounded-full uppercase tracking-wider flex items-center gap-1 flex-shrink-0">
                    <i class="fa-solid fa-compass"></i> RT 012
                </span>
                <div class="overflow-hidden">
                    <span class="inline-block whitespace-nowrap font-medium text-emerald-100">
                        Portal Resmi Unit Penghubung Warga RT 012 RW 05 — Edisi Jumanji
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-3 text-emerald-200 flex-shrink-0">
                <a href="{{ route('aspiration') }}" class="hover:text-amber-300 transition flex items-center gap-1">
                    <i class="fa-solid fa-bullhorn text-amber-400 text-[10px]"></i> Aspirasi
                </a>
                <span class="text-emerald-700">|</span>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-amber-300 hover:text-white font-bold flex items-center gap-1">
                        <i class="fa-solid fa-gauge text-[10px]"></i> Panel Pengurus
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-white transition flex items-center gap-1">
                        <i class="fa-solid fa-shield-cat text-emerald-400 text-[10px]"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <header class="sticky top-0 z-50 transition-all duration-300"
            :class="scrolled ? 'bg-white/95 backdrop-blur-xl shadow-lg shadow-stone-200/50 border-b border-stone-100' : 'bg-white/80 backdrop-blur-md border-b border-stone-200/60'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between transition-all duration-300" :class="scrolled ? 'h-16' : 'h-20'">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group flex-shrink-0">
                    <div class="relative">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo RT 12 RW 05" 
                             class="rounded-full object-cover border-2 border-emerald-600 shadow-md group-hover:scale-105 group-hover:border-amber-500 transition duration-300"
                             :class="scrolled ? 'w-9 h-9' : 'w-11 h-11'">
                        <span class="absolute -bottom-0.5 -right-0.5 bg-amber-400 text-stone-950 text-[7px] font-black px-1 rounded-full border border-white shadow">012</span>
                    </div>
                    <div>
                        <div class="font-black text-stone-900 tracking-tight leading-none group-hover:text-emerald-700 transition" :class="scrolled ? 'text-sm' : 'text-base'">
                            UNIT PENGHUBUNG <span class="text-emerald-700">WARGA</span>
                        </div>
                        <div class="text-[9px] font-extrabold text-amber-600 uppercase tracking-widest mt-0.5 flex items-center gap-1">
                            <span>RT 12 RW 05</span>
                            <span class="text-stone-300">•</span>
                            <span class="text-stone-400 font-semibold lowercase">jumanji</span>
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-0.5">
                    @php
                        $navItems = [
                            ['route' => 'home', 'label' => 'Beranda', 'check' => 'home'],
                            ['route' => 'about', 'label' => 'Profil', 'check' => 'about'],
                            ['route' => 'events.index', 'label' => 'Agenda', 'check' => 'events.*'],
                            ['route' => 'articles.index', 'label' => 'Berita', 'check' => 'articles.*'],
                            ['route' => 'gallery', 'label' => 'Galeri', 'check' => 'gallery'],
                        ];
                    @endphp
                    @foreach($navItems as $nav)
                        <a href="{{ route($nav['route']) }}" 
                           class="relative px-3 py-2 rounded-xl text-[13px] font-bold transition group
                                  {{ request()->routeIs($nav['check']) 
                                      ? 'text-emerald-800 bg-emerald-50/80' 
                                      : 'text-stone-600 hover:text-emerald-700 hover:bg-stone-50' }}">
                            {{ $nav['label'] }}
                            @if(request()->routeIs($nav['check']))
                                <span class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-5 h-0.5 bg-emerald-600 rounded-full"></span>
                            @endif
                        </a>
                    @endforeach
                    <a href="{{ route('hall-of-fame') }}" 
                       class="px-3 py-2 rounded-xl text-[13px] font-bold transition
                              {{ request()->routeIs('hall-of-fame') 
                                  ? 'text-amber-800 bg-amber-50/80' 
                                  : 'text-stone-600 hover:text-amber-700 hover:bg-amber-50/50' }}">
                        <i class="fa-solid fa-trophy text-amber-500 mr-1 text-[11px]"></i>Hall of Fame
                    </a>
                    <a href="{{ route('umkm.index') }}" 
                       class="px-3 py-2 rounded-xl text-[13px] font-bold transition
                              {{ request()->routeIs('umkm.*') 
                                  ? 'text-amber-800 bg-amber-50/80 font-black' 
                                  : 'text-stone-600 hover:text-amber-700 hover:bg-amber-50/50' }}">
                        <i class="fa-solid fa-basket-shopping text-amber-500 mr-1 text-[11px]"></i>Lapak UMKM
                    </a>
                    <a href="{{ route('aspiration') }}" 
                       class="px-3 py-2 rounded-xl text-[13px] font-bold transition
                              {{ request()->routeIs('aspiration') 
                                  ? 'text-emerald-800 bg-emerald-50/80' 
                                  : 'text-stone-600 hover:text-emerald-700 hover:bg-stone-50' }}">
                        Aspirasi
                    </a>
                </nav>

                <!-- Desktop CTA -->
                <div class="hidden lg:flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('youth.register') }}" 
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-700 to-green-700 hover:from-emerald-800 hover:to-green-800 text-white font-extrabold text-xs px-4 py-2.5 rounded-xl shadow-md shadow-emerald-700/20 transition duration-200 hover:-translate-y-0.5 border border-emerald-600/40">
                        <i class="fa-solid fa-compass text-amber-300 text-[11px]"></i>
                        <span>Sensus Pemuda</span>
                    </a>
                </div>

                <!-- Mobile Hamburger -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="lg:hidden p-2 rounded-xl text-stone-700 hover:text-emerald-700 hover:bg-stone-100 transition" aria-label="Menu">
                    <i class="fa-solid text-lg" :class="mobileMenuOpen ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Fullscreen Menu -->
        <div x-show="mobileMenuOpen" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="lg:hidden fixed inset-0 top-16 z-40 bg-white/98 backdrop-blur-xl overflow-y-auto pb-32">
            <div class="max-w-lg mx-auto px-6 py-8 space-y-2">
                @php
                    $mobileLinks = [
                        ['route' => 'home', 'icon' => 'fa-tree', 'label' => 'Beranda', 'desc' => 'Halaman utama', 'check' => 'home'],
                        ['route' => 'about', 'icon' => 'fa-users', 'label' => 'Profil & Struktur', 'desc' => 'Tentang organisasi', 'check' => 'about'],
                        ['route' => 'events.index', 'icon' => 'fa-calendar-check', 'label' => 'Agenda Kegiatan', 'desc' => 'Jadwal & acara', 'check' => 'events.*'],
                        ['route' => 'articles.index', 'icon' => 'fa-newspaper', 'label' => 'Berita & Info', 'desc' => 'Kabar terbaru', 'check' => 'articles.*'],
                        ['route' => 'gallery', 'icon' => 'fa-images', 'label' => 'Galeri Foto', 'desc' => 'Dokumentasi kegiatan', 'check' => 'gallery'],
                        ['route' => 'hall-of-fame', 'icon' => 'fa-trophy', 'label' => 'Hall of Fame', 'desc' => 'Prestasi & penghargaan', 'check' => 'hall-of-fame'],
                        ['route' => 'aspiration', 'icon' => 'fa-bullhorn', 'label' => 'Aspirasi Warga', 'desc' => 'Kirim saran & masukan', 'check' => 'aspiration'],
                    ];
                @endphp
                @foreach($mobileLinks as $i => $link)
                    <a href="{{ route($link['route']) }}" @click="mobileMenuOpen = false"
                       class="flex items-center gap-4 p-4 rounded-2xl transition duration-200
                              {{ request()->routeIs($link['check']) ? 'bg-emerald-50 border border-emerald-200' : 'hover:bg-stone-50 border border-transparent' }}"
                       style="animation: fadeInUp 0.4s ease-out {{ $i * 0.05 }}s both">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center text-base flex-shrink-0
                                    {{ request()->routeIs($link['check']) ? 'bg-emerald-600 text-white' : 'bg-stone-100 text-stone-600' }}">
                            <i class="fa-solid {{ $link['icon'] }}"></i>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-stone-900">{{ $link['label'] }}</div>
                            <div class="text-[11px] text-stone-400">{{ $link['desc'] }}</div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-stone-300 text-xs ml-auto"></i>
                    </a>
                @endforeach

                <div class="pt-4 border-t border-stone-100 space-y-3">
                    <a href="{{ route('youth.register') }}" @click="mobileMenuOpen = false"
                       class="flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-700 to-green-700 text-white font-bold py-3.5 px-6 rounded-2xl text-sm shadow-lg">
                        <i class="fa-solid fa-compass text-amber-300"></i> Sensus Pemuda RT 012
                    </a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center gap-2 bg-stone-900 text-white font-bold py-3 px-6 rounded-2xl text-sm">
                            <i class="fa-solid fa-gauge"></i> Panel Pengurus
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 bg-stone-100 text-stone-700 font-bold py-3 px-6 rounded-2xl text-sm">
                            <i class="fa-solid fa-shield-cat text-emerald-600"></i> Login Pengurus
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Notifications (Toast Style) -->
    <div class="fixed top-20 right-4 z-50 space-y-3 max-w-sm w-full pointer-events-none" style="max-width: 380px;">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                 x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-8"
                 class="pointer-events-auto bg-white border border-emerald-200 text-stone-800 px-5 py-4 rounded-2xl flex items-center gap-3 shadow-xl shadow-emerald-100/50">
                <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold flex-shrink-0">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-xs text-emerald-700">Berhasil!</div>
                    <div class="text-[11px] text-stone-600 mt-0.5 truncate">{{ session('success') }}</div>
                </div>
                <button @click="show = false" class="text-stone-400 hover:text-stone-600 p-1 flex-shrink-0"><i class="fa-solid fa-xmark text-xs"></i></button>
            </div>
        @endif

        @if(session('info'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 translate-x-8"
                 class="pointer-events-auto bg-white border border-stone-200 text-stone-800 px-5 py-4 rounded-2xl flex items-center gap-3 shadow-xl">
                <i class="fa-solid fa-circle-info text-emerald-600 text-lg flex-shrink-0"></i>
                <span class="text-sm font-medium flex-1">{{ session('info') }}</span>
                <button @click="show = false" class="text-stone-400 hover:text-stone-600 p-1 flex-shrink-0"><i class="fa-solid fa-xmark text-xs"></i></button>
            </div>
        @endif

        @if($errors->any())
            <div x-data="{ show: true }" x-show="show"
                 x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0"
                 class="pointer-events-auto bg-white border border-rose-200 text-stone-800 px-5 py-4 rounded-2xl shadow-xl">
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-circle-exclamation text-rose-500 text-lg mt-0.5 flex-shrink-0"></i>
                    <div class="flex-1">
                        <div class="font-bold text-xs text-rose-700">Mohon periksa kembali:</div>
                        <ul class="list-disc list-inside text-[11px] mt-1 space-y-0.5 text-rose-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button @click="show = false" class="text-stone-400 hover:text-stone-600 p-1 flex-shrink-0"><i class="fa-solid fa-xmark text-xs"></i></button>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow pb-20 lg:pb-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-stone-950 text-stone-300 pt-16 pb-8 border-t border-emerald-950 mt-16 hidden lg:block">
        <!-- Wave Separator -->
        <div class="relative -mt-16 mb-8">
            <svg viewBox="0 0 1440 60" class="w-full h-12 text-stone-950" preserveAspectRatio="none">
                <path fill="currentColor" d="M0,30 C360,60 720,0 1080,30 C1260,45 1380,35 1440,30 L1440,60 L0,60 Z"></path>
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-stone-800/60">
                
                <!-- About -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-11 h-11 rounded-full object-cover border-2 border-amber-400 shadow">
                        <div>
                            <div class="font-extrabold text-white text-sm tracking-tight">UNIT PENGHUBUNG WARGA</div>
                            <div class="text-[10px] font-bold text-amber-400">RT 12 RW 05 • Kelurahan Lenteng Agung</div>
                        </div>
                    </div>
                    <p class="text-xs text-stone-400 leading-relaxed max-w-sm">
                        Wadah persatuan, kreativitas, dan gotong royong pemuda-pemudi untuk menjaga keharmonisan dan kemajuan warga RT 012 RW 05.
                    </p>
                    <div class="flex items-center gap-2 pt-1">
                        <a href="#" class="w-9 h-9 rounded-xl bg-stone-900 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 text-stone-400 hover:text-white flex items-center justify-center transition duration-300 border border-stone-800 hover:border-transparent">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/6281412357231" target="_blank" class="w-9 h-9 rounded-xl bg-stone-900 hover:bg-emerald-600 text-stone-400 hover:text-white flex items-center justify-center transition duration-300 border border-stone-800 hover:border-transparent">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-xl bg-stone-900 hover:bg-red-600 text-stone-400 hover:text-white flex items-center justify-center transition duration-300 border border-stone-800 hover:border-transparent">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Navigation -->
                <div>
                    <h3 class="text-[10px] font-black text-amber-400 uppercase tracking-widest mb-4">Navigasi</h3>
                    <ul class="space-y-2 text-sm text-stone-400">
                        <li><a href="{{ route('home') }}" class="hover:text-emerald-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-emerald-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Profil</a></li>
                        <li><a href="{{ route('events.index') }}" class="hover:text-emerald-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Agenda</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-emerald-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Berita</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-emerald-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Galeri</a></li>
                        <li><a href="{{ route('hall-of-fame') }}" class="hover:text-amber-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Hall of Fame</a></li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h3 class="text-[10px] font-black text-amber-400 uppercase tracking-widest mb-4">Layanan</h3>
                    <ul class="space-y-2 text-sm text-stone-400">
                        <li><a href="{{ route('aspiration') }}" class="hover:text-emerald-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Kirim Aspirasi</a></li>
                        <li><a href="{{ route('youth.register') }}" class="hover:text-emerald-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Sensus Pemuda</a></li>
                        <li><a href="{{ route('events.index') }}" class="hover:text-emerald-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Jadwal Kerja Bakti</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-amber-400 transition inline-flex items-center gap-1.5"><i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>Portal Pengurus</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-[10px] font-black text-amber-400 uppercase tracking-widest mb-4">Sekretariat</h3>
                    <div class="space-y-3 text-xs text-stone-400">
                        <div class="flex items-start gap-2.5">
                            <i class="fa-solid fa-location-dot text-emerald-400 mt-0.5"></i>
                            <span>Jl. Raya Lenteng Agung, Gg. H. Saatun RT 012 RW 05, Kelurahan Lenteng Agung</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-phone text-amber-400"></i>
                            <span>0814-1235-7231 (Humas & RT)</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-envelope text-emerald-400"></i>
                            <span>katar012rw05@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-[11px] text-stone-500 gap-3">
                <div>&copy; {{ date('Y') }} Unit Penghubung Warga RT 12 RW 05 • Edisi Jumanji</div>
                <div class="flex items-center gap-1.5 text-stone-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Sistem Aktif
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation -->
    <nav class="lg:hidden fixed bottom-0 inset-x-0 z-50 bg-white/95 backdrop-blur-xl border-t border-stone-200/80 shadow-[0_-4px_20px_rgba(0,0,0,0.08)] pb-safe">
        <div class="grid grid-cols-5 h-16">
            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center gap-0.5 transition {{ request()->routeIs('home') ? 'text-emerald-700' : 'text-stone-400' }}">
                <i class="fa-solid fa-house text-[16px] {{ request()->routeIs('home') ? 'text-emerald-600' : '' }}"></i>
                <span class="text-[9px] font-bold">Beranda</span>
                @if(request()->routeIs('home'))<span class="w-4 h-0.5 bg-emerald-600 rounded-full mt-0.5"></span>@endif
            </a>
            <a href="{{ route('events.index') }}" class="flex flex-col items-center justify-center gap-0.5 transition {{ request()->routeIs('events.*') ? 'text-emerald-700' : 'text-stone-400' }}">
                <i class="fa-solid fa-calendar-days text-[16px] {{ request()->routeIs('events.*') ? 'text-emerald-600' : '' }}"></i>
                <span class="text-[9px] font-bold">Agenda</span>
                @if(request()->routeIs('events.*'))<span class="w-4 h-0.5 bg-emerald-600 rounded-full mt-0.5"></span>@endif
            </a>
            <a href="{{ route('articles.index') }}" class="flex flex-col items-center justify-center gap-0.5 transition {{ request()->routeIs('articles.*') ? 'text-emerald-700' : 'text-stone-400' }}">
                <i class="fa-solid fa-newspaper text-[16px] {{ request()->routeIs('articles.*') ? 'text-emerald-600' : '' }}"></i>
                <span class="text-[9px] font-bold">Berita</span>
                @if(request()->routeIs('articles.*'))<span class="w-4 h-0.5 bg-emerald-600 rounded-full mt-0.5"></span>@endif
            </a>
            <a href="{{ route('gallery') }}" class="flex flex-col items-center justify-center gap-0.5 transition {{ request()->routeIs('gallery') ? 'text-emerald-700' : 'text-stone-400' }}">
                <i class="fa-solid fa-images text-[16px] {{ request()->routeIs('gallery') ? 'text-emerald-600' : '' }}"></i>
                <span class="text-[9px] font-bold">Galeri</span>
                @if(request()->routeIs('gallery'))<span class="w-4 h-0.5 bg-emerald-600 rounded-full mt-0.5"></span>@endif
            </a>
            <button @click="moreMenuOpen = !moreMenuOpen" class="flex flex-col items-center justify-center gap-0.5 text-stone-400">
                <i class="fa-solid fa-ellipsis text-[16px]"></i>
                <span class="text-[9px] font-bold">Lainnya</span>
            </button>
        </div>

        <!-- More Menu Drawer -->
        <div x-show="moreMenuOpen" x-cloak @click.outside="moreMenuOpen = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0 opacity-100"
             x-transition:leave-end="translate-y-full opacity-0"
             class="absolute bottom-full left-0 right-0 bg-white border-t border-stone-200 rounded-t-3xl shadow-2xl p-6 space-y-2 mb-0">
            <div class="w-10 h-1 bg-stone-200 rounded-full mx-auto mb-4"></div>
            <a href="{{ route('about') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-stone-50 transition">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center"><i class="fa-solid fa-users text-sm"></i></div>
                <span class="font-bold text-sm text-stone-800">Profil & Struktur</span>
            </a>
            <a href="{{ route('hall-of-fame') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-stone-50 transition">
                <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center"><i class="fa-solid fa-trophy text-sm"></i></div>
                <span class="font-bold text-sm text-stone-800">Hall of Fame</span>
            </a>
            <a href="{{ route('umkm.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-stone-50 transition">
                <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center"><i class="fa-solid fa-basket-shopping text-sm"></i></div>
                <div class="flex items-center justify-between flex-1">
                    <span class="font-bold text-sm text-stone-800">Lapak UMKM Warga</span>
                    <span class="text-[9px] bg-amber-400 text-stone-950 font-black px-1.5 py-0.5 rounded uppercase">Pasar</span>
                </div>
            </a>
            <a href="{{ route('aspiration') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-stone-50 transition">
                <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center"><i class="fa-solid fa-bullhorn text-sm"></i></div>
                <span class="font-bold text-sm text-stone-800">Aspirasi Warga</span>
            </a>
            <a href="{{ route('youth.register') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-stone-50 transition">
                <div class="w-9 h-9 rounded-lg bg-green-50 text-green-600 flex items-center justify-center"><i class="fa-solid fa-compass text-sm"></i></div>
                <span class="font-bold text-sm text-stone-800">Sensus Pemuda</span>
            </a>

            <!-- PWA Install Button inside Drawer -->
            <button type="button" @click="moreMenuOpen = false; triggerPwaInstall()" class="w-full flex items-center gap-3 p-3 rounded-xl bg-gradient-to-r from-amber-500/15 via-emerald-500/10 to-transparent border border-amber-400/40 text-stone-900 text-left hover:bg-amber-100/50 transition mt-1">
                <div class="w-9 h-9 rounded-lg bg-amber-500 text-stone-950 flex items-center justify-center font-black shadow-sm">
                    <i class="fa-solid fa-mobile-screen-button text-sm"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="font-black text-xs text-stone-900 flex items-center gap-1.5">
                        <span>Pasang Aplikasi RT 12</span>
                        <span class="text-[9px] bg-amber-400 text-stone-950 px-1 py-0.2 rounded font-black uppercase">App</span>
                    </div>
                    <div class="text-[10px] text-stone-500 font-medium">Buka langsung dari layar utama HP</div>
                </div>
            </button>
            @auth
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-stone-50 transition border-t border-stone-100 mt-2 pt-4">
                <div class="w-9 h-9 rounded-lg bg-stone-900 text-white flex items-center justify-center"><i class="fa-solid fa-gauge text-sm"></i></div>
                <span class="font-bold text-sm text-stone-800">Panel Pengurus</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-stone-50 transition border-t border-stone-100 mt-2 pt-4">
                <div class="w-9 h-9 rounded-lg bg-stone-100 text-stone-600 flex items-center justify-center"><i class="fa-solid fa-shield-cat text-sm"></i></div>
                <span class="font-bold text-sm text-stone-800">Login Pengurus</span>
            </a>
            @endauth
        </div>
    </nav>

    <!-- Back to Top -->
    <button x-show="showBackToTop" x-cloak
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-75"
            @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-24 lg:bottom-8 right-4 z-40 w-11 h-11 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl shadow-lg shadow-emerald-700/30 flex items-center justify-center transition hover:-translate-y-1">
        <i class="fa-solid fa-arrow-up text-sm"></i>
    </button>

    <!-- Reading Progress Script -->
    <script>
        window.addEventListener('scroll', () => {
            const bar = document.getElementById('reading-progress');
            if (!bar) return;
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const width = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            bar.style.width = width + '%';
        });
    </script>

    <!-- PWA Install Banner & Modals -->
    <div id="pwa-install-banner" class="hidden fixed bottom-20 lg:bottom-6 left-4 right-4 max-w-md mx-auto z-50 bg-stone-900/95 backdrop-blur-md text-white border border-amber-400/30 rounded-2xl p-4 shadow-2xl animate-fade-in">
        <div class="flex items-start gap-3">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo RT 12" class="w-11 h-11 rounded-xl object-cover ring-2 ring-amber-400/60 shadow flex-shrink-0">
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-1.5">
                    <span class="font-black text-xs text-white">Pasang Aplikasi RT 12</span>
                    <span class="text-[9px] bg-emerald-500 text-stone-950 font-black px-1.5 py-0.2 rounded-full uppercase">Resmi</span>
                </div>
                <p class="text-[11px] text-stone-300 mt-0.5 leading-snug">
                    Pasang di layar HP Anda untuk akses instan kegiatan, darurat SOS & warta tanpa buka browser.
                </p>
                <div class="flex items-center gap-2 mt-2.5">
                    <button id="pwa-install-btn" type="button" class="px-3 py-1.5 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-stone-950 text-xs font-black rounded-lg shadow transition flex items-center gap-1.5">
                        <i class="fa-solid fa-download text-[11px]"></i>
                        <span>Pasang Sekarang</span>
                    </button>
                    <button id="pwa-dismiss-btn" type="button" class="px-2.5 py-1.5 text-stone-400 hover:text-white text-xs font-semibold">
                        Nanti Saja
                    </button>
                </div>
            </div>
            <button id="pwa-close-btn" type="button" class="text-stone-400 hover:text-stone-200 text-xs p-1">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>

    <!-- iOS Install Instruction Modal -->
    <div id="pwa-ios-modal" class="hidden fixed inset-0 z-50 bg-black/75 backdrop-blur-sm flex items-end sm:items-center justify-center p-4">
        <div class="bg-stone-900 text-white border border-stone-800 rounded-3xl max-w-sm w-full p-6 space-y-4 shadow-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo RT 12" class="w-9 h-9 rounded-xl object-cover ring-1 ring-amber-400">
                    <div>
                        <h4 class="font-extrabold text-sm text-white">Pasang di iPhone / iPad</h4>
                        <p class="text-[10px] text-amber-400 font-bold uppercase">Panduan Safari iOS</p>
                    </div>
                </div>
                <button onclick="document.getElementById('pwa-ios-modal').classList.add('hidden')" class="text-stone-400 hover:text-white p-1">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <p class="text-xs text-stone-300 leading-relaxed">
                Di Safari iOS, Anda dapat memasang web ini menjadi aplikasi dengan 2 langkah mudah:
            </p>
            <div class="space-y-2.5 text-xs text-stone-200">
                <div class="flex items-center gap-3 p-2.5 rounded-xl bg-stone-800/80 border border-stone-700/60">
                    <div class="w-7 h-7 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center font-black text-sm flex-shrink-0">
                        1
                    </div>
                    <span>Ketuk tombol <strong>Bagikan (Share)</strong> <i class="fa-solid fa-arrow-up-from-bracket text-blue-400 mx-1"></i> di bilah bawah Safari.</span>
                </div>
                <div class="flex items-center gap-3 p-2.5 rounded-xl bg-stone-800/80 border border-stone-700/60">
                    <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-black text-sm flex-shrink-0">
                        2
                    </div>
                    <span>Gulir ke bawah dan pilih <strong>"Tambahkan ke Layar Utama" (Add to Home Screen)</strong> 📲.</span>
                </div>
            </div>
            <button onclick="document.getElementById('pwa-ios-modal').classList.add('hidden')" class="w-full py-2.5 bg-amber-400 text-stone-950 font-black rounded-xl text-xs hover:bg-amber-300 transition">
                Mengerti
            </button>
        </div>
    </div>

    <!-- PWA Service Worker & Install Logic -->
    <script>
        let deferredPrompt = null;
        const banner = document.getElementById('pwa-install-banner');
        const installBtn = document.getElementById('pwa-install-btn');
        const dismissBtn = document.getElementById('pwa-dismiss-btn');
        const closeBtn = document.getElementById('pwa-close-btn');
        const iosModal = document.getElementById('pwa-ios-modal');

        const isIos = () => {
            const userAgent = window.navigator.userAgent.toLowerCase();
            return /iphone|ipad|ipod/.test(userAgent);
        };

        const isInStandaloneMode = () => {
            return ('standalone' in window.navigator && window.navigator.standalone) ||
                   window.matchMedia('(display-mode: standalone)').matches;
        };

        // Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(reg => {
                        console.log('[PWA] Service Worker terdaftar dengan scope:', reg.scope);
                    })
                    .catch(err => {
                        console.warn('[PWA] Gagal mendaftarkan Service Worker:', err);
                    });
            });
        }

        // Capture Android/Chrome Install Prompt
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;

            // Check if dismissed recently (within 5 days)
            const dismissedAt = localStorage.getItem('pwa_dismissed_at');
            const now = Date.now();
            if (!dismissedAt || (now - parseInt(dismissedAt)) > (5 * 24 * 60 * 60 * 1000)) {
                if (!isInStandaloneMode() && banner) {
                    banner.classList.remove('hidden');
                }
            }
        });

        // Track when successfully installed
        window.addEventListener('appinstalled', () => {
            console.log('[PWA] Aplikasi RT 12 sukses terpasang!');
            if (banner) banner.classList.add('hidden');
            deferredPrompt = null;
        });

        // Dismiss handlers
        function dismissBanner() {
            if (banner) banner.classList.add('hidden');
            localStorage.setItem('pwa_dismissed_at', Date.now().toString());
        }

        if (dismissBtn) dismissBtn.addEventListener('click', dismissBanner);
        if (closeBtn) closeBtn.addEventListener('click', dismissBanner);

        // Global function to trigger install anywhere
        window.triggerPwaInstall = function() {
            if (isInStandaloneMode()) {
                alert('Aplikasi Unit Penghubung Warga RT 12 RW 05 sudah terpasang di perangkat Anda!');
                return;
            }

            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === 'accepted') {
                        console.log('[PWA] Warga menerima pemasangan aplikasi');
                    }
                    deferredPrompt = null;
                    if (banner) banner.classList.add('hidden');
                });
            } else if (isIos()) {
                if (iosModal) iosModal.classList.remove('hidden');
            } else {
                // Generic fallback instruction
                alert('Untuk memasang aplikasi ini di layar utama:\n\n1. Ketuk ikon titik tiga (⋮) di pojok kanan atas browser\n2. Pilih "Tambahkan ke Layar Utama" atau "Install Aplikasi"');
            }
        };

        if (installBtn) {
            installBtn.addEventListener('click', window.triggerPwaInstall);
        }
    </script>

    @stack('scripts')
</body>
</html>
