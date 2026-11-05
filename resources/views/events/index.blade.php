@extends('layouts.app')

@section('title', 'Agenda Kegiatan - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<!-- Hero Banner -->
<section class="relative jungle-pattern text-white py-14 sm:py-20 overflow-hidden">
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-24 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-950/80 border border-emerald-500/40 text-emerald-300 text-xs font-extrabold backdrop-blur-md">
            <i class="fa-regular fa-calendar-check text-amber-400"></i> KALENDER KEGIATAN
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
            Agenda <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-emerald-300">Kegiatan</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto">
            Jadwal gotong royong, perlombaan, rapat koordinasi, serta aksi sosial pemuda dan warga RT 012 RW 05.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Status Filter -->
    <div class="flex items-center justify-center gap-2 mb-10 overflow-x-auto pb-2 hide-scrollbar">
        <a href="{{ route('events.index') }}" 
           class="px-5 py-2.5 rounded-xl text-xs font-bold transition whitespace-nowrap {{ !$filter ? 'bg-emerald-700 text-white shadow-md' : 'bg-white text-stone-600 hover:bg-stone-50 border border-stone-200' }}">
            <i class="fa-solid fa-layer-group mr-1 {{ !$filter ? 'text-amber-300' : 'text-stone-400' }}"></i> Semua
        </a>
        <a href="{{ route('events.index', ['status' => 'Akan Datang']) }}" 
           class="px-5 py-2.5 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $filter == 'Akan Datang' ? 'bg-emerald-700 text-white shadow-md' : 'bg-white text-stone-600 hover:bg-stone-50 border border-stone-200' }}">
            <i class="fa-solid fa-clock mr-1 {{ $filter == 'Akan Datang' ? 'text-amber-300' : 'text-emerald-500' }}"></i> Akan Datang
        </a>
        <a href="{{ route('events.index', ['status' => 'Selesai']) }}" 
           class="px-5 py-2.5 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $filter == 'Selesai' ? 'bg-emerald-700 text-white shadow-md' : 'bg-white text-stone-600 hover:bg-stone-50 border border-stone-200' }}">
            <i class="fa-solid fa-circle-check mr-1 {{ $filter == 'Selesai' ? 'text-amber-300' : 'text-stone-400' }}"></i> Selesai
        </a>
    </div>

    <!-- Events Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div class="relative h-48 overflow-hidden bg-stone-100">
                    <img src="{{ $event->image ?: 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    
                    <!-- Status Badge -->
                    <span class="absolute top-3 right-3 text-[10px] font-black px-2.5 py-1 rounded-full shadow 
                        {{ $event->status == 'Akan Datang' ? 'bg-emerald-600 text-white' : ($event->status == 'Sedang Berlangsung' ? 'bg-amber-400 text-stone-950' : 'bg-stone-800/80 text-stone-300 backdrop-blur-md') }}">
                        {{ $event->status }}
                    </span>
                    
                    <!-- Date Badge -->
                    <div class="absolute bottom-3 left-3 bg-white rounded-xl p-2 shadow-lg text-center min-w-[48px]">
                        <div class="text-[8px] font-bold text-emerald-700 uppercase leading-none">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('M') }}</div>
                        <div class="text-lg font-black text-stone-900 leading-none mt-0.5">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</div>
                    </div>
                    
                    <!-- Time Badge -->
                    <div class="absolute bottom-3 right-3 bg-stone-950/80 backdrop-blur-md text-white font-bold text-[10px] px-2.5 py-1 rounded-lg border border-white/10 flex items-center gap-1">
                        <i class="fa-regular fa-clock text-amber-400 text-[9px]"></i>
                        {{ $event->start_time ?? '08:00' }} - {{ $event->end_time ?? 'Selesai' }}
                    </div>
                </div>

                <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                    <div class="space-y-2">
                        <div class="text-[11px] font-bold text-emerald-700 flex items-center gap-1 bg-emerald-50 px-2 py-0.5 rounded-md w-fit">
                            <i class="fa-regular fa-calendar-check text-[10px]"></i>
                            {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}
                        </div>
                        <h3 class="font-extrabold text-stone-900 text-base group-hover:text-emerald-700 transition line-clamp-2">
                            <a href="{{ route('events.show', $event->slug) }}">{{ $event->title }}</a>
                        </h3>
                        <p class="text-[11px] text-stone-500 line-clamp-2">{{ $event->description }}</p>
                    </div>
                    <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-[11px]">
                        <div class="flex items-center gap-1 text-stone-400 truncate max-w-[170px]">
                            <i class="fa-solid fa-location-dot text-rose-500 text-[10px]"></i>
                            <span class="truncate font-medium">{{ $event->location }}</span>
                        </div>
                        <a href="{{ route('events.show', $event->slug) }}" class="font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                            Rincian <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-20 bg-white rounded-2xl border border-stone-200 p-8">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mx-auto mb-3">
                    <i class="fa-regular fa-calendar-xmark"></i>
                </div>
                <h3 class="text-base font-bold text-stone-800">Tidak ada agenda ditemukan</h3>
                <p class="text-xs text-stone-500 mt-1">Silakan pilih filter lain di atas.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">{{ $events->links() }}</div>
</div>
@endsection
