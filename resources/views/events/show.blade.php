@extends('layouts.app')

@section('title', $event->title . ' - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<!-- Hero Image -->
<section class="relative h-64 sm:h-80 lg:h-96 overflow-hidden bg-stone-900">
    <img src="{{ $event->image ?: 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $event->title }}" class="w-full h-full object-cover opacity-80">
    <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/40 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8 lg:p-12">
        <div class="max-w-5xl mx-auto">
            <span class="inline-block px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider mb-3
                         {{ $event->status == 'Akan Datang' ? 'bg-emerald-500 text-white' : ($event->status == 'Sedang Berlangsung' ? 'bg-amber-400 text-stone-950' : 'bg-stone-600 text-white') }}">
                {{ $event->status }}
            </span>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white leading-tight drop-shadow-lg">
                {{ $event->title }}
            </h1>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="bg-stone-100 border-b border-stone-200 py-2.5">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-[11px] text-stone-500 flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-emerald-700 font-semibold">Beranda</a>
        <i class="fa-solid fa-chevron-right text-[8px] text-stone-300"></i>
        <a href="{{ route('events.index') }}" class="hover:text-emerald-700 font-semibold">Agenda</a>
        <i class="fa-solid fa-chevron-right text-[8px] text-stone-300"></i>
        <span class="text-stone-700 font-bold truncate">{{ Str::limit($event->title, 40) }}</span>
    </div>
</div>

<article class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    
    <!-- Info Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-emerald-50 border border-emerald-200/80 rounded-2xl p-4 flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0"><i class="fa-regular fa-calendar-days"></i></div>
            <div>
                <div class="text-[10px] text-emerald-800 font-bold uppercase tracking-wider">Tanggal</div>
                <div class="text-sm font-black text-stone-900 mt-0.5">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}</div>
            </div>
        </div>
        <div class="bg-amber-50 border border-amber-200/80 rounded-2xl p-4 flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-amber-500 text-stone-950 flex items-center justify-center flex-shrink-0"><i class="fa-regular fa-clock"></i></div>
            <div>
                <div class="text-[10px] text-amber-800 font-bold uppercase tracking-wider">Waktu</div>
                <div class="text-sm font-black text-stone-900 mt-0.5">{{ $event->start_time ?? '08:00' }} - {{ $event->end_time ?? 'Selesai' }}</div>
            </div>
        </div>
        <div class="bg-rose-50 border border-rose-200/80 rounded-2xl p-4 flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-rose-500 text-white flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-location-dot"></i></div>
            <div>
                <div class="text-[10px] text-rose-800 font-bold uppercase tracking-wider">Lokasi</div>
                <div class="text-sm font-black text-stone-900 mt-0.5">{{ $event->location }}</div>
            </div>
        </div>
        <div class="bg-blue-50 border border-blue-200/80 rounded-2xl p-4 flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-users"></i></div>
            <div>
                <div class="text-[10px] text-blue-800 font-bold uppercase tracking-wider">Penyelenggara</div>
                <div class="text-sm font-black text-stone-900 mt-0.5">{{ $event->organizer }}</div>
            </div>
        </div>
    </div>

    <!-- Share & Action -->
    <div class="flex flex-wrap gap-3">
        <a href="https://wa.me/?text={{ urlencode($event->title . ' — ' . \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') . ' di ' . $event->location . '. Info: ' . url()->current()) }}" target="_blank"
           class="inline-flex items-center gap-2 bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white font-bold text-xs px-4 py-2.5 rounded-xl border border-emerald-200 hover:border-transparent transition">
            <i class="fa-brands fa-whatsapp"></i> Bagikan via WA
        </a>
        <button onclick="navigator.clipboard.writeText(window.location.href)" 
                class="inline-flex items-center gap-2 bg-stone-100 hover:bg-stone-200 text-stone-600 font-bold text-xs px-4 py-2.5 rounded-xl transition">
            <i class="fa-solid fa-link"></i> Salin Link
        </button>
    </div>

    <!-- Description -->
    <div class="prose max-w-none text-stone-700 text-sm sm:text-base leading-relaxed pt-4 border-t border-stone-200">
        {!! nl2br(e($event->description)) !!}
    </div>

    <!-- Other Events -->
    @if($otherEvents->count() > 0)
        <div class="pt-10 border-t border-stone-200 space-y-5">
            <h3 class="text-lg font-black text-stone-900">Agenda Lainnya</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach($otherEvents as $other)
                    <a href="{{ route('events.show', $other->slug) }}" class="group bg-white rounded-2xl border border-stone-200 p-4 hover:shadow-lg hover:-translate-y-0.5 transition duration-200">
                        <div class="text-[11px] font-bold text-emerald-700 mb-1">
                            <i class="fa-regular fa-calendar mr-1"></i>{{ \Carbon\Carbon::parse($other->event_date)->translatedFormat('d M Y') }}
                        </div>
                        <h4 class="font-extrabold text-stone-900 text-sm group-hover:text-emerald-700 transition line-clamp-2">{{ $other->title }}</h4>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</article>
@endsection
