@extends('layouts.app')

@section('title', 'Galeri Dokumentasi - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<!-- Hero Banner -->
<section class="relative jungle-pattern text-white py-14 sm:py-20 overflow-hidden">
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-24 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-950/80 border border-emerald-500/40 text-emerald-300 text-xs font-extrabold backdrop-blur-md">
            <i class="fa-regular fa-images text-amber-400"></i> DOKUMENTASI • RT 12 RW 05
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
            Galeri Foto <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-emerald-300">Kegiatan</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto">
            Momen kebersamaan, gotong royong, lomba 17-an tema Jumanji, dan perayaan warga RT 012 RW 05.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ activeModal: false, modalImg: '', modalTitle: '', modalDesc: '', modalCategory: '' }">

    <!-- Category Filter -->
    <div class="flex items-center justify-center gap-2 mb-10 overflow-x-auto pb-2 hide-scrollbar">
        <a href="{{ route('gallery') }}" 
           class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap {{ !$category ? 'bg-emerald-700 text-white shadow-md' : 'bg-white text-stone-600 hover:bg-stone-50 border border-stone-200' }}">
            <i class="fa-solid fa-camera mr-1 {{ !$category ? 'text-amber-300' : 'text-stone-400' }}"></i> Semua
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('gallery', ['category' => $cat]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $category == $cat ? 'bg-emerald-700 text-white shadow-md' : 'bg-white text-stone-600 hover:bg-stone-50 border border-stone-200' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    <!-- Masonry Gallery Grid -->
    <div class="columns-2 md:columns-3 lg:columns-4 gap-3 space-y-3">
        @forelse($galleries as $item)
            <div class="group relative rounded-2xl overflow-hidden bg-stone-100 shadow-sm break-inside-avoid cursor-pointer hover:shadow-xl transition duration-300"
                 @click="activeModal = true; modalImg = '{{ $item->image_url }}'; modalTitle = '{{ addslashes($item->title) }}'; modalDesc = '{{ addslashes($item->description ?? '') }}'; modalCategory = '{{ addslashes($item->category) }}'">
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-auto object-cover group-hover:scale-105 transition duration-700" loading="lazy">
                
                <!-- Category Tag -->
                <div class="absolute top-2.5 left-2.5">
                    <span class="text-[9px] font-black uppercase tracking-wider bg-stone-950/75 backdrop-blur-md text-amber-300 px-2 py-0.5 rounded-full border border-amber-400/20">
                        {{ $item->category }}
                    </span>
                </div>

                <!-- Hover Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                    <h3 class="font-bold text-white text-sm leading-snug">{{ $item->title }}</h3>
                    @if($item->activity_date)
                        <div class="text-[10px] text-stone-300 mt-1 flex items-center gap-1">
                            <i class="fa-regular fa-calendar-days text-amber-400"></i>
                            {{ \Carbon\Carbon::parse($item->activity_date)->translatedFormat('d M Y') }}
                        </div>
                    @endif
                    <div class="mt-1.5 text-[10px] font-bold text-emerald-400 flex items-center gap-1">
                        <i class="fa-solid fa-magnifying-glass-plus text-[9px]"></i> Klik untuk perbesar
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-4 text-center py-20 bg-white rounded-2xl border border-stone-200 p-8 break-inside-avoid">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mx-auto mb-3">
                    <i class="fa-regular fa-images"></i>
                </div>
                <h3 class="text-base font-bold text-stone-800">Belum ada foto</h3>
                <p class="text-xs text-stone-500 mt-1">Pilih kategori lain di atas.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">{{ $galleries->links() }}</div>

    <!-- Lightbox Modal -->
    <div x-show="activeModal" x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         @keydown.escape.window="activeModal = false">
        
        <div class="relative max-w-4xl w-full bg-stone-950 rounded-3xl overflow-hidden border border-emerald-900/40 shadow-2xl" @click.outside="activeModal = false">
            <button @click="activeModal = false" class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-stone-900/80 text-white flex items-center justify-center hover:bg-stone-800 transition border border-white/20">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            <div class="max-h-[70vh] overflow-hidden flex items-center justify-center bg-black">
                <img :src="modalImg" :alt="modalTitle" class="max-h-[70vh] w-auto object-contain">
            </div>
            <div class="p-5 bg-stone-950 text-white space-y-1.5 border-t border-stone-800">
                <span class="text-[9px] font-black uppercase tracking-wider bg-emerald-900/80 text-emerald-300 px-2 py-0.5 rounded-md" x-text="modalCategory"></span>
                <h3 class="text-base font-black text-white" x-text="modalTitle"></h3>
                <p class="text-xs text-stone-400" x-text="modalDesc" x-show="modalDesc"></p>
            </div>
        </div>
    </div>
</div>
@endsection
