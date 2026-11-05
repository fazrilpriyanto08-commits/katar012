@extends('layouts.app')

@section('title', 'Hall of Fame - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<!-- Hero Section -->
<section class="jungle-pattern py-16 sm:py-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/30 to-black/60 pointer-events-none"></div>
    <!-- Sparkle particles -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-[15%] w-1.5 h-1.5 bg-amber-400/50 rounded-full animate-float" style="animation-delay:0s"></div>
        <div class="absolute top-32 left-[45%] w-2 h-2 bg-yellow-400/40 rounded-full animate-float" style="animation-delay:1s"></div>
        <div class="absolute top-16 right-[20%] w-1.5 h-1.5 bg-amber-300/50 rounded-full animate-float" style="animation-delay:2s"></div>
        <div class="absolute bottom-20 left-[60%] w-2 h-2 bg-yellow-300/30 rounded-full animate-float" style="animation-delay:0.5s"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-flex items-center gap-2 bg-amber-500/20 text-amber-300 text-xs font-black px-4 py-1.5 rounded-full border border-amber-400/30 mb-5 backdrop-blur-md">
            <i class="fa-solid fa-trophy text-amber-400"></i> RUANG APRESIASI WARGA
        </span>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight">
            HALL OF <span class="bg-gradient-to-r from-amber-300 via-amber-400 to-yellow-500 bg-clip-text text-transparent">FAME</span> RT 012
        </h1>
        <p class="text-stone-300 mt-4 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
            Panggung kehormatan bagi para juara, pemuda inspiratif, dan tokoh warga yang mengharumkan RT 012 RW 05.
        </p>
    </div>
</section>

<!-- Stats -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-amber-200/50 flex items-center gap-4 hover:-translate-y-0.5 transition">
            <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-amber-600 rounded-2xl flex items-center justify-center text-white text-xl shadow-md"><i class="fa-solid fa-award"></i></div>
            <div>
                <div class="text-2xl font-black text-stone-900">{{ $stats['total_honorees'] }}</div>
                <div class="text-[10px] font-bold text-stone-500 uppercase tracking-wider">Tokoh & Prestasi</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-emerald-200/50 flex items-center gap-4 hover:-translate-y-0.5 transition">
            <div class="w-12 h-12 bg-gradient-to-br from-emerald-600 to-green-700 rounded-2xl flex items-center justify-center text-white text-xl shadow-md"><i class="fa-solid fa-trophy"></i></div>
            <div>
                <div class="text-2xl font-black text-emerald-800">{{ $stats['champions'] }}</div>
                <div class="text-[10px] font-bold text-stone-500 uppercase tracking-wider">Juara 1 & Emas</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-stone-200 flex items-center gap-4 hover:-translate-y-0.5 transition">
            <div class="w-12 h-12 bg-gradient-to-br from-stone-700 to-stone-900 rounded-2xl flex items-center justify-center text-white text-xl shadow-md"><i class="fa-solid fa-star"></i></div>
            <div>
                <div class="text-2xl font-black text-stone-900">{{ $stats['total_years'] }} Gen</div>
                <div class="text-[10px] font-bold text-stone-500 uppercase tracking-wider">Jejak Prestasi</div>
            </div>
        </div>
    </div>
</section>

<!-- Filter -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-stone-200">
        <form method="GET" action="{{ route('hall-of-fame') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama, prestasi..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>
            <select name="category" class="px-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:ring-2 focus:ring-amber-500 bg-white">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ ($category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <select name="year" class="px-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:ring-2 focus:ring-amber-500 bg-white">
                <option value="">Semua Tahun</option>
                @foreach($availableYears as $yr)
                    <option value="{{ $yr }}" {{ ($year ?? '') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-stone-950 font-black text-sm px-5 py-2.5 rounded-xl transition shadow-md flex items-center justify-center gap-2">
                <i class="fa-solid fa-filter"></i> Filter
            </button>
            @if($search || $category || $year)
                <a href="{{ route('hall-of-fame') }}" class="bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold text-sm px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-1">
                    <i class="fa-solid fa-xmark"></i> Reset
                </a>
            @endif
        </form>
    </div>
</section>

<!-- Cards Grid -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-16">
    @if($honorees->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($honorees as $item)
                <div class="bg-white rounded-2xl overflow-hidden border border-stone-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                    <!-- Golden Top -->
                    <div class="h-1.5 bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500"></div>

                    <!-- Image -->
                    <div class="relative h-56 bg-stone-900 overflow-hidden">
                        @if($item->photo)
                            <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-amber-400/30 bg-stone-950">
                                <i class="fa-solid fa-trophy text-5xl mb-2"></i>
                                <span class="text-[10px] text-stone-500 font-bold uppercase tracking-widest">Hall of Fame</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        
                        <!-- Badge -->
                        <div class="absolute top-3 right-3 bg-amber-400 text-stone-950 font-black text-[10px] px-3 py-1 rounded-full shadow-lg flex items-center gap-1">
                            {{ $item->award_badge }}
                        </div>
                        <!-- Year -->
                        <span class="absolute top-3 left-3 bg-stone-900/80 backdrop-blur-md text-amber-300 font-bold text-[10px] px-2.5 py-0.5 rounded-full border border-amber-500/20">
                            <i class="fa-solid fa-calendar mr-0.5"></i> {{ $item->year }}
                        </span>
                        <!-- Name -->
                        <div class="absolute bottom-3 left-3 right-3">
                            <span class="text-[9px] font-black uppercase tracking-widest text-emerald-400 bg-emerald-950/70 px-2 py-0.5 rounded-md backdrop-blur-sm inline-block mb-1">{{ $item->category }}</span>
                            <h3 class="text-lg font-black text-white leading-tight drop-shadow-md">{{ $item->name }}</h3>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start gap-2 mb-2">
                                <i class="fa-solid fa-medal text-amber-500 mt-0.5 flex-shrink-0"></i>
                                <h4 class="font-extrabold text-stone-900 text-sm leading-snug">{{ $item->title }}</h4>
                            </div>
                            @if($item->description)
                                <p class="text-[11px] text-stone-500 leading-relaxed italic border-l-2 border-amber-400 pl-3 my-2">"{{ $item->description }}"</p>
                            @endif
                        </div>
                        <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-[10px] text-stone-400 mt-3">
                            <span class="flex items-center gap-1 font-semibold text-emerald-700">
                                <i class="fa-solid fa-circle-check"></i> Terverifikasi RT 012
                            </span>
                            <span>Angkatan {{ $item->year }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-10">{{ $honorees->withQueryString()->links('pagination::tailwind') }}</div>
    @else
        <div class="text-center py-20 bg-white rounded-2xl border border-stone-200 p-8">
            <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-trophy text-2xl text-amber-400"></i>
            </div>
            <h3 class="font-black text-stone-700 text-base">Belum Ada Catatan</h3>
            <p class="text-stone-400 text-xs mt-1">Data belum ditemukan untuk filter yang dipilih.</p>
        </div>
    @endif
</section>

<!-- Nomination CTA -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
    <div class="bg-gradient-to-r from-stone-900 via-emerald-950 to-stone-900 rounded-3xl p-8 sm:p-12 text-white border border-emerald-800/60 shadow-xl relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 opacity-5 text-[120px] text-amber-400 pointer-events-none">
            <i class="fa-solid fa-trophy"></i>
        </div>
        <div class="relative z-10 max-w-2xl">
            <span class="bg-amber-400 text-stone-950 font-black text-[9px] uppercase tracking-widest px-3 py-1 rounded-full mb-3 inline-block">Inisiatif Bersama</span>
            <h3 class="text-xl sm:text-2xl font-black text-white leading-tight">
                Kenal Warga RT 012 yang Berprestasi?
            </h3>
            <p class="text-stone-300 text-sm mt-2 leading-relaxed">
                Rekomendasikan warga atau pemuda yang meraih kejuaraan agar dapat diabadikan di Hall of Fame RT 012!
            </p>
            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('aspiration') }}" class="bg-amber-400 hover:bg-amber-500 text-stone-950 font-black text-xs px-5 py-3 rounded-xl shadow-lg transition hover:-translate-y-0.5 flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i> Ajukan Nominasi
                </a>
                <a href="https://wa.me/6281412357231?text=Halo%20Pengurus%2C%20saya%20ingin%20mengajukan%20nama%20untuk%20Hall%20of%20Fame%20RT%20012." target="_blank"
                   class="bg-white/10 hover:bg-white/20 text-white font-bold text-xs px-5 py-3 rounded-xl border border-white/20 transition flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-emerald-400"></i> WA Pengurus
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
