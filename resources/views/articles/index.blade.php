@extends('layouts.app')

@section('title', 'Berita & Pengumuman - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<!-- Hero Banner -->
<section class="relative jungle-pattern text-white py-14 sm:py-20 overflow-hidden">
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-24 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-950/80 border border-emerald-500/40 text-emerald-300 text-xs font-extrabold backdrop-blur-md">
            <i class="fa-regular fa-newspaper text-amber-400"></i> KABAR WARGA • RT 12 RW 05
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
            Berita & <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-emerald-300">Pengumuman</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto">
            Informasi terpercaya seputar kegiatan warga, dokumentasi gotong royong, dan warta kepengurusan RT 012 RW 05.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Filter & Search -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <!-- Category Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0 hide-scrollbar">
            <a href="{{ route('articles.index') }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap {{ !$category ? 'bg-emerald-700 text-white shadow-md' : 'bg-white text-stone-600 hover:bg-stone-50 border border-stone-200' }}">
                Semua
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('articles.index', ['category' => $cat]) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $category == $cat ? 'bg-emerald-700 text-white shadow-md' : 'bg-white text-stone-600 hover:bg-stone-50 border border-stone-200' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <!-- Search -->
        <form action="{{ route('articles.index') }}" method="GET" class="relative max-w-xs w-full">
            @if($category)<input type="hidden" name="category" value="{{ $category }}">@endif
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-stone-400 text-xs"></i>
            <input type="text" name="q" value="{{ $search }}" placeholder="Cari berita..." 
                   class="w-full bg-white border border-stone-200 rounded-xl pl-10 pr-4 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500 shadow-sm">
        </form>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($articles as $i => $article)
            <article class="bg-white rounded-2xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col group {{ $i === 0 && !$category && !$search ? 'md:col-span-2 lg:col-span-2' : '' }}">
                <div class="relative {{ $i === 0 && !$category && !$search ? 'h-48 md:h-64' : 'h-48' }} overflow-hidden bg-stone-100">
                    <img src="{{ $article->image ?: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <span class="absolute bottom-3 left-3 bg-stone-950/80 backdrop-blur-md text-emerald-300 text-[10px] font-bold px-2.5 py-1 rounded-lg border border-emerald-500/20">
                        {{ $article->category }}
                    </span>
                    @if($article->is_featured)
                        <span class="absolute top-3 right-3 bg-amber-400 text-stone-950 text-[9px] font-black px-2 py-0.5 rounded-full uppercase tracking-wider shadow">
                            <i class="fa-solid fa-fire mr-0.5"></i> Sorotan
                        </span>
                    @endif
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between space-y-3">
                    <div class="space-y-2">
                        <div class="text-[11px] text-stone-400 flex items-center gap-2">
                            <span>{{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}</span>
                            <span>•</span>
                            <span class="font-semibold text-stone-600"><i class="fa-regular fa-user text-emerald-600 mr-0.5"></i> {{ $article->author }}</span>
                        </div>
                        <h3 class="font-extrabold text-stone-900 text-base group-hover:text-emerald-700 transition line-clamp-2">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                        <p class="text-[11px] text-stone-500 line-clamp-2">{{ $article->excerpt ?: Str::limit(strip_tags($article->content), 120) }}</p>
                    </div>
                    <div class="pt-3 border-t border-stone-100">
                        <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-1 text-[11px] font-black text-emerald-700 hover:text-emerald-900 transition">
                            Baca Selengkapnya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-3 text-center py-20 bg-white rounded-2xl border border-stone-200 p-8">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mx-auto mb-3">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <h3 class="text-base font-bold text-stone-800">Tidak ada berita ditemukan</h3>
                <p class="text-xs text-stone-500 mt-1">Coba kata kunci lain atau kembali ke semua kategori.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10">{{ $articles->links() }}</div>
</div>
@endsection
