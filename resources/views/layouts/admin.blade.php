<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Unit Penghubung Warga RT 12 RW 05')</title>

    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpg') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#064e3b">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        jungle: {
                            800: '#064e3b',
                            900: '#022c22',
                            950: '#011c16',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        /* Custom sleek scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(16, 185, 129, 0.3);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(16, 185, 129, 0.6);
        }
    </style>
</head>
<body class="bg-stone-100 font-sans antialiased text-stone-800" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar Backdrop for Mobile -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-stone-950/70 backdrop-blur-sm lg:hidden"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-stone-950 via-stone-900 to-stone-950 text-white transition-transform duration-200 ease-in-out lg:static lg:translate-x-0 flex flex-col justify-between border-r border-stone-800/80 shadow-2xl">
            
            <div class="flex flex-col h-full overflow-hidden">
                
                <!-- Brand Header with Logo -->
                <div class="p-5 border-b border-stone-800/80 bg-black/40">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                        <div class="relative">
                            <img src="{{ asset('images/logo.jpg') }}" alt="Logo RT 12 RW 05" class="w-11 h-11 rounded-2xl object-cover ring-2 ring-amber-400/60 shadow-lg shadow-amber-400/20 group-hover:scale-105 transition-transform duration-200">
                            <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 border-2 border-stone-950 rounded-full"></span>
                        </div>
                        <div class="overflow-hidden">
                            <div class="flex items-center gap-1.5">
                                <span class="font-black text-sm tracking-tight text-white group-hover:text-amber-400 transition">RT 12 RW 05</span>
                                <span class="text-[9px] font-black uppercase px-1.5 py-0.5 rounded bg-amber-400/20 text-amber-300 border border-amber-400/30">Panel</span>
                            </div>
                            <div class="text-[10px] text-stone-400 font-semibold truncate mt-0.5">Unit Penghubung Warga</div>
                        </div>
                    </a>

                    <!-- User Mini Profile Card -->
                    <div class="mt-4 p-3 rounded-2xl bg-stone-900/90 border border-stone-800 flex items-center justify-between">
                        <div class="flex items-center gap-2.5 overflow-hidden">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center font-black text-white text-xs shadow-md">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="overflow-hidden">
                                <div class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] font-semibold text-emerald-400 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span>{{ Auth::user()->role_badge }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 px-4 py-4 space-y-1 text-xs font-bold overflow-y-auto custom-scrollbar">
                    
                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-gauge-high w-5 text-center text-amber-400"></i>
                            <span>Dashboard Utama</span>
                        </div>
                        @if(request()->routeIs('admin.dashboard'))
                            <i class="fa-solid fa-chevron-right text-[10px] text-emerald-300"></i>
                        @endif
                    </a>

                    {{-- Konten Website --}}
                    @if(Auth::user()->hasAccessTo('articles') || Auth::user()->hasAccessTo('events') || Auth::user()->hasAccessTo('galleries'))
                        <div class="pt-4 pb-1.5 px-3 text-[10px] font-black uppercase tracking-wider text-stone-500 flex items-center justify-between">
                            <span>Publikasi Website</span>
                            <span class="w-1 h-1 rounded-full bg-stone-600"></span>
                        </div>

                        @if(Auth::user()->hasAccessTo('articles'))
                            <a href="{{ route('admin.articles.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.articles.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-regular fa-newspaper w-5 text-center"></i>
                                    <span>Berita & Artikel</span>
                                </div>
                            </a>
                        @endif

                        @if(Auth::user()->hasAccessTo('events'))
                            <a href="{{ route('admin.events.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.events.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-regular fa-calendar-check w-5 text-center"></i>
                                    <span>Agenda Kegiatan</span>
                                </div>
                            </a>
                        @endif

                        @if(Auth::user()->hasAccessTo('galleries'))
                            <a href="{{ route('admin.galleries.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.galleries.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-regular fa-images w-5 text-center"></i>
                                    <span>Galeri Dokumentasi</span>
                                </div>
                            </a>
                        @endif
                    @endif

                    {{-- Warga & Pemuda --}}
                    @if(Auth::user()->hasAccessTo('aspirations') || Auth::user()->hasAccessTo('youth') || Auth::user()->hasAccessTo('structures'))
                        <div class="pt-4 pb-1.5 px-3 text-[10px] font-black uppercase tracking-wider text-stone-500 flex items-center justify-between">
                            <span>Warga & Pemuda</span>
                            <span class="w-1 h-1 rounded-full bg-stone-600"></span>
                        </div>

                        @if(Auth::user()->hasAccessTo('aspirations'))
                            @php
                                $pendingAsp = \App\Models\Aspiration::where('status', 'Menunggu Ditinjau')->count();
                            @endphp
                            <a href="{{ route('admin.aspirations.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.aspirations.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-bullhorn w-5 text-center"></i>
                                    <span>Aspirasi Warga</span>
                                </div>
                                @if($pendingAsp > 0)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-black bg-amber-500 text-stone-950 shadow-sm animate-pulse">
                                        {{ $pendingAsp }}
                                    </span>
                                @endif
                            </a>
                        @endif

                        @if(Auth::user()->hasAccessTo('youth'))
                            <a href="{{ route('admin.youth.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.youth.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-address-book w-5 text-center"></i>
                                    <span>Database Pemuda</span>
                                </div>
                            </a>
                        @endif

                        @if(Auth::user()->hasAccessTo('structures'))
                            <a href="{{ route('admin.structures.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.structures.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-sitemap w-5 text-center"></i>
                                    <span>Struktur Pengurus</span>
                                </div>
                            </a>
                        @endif

                        @if(Auth::user()->hasAccessTo('umkm'))
                            <a href="{{ route('admin.umkm.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.umkm.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-basket-shopping w-5 text-center text-amber-400"></i>
                                    <span>Lapak UMKM Warga</span>
                                </div>
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-black bg-amber-500/20 text-amber-300 border border-amber-400/30">
                                    {{ \App\Models\Business::count() }}
                                </span>
                            </a>
                        @endif
                    @endif

                    {{-- Keuangan & Donasi --}}
                    @if(Auth::user()->hasAccessTo('finances'))
                        <div class="pt-4 pb-1.5 px-3 text-[10px] font-black uppercase tracking-wider text-stone-500 flex items-center justify-between">
                            <span>Keuangan & Kas</span>
                            <span class="w-1 h-1 rounded-full bg-stone-600"></span>
                        </div>

                        <a href="{{ route('admin.finances.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.finances.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-coins w-5 text-center text-amber-400"></i>
                                <span>Kas & Anggaran 17-an</span>
                            </div>
                        </a>
                    @endif

                    {{-- Aset & Perlengkapan --}}
                    @if(Auth::user()->hasAccessTo('inventory'))
                        <div class="pt-4 pb-1.5 px-3 text-[10px] font-black uppercase tracking-wider text-stone-500 flex items-center justify-between">
                            <span>Logistik & Aset</span>
                            <span class="w-1 h-1 rounded-full bg-stone-600"></span>
                        </div>

                        <a href="{{ route('admin.inventory.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.inventory.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-boxes-stacked w-5 text-center text-amber-400"></i>
                                <span>Inventaris Barang</span>
                            </div>
                        </a>
                    @endif

                    {{-- Apresiasi --}}
                    @if(Auth::user()->hasAccessTo('hall_of_fame'))
                        <div class="pt-4 pb-1.5 px-3 text-[10px] font-black uppercase tracking-wider text-stone-500 flex items-center justify-between">
                            <span>Apresiasi Warga</span>
                            <span class="w-1 h-1 rounded-full bg-stone-600"></span>
                        </div>

                        <a href="{{ route('admin.hall-of-fame.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.hall-of-fame.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-trophy w-5 text-center text-amber-400"></i>
                                <span>Hall of Fame</span>
                            </div>
                        </a>
                    @endif

                    {{-- Manajemen Sistem & Keamanan --}}
                    @if(Auth::user()->hasAccessTo('users') || Auth::user()->hasAccessTo('activity_logs'))
                        <div class="pt-4 pb-1.5 px-3 text-[10px] font-black uppercase tracking-wider text-stone-500 flex items-center justify-between">
                            <span>Keamanan & Sistem</span>
                            <span class="w-1 h-1 rounded-full bg-stone-600"></span>
                        </div>

                        @if(Auth::user()->hasAccessTo('users'))
                            <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-users-gear w-5 text-center text-amber-400"></i>
                                    <span>Akun Pengurus</span>
                                </div>
                            </a>
                        @endif

                        @if(Auth::user()->hasAccessTo('activity_logs'))
                            <a href="{{ route('admin.activity-logs.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.activity-logs.*') ? 'bg-gradient-to-r from-emerald-600 to-emerald-700 text-white shadow-lg shadow-emerald-950/60 font-black' : 'text-stone-400 hover:text-white hover:bg-stone-900/80' }}">
                                <div class="flex items-center gap-3">
                                    <i class="fa-solid fa-clock-rotate-left w-5 text-center text-amber-400"></i>
                                    <span>Log Aktivitas</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30">
                                    Admin
                                </span>
                            </a>
                        @endif
                    @endif
                </nav>

                <!-- Bottom User & Exit -->
                <div class="p-4 border-t border-stone-800/80 bg-black/40 space-y-2">
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2.5 px-3 rounded-xl bg-stone-900 hover:bg-emerald-950/50 hover:text-emerald-300 text-stone-300 text-xs font-bold border border-stone-800 hover:border-emerald-600/50 transition">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                        <span>Lihat Portal Publik</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center justify-center gap-2 w-full py-2.5 px-3 rounded-xl bg-rose-950/30 hover:bg-rose-600 text-rose-300 hover:text-white text-xs font-bold border border-rose-900/40 hover:border-rose-600 transition">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Keluar (Logout)</span>
                        </button>
                    </form>
                </div>

            </div>

        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Sleek Topbar -->
            <header class="h-20 bg-white/90 backdrop-blur-md border-b border-stone-200/80 px-6 flex items-center justify-between shadow-sm z-10 sticky top-0">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2.5 rounded-xl text-stone-600 hover:bg-stone-100 hover:text-stone-900 transition">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                    <div>
                        <div class="flex items-center gap-2 text-stone-400 text-[11px] font-semibold">
                            <span>Panel Pengurus</span>
                            <span>/</span>
                            <span class="text-emerald-700 font-bold">@yield('page_title', 'Dashboard')</span>
                        </div>
                        <h1 class="text-lg font-black text-stone-900 leading-tight">@yield('page_title', 'Dashboard')</h1>
                    </div>
                </div>

                <div class="flex items-center gap-3 sm:gap-5">
                    
                    <!-- Live Time & Status Indicator (WIB) -->
                    <div class="hidden md:flex items-center gap-3 pl-4 border-l border-stone-200">
                        <div class="text-right">
                            <div class="text-[11px] font-black text-stone-800 tracking-tight" id="live-wib-clock">
                                {{ now()->isoFormat('dddd, D MMMM Y • HH:mm') }} WIB
                            </div>
                            <div class="flex items-center justify-end gap-1.5 text-[10px] text-emerald-600 font-bold">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Sistem Berjalan Normal</span>
                            </div>
                        </div>
                    </div>

                    <!-- User Pill -->
                    <div class="flex items-center gap-2.5 pl-3 border-l border-stone-200">
                        <div class="text-right hidden sm:block">
                            <div class="text-xs font-black text-stone-900 leading-none">{{ Auth::user()->name }}</div>
                            <div class="mt-1">
                                <span class="text-[9px] font-black px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300">
                                    {{ Auth::user()->role_badge }}
                                </span>
                            </div>
                        </div>
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo RT 12" class="w-10 h-10 rounded-xl object-cover ring-2 ring-emerald-600/30 shadow-sm">
                    </div>

                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 custom-scrollbar">
                
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-300 text-emerald-950 px-5 py-3.5 rounded-2xl flex items-center justify-between text-xs font-medium shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div>
                                <div class="font-black text-emerald-900">Operasi Berhasil</div>
                                <div class="text-emerald-700 mt-0.5">{{ session('success') }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-gradient-to-r from-rose-50 to-red-50 border border-rose-300 text-rose-950 px-5 py-3.5 rounded-2xl flex items-center justify-between text-xs font-medium shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold text-sm shadow-sm">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <div>
                                <div class="font-black text-rose-900">Perhatian / Gagal</div>
                                <div class="text-rose-700 mt-0.5">{{ session('error') }}</div>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>

        </div>

    </div>

    <!-- Live Clock Script -->
    <script>
        function updateWIBClock() {
            const el = document.getElementById('live-wib-clock');
            if (!el) return;
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            
            const dayName = days[now.getDay()];
            const date = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();
            
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            el.innerHTML = `${dayName}, ${date} ${monthName} ${year} • ${hours}:${minutes}:${seconds} WIB`;
        }
        setInterval(updateWIBClock, 1000);
    </script>
</body>
</html>