@extends('layouts.admin')

@section('title', 'Dashboard Komando - Unit Penghubung Warga RT 12 RW 05')
@section('page_title', 'Ringkasan Eksekutif')

@section('content')
<div class="space-y-8">
    
    <!-- 1. Executive Hero Welcome Banner (Jumanji Command Center) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-950 via-stone-900 to-stone-950 p-6 sm:p-8 text-white border border-emerald-900/40 shadow-xl">
        <!-- Ambient decorative glow -->
        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-compass text-amber-400"></i>
                    <span>Pusat Komando & Tata Kelola Operasional</span>
                </div>

                @php
                    $hour = (int) now()->format('H');
                    if ($hour >= 5 && $hour < 11) {
                        $salam = 'Selamat Pagi';
                    } elseif ($hour >= 11 && $hour < 15) {
                        $salam = 'Selamat Siang';
                    } elseif ($hour >= 15 && $hour < 18) {
                        $salam = 'Selamat Sore';
                    } else {
                        $salam = 'Selamat Malam';
                    }
                @endphp

                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    {{ $salam }}, <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300">{{ Auth::user()->name }}</span>!
                </h1>

                <p class="text-xs sm:text-sm text-stone-300 font-medium max-w-2xl leading-relaxed">
                    Selamat datang di Portal Komando Unit Penghubung Warga RT 12 RW 05. Pantau aspirasi warga, kelola program kerja, transparansi kas, dan pantau log aktivitas pengurus secara terintegrasi.
                </p>
            </div>

            <!-- Quick Action Dock -->
            <div class="flex flex-wrap items-center gap-2.5">
                @if(Auth::user()->hasAccessTo('articles'))
                    <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-black shadow-lg shadow-emerald-950/50 transition transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Tulis Berita</span>
                    </a>
                @endif

                @if(Auth::user()->hasAccessTo('events'))
                    <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-black shadow-lg shadow-blue-950/50 transition transform hover:-translate-y-0.5">
                        <i class="fa-regular fa-calendar-plus text-[10px]"></i>
                        <span>Agenda Baru</span>
                    </a>
                @endif

                @if(Auth::user()->hasAccessTo('finances'))
                    <a href="{{ route('admin.finances.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-stone-950 text-xs font-black shadow-lg shadow-amber-950/50 transition transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-receipt text-[10px]"></i>
                        <span>Catat Transaksi</span>
                    </a>
                @endif

                @if(Auth::user()->hasAccessTo('inventory'))
                    <a href="{{ route('admin.inventory.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-stone-800 hover:bg-stone-700 text-stone-200 hover:text-white text-xs font-black border border-stone-700 transition">
                        <i class="fa-solid fa-box-archive text-[10px]"></i>
                        <span>Aset Baru</span>
                    </a>
                @endif

                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-black border border-white/20 transition">
                    <i class="fa-solid fa-globe text-[10px]"></i>
                    <span>Web Publik</span>
                </a>
            </div>

        </div>
    </div>

    <!-- 2. Modern Metric KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        
        <!-- Sensus Pemuda -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm hover:shadow-md transition-shadow group flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-black uppercase tracking-wider text-stone-400">Pemuda RT 12</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-3xl font-black text-stone-900 tracking-tight">{{ $stats['total_youth'] }}</div>
                <div class="flex items-center justify-between mt-1 pt-2 border-t border-stone-100">
                    @if(Auth::user()->hasAccessTo('youth'))
                        <a href="{{ route('admin.youth.index') }}" class="text-[11px] font-black text-emerald-600 hover:text-emerald-700 hover:underline flex items-center gap-1">
                            <span>Database Pemuda</span>
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    @else
                        <span class="text-[10px] text-stone-400 font-medium">Sensus Terdaftar</span>
                    @endif
                    <span class="text-[10px] font-bold text-stone-400">Jiwa</span>
                </div>
            </div>
        </div>

        <!-- Aspirasi Warga -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm hover:shadow-md transition-shadow group flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-black uppercase tracking-wider text-stone-400">Aspirasi Masuk</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="flex items-baseline gap-2">
                    <div class="text-3xl font-black text-stone-900 tracking-tight">{{ $stats['total_aspirations'] }}</div>
                    @if($stats['pending_aspirations'] > 0)
                        <span class="px-2 py-0.5 rounded-full text-[9px] font-black bg-amber-100 text-amber-800 border border-amber-300 animate-pulse">
                            {{ $stats['pending_aspirations'] }} Baru
                        </span>
                    @endif
                </div>
                <div class="flex items-center justify-between mt-1 pt-2 border-t border-stone-100">
                    @if(Auth::user()->hasAccessTo('aspirations'))
                        <a href="{{ route('admin.aspirations.index') }}" class="text-[11px] font-black text-amber-600 hover:text-amber-700 hover:underline flex items-center gap-1">
                            <span>Tinjau Pesan</span>
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    @else
                        <span class="text-[10px] text-stone-400 font-medium">Suara Warga</span>
                    @endif
                    <span class="text-[10px] font-bold text-stone-400">Total</span>
                </div>
            </div>
        </div>

        <!-- Saldo Kas 17-an & RT -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm hover:shadow-md transition-shadow group flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-black uppercase tracking-wider text-stone-400">Saldo Kas RT</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-vault"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-xl font-black text-emerald-700 tracking-tight truncate">
                    Rp {{ number_format($stats['kas_balance'], 0, ',', '.') }}
                </div>
                <div class="flex items-center justify-between mt-1 pt-2 border-t border-stone-100">
                    @if(Auth::user()->hasAccessTo('finances'))
                        <a href="{{ route('admin.finances.index') }}" class="text-[11px] font-black text-emerald-700 hover:text-emerald-800 hover:underline flex items-center gap-1">
                            <span>Kelola Buku Kas</span>
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    @else
                        <span class="text-[10px] text-stone-400 font-medium">Khusus Bendahara</span>
                    @endif
                    <span class="text-[9px] font-black px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800">Netto</span>
                </div>
            </div>
        </div>

        <!-- Logistik & Inventaris -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm hover:shadow-md transition-shadow group flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-black uppercase tracking-wider text-stone-400">Aset Inventaris</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-3xl font-black text-stone-900 tracking-tight">
                    {{ $stats['total_inventory'] }} <span class="text-xs font-semibold text-stone-400">unit</span>
                </div>
                <div class="flex items-center justify-between mt-1 pt-2 border-t border-stone-100">
                    @if(Auth::user()->hasAccessTo('inventory'))
                        <a href="{{ route('admin.inventory.index') }}" class="text-[11px] font-black text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                            <span>{{ $stats['total_inventory_types'] }} Macam Alat</span>
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    @else
                        <span class="text-[10px] text-stone-400 font-medium">{{ $stats['total_inventory_types'] }} Kategori</span>
                    @endif
                    <span class="text-[10px] font-bold text-stone-400">Gudang</span>
                </div>
            </div>
        </div>

        <!-- Agenda & Proker -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm hover:shadow-md transition-shadow group flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-black uppercase tracking-wider text-stone-400">Agenda Kegiatan</span>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-3xl font-black text-stone-900 tracking-tight">{{ $stats['total_events'] }}</div>
                <div class="flex items-center justify-between mt-1 pt-2 border-t border-stone-100">
                    @if(Auth::user()->hasAccessTo('events'))
                        <a href="{{ route('admin.events.index') }}" class="text-[11px] font-black text-purple-600 hover:text-purple-700 hover:underline flex items-center gap-1">
                            <span>Jadwal Proker</span>
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    @else
                        <span class="text-[10px] text-stone-400 font-medium">Program Kerja</span>
                    @endif
                    <span class="text-[10px] font-bold text-stone-400">Acara</span>
                </div>
            </div>
        </div>

        <!-- Hall of Fame & Tokoh -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm hover:shadow-md transition-shadow group flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-black uppercase tracking-wider text-stone-400">Hall of Fame</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-trophy"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="text-3xl font-black text-stone-900 tracking-tight">{{ $stats['total_honorees'] }}</div>
                <div class="flex items-center justify-between mt-1 pt-2 border-t border-stone-100">
                    @if(Auth::user()->hasAccessTo('hall_of_fame'))
                        <a href="{{ route('admin.hall-of-fame.index') }}" class="text-[11px] font-black text-amber-600 hover:text-amber-700 hover:underline flex items-center gap-1">
                            <span>Tokoh & Juara</span>
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    @else
                        <span class="text-[10px] text-stone-400 font-medium">Tokoh Warga</span>
                    @endif
                    <span class="text-[10px] font-bold text-stone-400">Profil</span>
                </div>
            </div>
        </div>

    </div>

    <!-- 3. Operations & Financial Command Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Radar Transparansi Keuangan (5 cols) -->
        <div class="lg:col-span-5 bg-white rounded-3xl border border-stone-200/80 shadow-sm p-6 flex flex-col justify-between space-y-5">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-stone-900 text-sm tracking-tight">Kesehatan Kas & Transparansi</h3>
                            <p class="text-[11px] text-stone-400 font-semibold">Alokasi & Perputaran Dana RT 12</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-300">
                        🟢 Sehat
                    </span>
                </div>

                <!-- Balance Display -->
                <div class="p-4 rounded-2xl bg-gradient-to-br from-emerald-50 via-teal-50 to-stone-50 border border-emerald-200/60">
                    <div class="text-[11px] font-bold text-emerald-900 uppercase tracking-wider">Saldo Bersih Saat Ini</div>
                    <div class="text-2xl sm:text-3xl font-black text-emerald-800 mt-1">
                        Rp {{ number_format($stats['kas_balance'], 0, ',', '.') }}
                    </div>
                    <div class="text-[10px] text-emerald-700 font-medium mt-1">
                        Diaudit & tercatat rapi di buku kas organisasi RT 12 RW 05.
                    </div>
                </div>

                <!-- Visual Ratio Bar -->
                @php
                    $inc = $stats['total_income'] ?? 0;
                    $exp = $stats['total_expense'] ?? 0;
                    $sum = ($inc + $exp) > 0 ? ($inc + $exp) : 1;
                    $incPct = round(($inc / $sum) * 100);
                    $expPct = 100 - $incPct;
                @endphp

                <div class="mt-4 space-y-2">
                    <div class="flex items-center justify-between text-xs font-bold">
                        <div class="flex items-center gap-1.5 text-emerald-700">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span>Pemasukan: Rp {{ number_format($inc, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-rose-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                            <span>Pengeluaran: Rp {{ number_format($exp, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Progress Multi-color Bar -->
                    <div class="w-full h-3 bg-stone-100 rounded-full overflow-hidden flex">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-full" style="width: {{ $incPct }}%"></div>
                        <div class="bg-gradient-to-r from-rose-500 to-amber-500 h-full" style="width: {{ $expPct }}%"></div>
                    </div>
                </div>
            </div>

            <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-xs">
                <span class="text-stone-400 text-[11px] font-semibold">Modul Bendahara Kas</span>
                @if(Auth::user()->hasAccessTo('finances'))
                    <a href="{{ route('admin.finances.index') }}" class="font-black text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                        <span>Buka Rincian Buku Kas</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                @else
                    <span class="text-stone-400 text-[10px]">Terproteksi Hak Akses</span>
                @endif
            </div>
        </div>

        <!-- Agenda & Jadwal Terdekat (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-3xl border border-stone-200/80 shadow-sm p-6 flex flex-col justify-between space-y-5">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-purple-100 text-purple-800 flex items-center justify-center text-sm font-bold">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-stone-900 text-sm tracking-tight">Agenda & Program Kerja Mendatang</h3>
                            <p class="text-[11px] text-stone-400 font-semibold">Jadwal kegiatan terdekat di lingkungan RT 12</p>
                        </div>
                    </div>
                    @if(Auth::user()->hasAccessTo('events'))
                        <a href="{{ route('admin.events.index') }}" class="text-xs font-black text-purple-600 hover:text-purple-800 flex items-center gap-1">
                            <span>Semua Agenda</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    @endif
                </div>

                <div class="space-y-3">
                    @forelse($upcomingEvents as $evt)
                        <div class="p-3.5 rounded-2xl bg-stone-50 border border-stone-200/70 hover:bg-stone-100/80 transition flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3.5 overflow-hidden">
                                <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex flex-col items-center justify-center font-black flex-shrink-0 shadow-sm">
                                    <span class="text-xs uppercase leading-none">{{ \Carbon\Carbon::parse($evt->event_date)->isoFormat('MMM') }}</span>
                                    <span class="text-base leading-none mt-0.5">{{ \Carbon\Carbon::parse($evt->event_date)->format('d') }}</span>
                                </div>
                                <div class="overflow-hidden">
                                    <div class="font-black text-xs text-stone-900 truncate">{{ $evt->title }}</div>
                                    <div class="text-[11px] text-stone-500 flex items-center gap-2 mt-0.5">
                                        <span><i class="fa-solid fa-location-dot text-amber-500 text-[10px] mr-1"></i>{{ $evt->location ?? 'Lingkungan RT 12' }}</span>
                                        @if($evt->start_time)
                                            <span>•</span>
                                            <span><i class="fa-regular fa-clock text-[10px] mr-1"></i>{{ $evt->start_time }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black flex-shrink-0 {{ $evt->status == 'Selesai' ? 'bg-stone-200 text-stone-700' : 'bg-emerald-100 text-emerald-800 border border-emerald-300' }}">
                                {{ $evt->status ?? 'Akan Datang' }}
                            </span>
                        </div>
                    @empty
                        <div class="py-8 text-center text-stone-400 space-y-2">
                            <i class="fa-regular fa-calendar-xmark text-2xl"></i>
                            <p class="text-xs font-semibold">Belum ada agenda kegiatan yang dijadwalkan.</p>
                            @if(Auth::user()->hasAccessTo('events'))
                                <a href="{{ route('admin.events.create') }}" class="inline-block text-xs font-black text-purple-600 hover:underline">
                                    + Buat Agenda Kegiatan Pertama
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-xs text-stone-400">
                <span class="text-[11px] font-medium">Pastikan seluruh panitia siap bertugas.</span>
                <span class="text-[11px] font-black text-stone-700">{{ $stats['total_events'] }} Total Acara Tercatat</span>
            </div>
        </div>

    </div>

    <!-- 4. Real-Time Community & Activity Feeds (3 Columns Grid) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kolom 1: Aspirasi Warga Terbaru -->
        <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm p-6 flex flex-col justify-between space-y-4">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-xs font-bold">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <h3 class="font-black text-stone-900 text-sm">Aspirasi Warga Terbaru</h3>
                    </div>
                    @if(Auth::user()->hasAccessTo('aspirations'))
                        <a href="{{ route('admin.aspirations.index') }}" class="text-[11px] font-black text-amber-600 hover:text-amber-800">
                            Semua &rarr;
                        </a>
                    @endif
                </div>

                <div class="divide-y divide-stone-100">
                    @forelse($recentAspirations as $asp)
                        <div class="py-3 space-y-1.5">
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-amber-500/10 text-amber-800 font-black text-[10px] flex items-center justify-center">
                                        {{ strtoupper(substr($asp->name, 0, 1)) }}
                                    </div>
                                    <span class="font-black text-stone-900 text-xs truncate max-w-[140px]">{{ $asp->name }}</span>
                                </div>
                                <span class="text-[9px] font-black px-2 py-0.5 rounded-full {{ $asp->status == 'Selesai' ? 'bg-emerald-100 text-emerald-800' : ($asp->status == 'Diproses' ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800') }}">
                                    {{ $asp->status }}
                                </span>
                            </div>
                            <p class="text-xs text-stone-600 line-clamp-2 leading-relaxed pl-8">
                                "{{ $asp->message }}"
                            </p>
                            <div class="text-[10px] text-stone-400 pl-8 flex items-center gap-2">
                                <span><i class="fa-regular fa-clock text-[9px] mr-1"></i>{{ \Carbon\Carbon::parse($asp->created_at)->diffForHumans() }}</span>
                                <span>•</span>
                                <span class="font-bold text-stone-500">{{ $asp->category ?? 'Umum' }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-stone-400 py-6 text-center font-medium">Belum ada aspirasi masuk.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-3 border-t border-stone-100 text-center">
                <span class="text-[10px] text-stone-400 font-semibold">Tanggapi aspirasi untuk menjaga kepercayaan warga.</span>
            </div>
        </div>

        <!-- Kolom 2: Pemuda Terdaftar Terbaru -->
        <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm p-6 flex flex-col justify-between space-y-4">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs font-bold">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <h3 class="font-black text-stone-900 text-sm">Pemuda Baru Terdaftar</h3>
                    </div>
                    @if(Auth::user()->hasAccessTo('youth'))
                        <a href="{{ route('admin.youth.index') }}" class="text-[11px] font-black text-emerald-600 hover:text-emerald-800">
                            Semua &rarr;
                        </a>
                    @endif
                </div>

                <div class="divide-y divide-stone-100">
                    @forelse($recentYouth as $youth)
                        <div class="py-3 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2.5 overflow-hidden">
                                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-700 text-white font-black text-xs flex items-center justify-center flex-shrink-0 shadow-sm">
                                    {{ strtoupper(substr($youth->full_name, 0, 1)) }}
                                </div>
                                <div class="overflow-hidden">
                                    <div class="text-xs font-black text-stone-900 truncate">{{ $youth->full_name }}</div>
                                    <div class="text-[10px] text-stone-500 truncate mt-0.5">
                                        {{ $youth->address ?? 'RT 12 RW 05' }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-1.5 flex-shrink-0">
                                <span class="text-[9px] bg-emerald-50 text-emerald-700 font-black px-2 py-0.5 rounded-full border border-emerald-200">
                                    {{ $youth->interest ?? 'Pemuda' }}
                                </span>
                                @if($youth->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $youth->phone) }}" target="_blank" title="Hubungi WhatsApp"
                                       class="w-6 h-6 rounded-lg bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center text-[10px] transition">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-stone-400 py-6 text-center font-medium">Belum ada sensus pemuda terdaftar.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-3 border-t border-stone-100 text-center">
                <span class="text-[10px] text-stone-400 font-semibold">Generasi pemuda tulang punggung kegiatan RT 12.</span>
            </div>
        </div>

        <!-- Kolom 3: Live Activity Feed (Audit Trail Ringkas) -->
        <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm p-6 flex flex-col justify-between space-y-4">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-stone-900 text-amber-400 flex items-center justify-center text-xs font-bold">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <h3 class="font-black text-stone-900 text-sm">Aktivitas Terkini Panitia</h3>
                    </div>
                    @if(Auth::user()->hasAccessTo('activity_logs'))
                        <a href="{{ route('admin.activity-logs.index') }}" class="text-[11px] font-black text-stone-700 hover:text-stone-900">
                            Log Lengkap &rarr;
                        </a>
                    @endif
                </div>

                <div class="space-y-3">
                    @forelse($recentLogs as $log)
                        <div class="p-2.5 rounded-xl bg-stone-50 border border-stone-100 flex items-start gap-2.5">
                            <div class="w-6 h-6 rounded-lg {{ $log->action == 'TAMBAH' ? 'bg-emerald-100 text-emerald-800' : ($log->action == 'UPDATE' ? 'bg-blue-100 text-blue-800' : ($log->action == 'HAPUS' ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800')) }} flex items-center justify-center text-[10px] flex-shrink-0 mt-0.5">
                                @if($log->action == 'TAMBAH')
                                    <i class="fa-solid fa-plus"></i>
                                @elseif($log->action == 'UPDATE')
                                    <i class="fa-solid fa-pen"></i>
                                @elseif($log->action == 'HAPUS')
                                    <i class="fa-solid fa-trash"></i>
                                @elseif($log->action == 'LOGIN')
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                @else
                                    <i class="fa-solid fa-check"></i>
                                @endif
                            </div>
                            <div class="overflow-hidden flex-1">
                                <div class="flex items-center justify-between gap-1">
                                    <span class="text-xs font-black text-stone-900 truncate">{{ $log->user_name }}</span>
                                    <span class="text-[9px] text-stone-400 flex-shrink-0">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans(null, true) }}</span>
                                </div>
                                <p class="text-[11px] text-stone-600 line-clamp-1 leading-snug mt-0.5">{{ $log->description }}</p>
                                <span class="inline-block text-[9px] font-black text-stone-500 uppercase tracking-wider mt-0.5">{{ $log->module }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-stone-400 py-6 text-center font-medium">Belum ada riwayat aktivitas tercatat.</p>
                    @endforelse
                </div>
            </div>

            <div class="pt-3 border-t border-stone-100 text-center">
                <span class="text-[10px] text-stone-400 font-semibold">Semua perubahan tercatat otomatis untuk transparansi.</span>
            </div>
        </div>

    </div>

</div>
@endsection