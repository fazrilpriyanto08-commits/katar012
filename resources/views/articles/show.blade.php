@extends('layouts.app')

@section('title', $article->title . ' - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<!-- Hero Image Header -->
@if($article->image)
<section class="relative h-64 sm:h-80 lg:h-96 overflow-hidden bg-stone-900">
    <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover opacity-80">
    <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/50 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8 lg:p-12">
        <div class="max-w-4xl mx-auto">
            <span class="inline-block px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-amber-400 text-stone-950 mb-3">
                {{ $article->category }}
            </span>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white leading-tight drop-shadow-lg">
                {{ $article->title }}
            </h1>
        </div>
    </div>
</section>
@else
<section class="jungle-pattern py-12 sm:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-amber-400 text-stone-950 mb-3">
            {{ $article->category }}
        </span>
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white leading-tight">
            {{ $article->title }}
        </h1>
    </div>
</section>
@endif

<!-- Breadcrumb -->
<div class="bg-stone-100 border-b border-stone-200 py-2.5">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-[11px] text-stone-500 flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-emerald-700 font-semibold">Beranda</a>
        <i class="fa-solid fa-chevron-right text-[8px] text-stone-300"></i>
        <a href="{{ route('articles.index') }}" class="hover:text-emerald-700 font-semibold">Berita</a>
        <i class="fa-solid fa-chevron-right text-[8px] text-stone-300"></i>
        <span class="text-stone-700 font-bold truncate">{{ Str::limit($article->title, 40) }}</span>
    </div>
</div>

<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Author & Meta Bar -->
    <div class="flex flex-wrap items-center gap-4 pb-6 border-b border-stone-200 mb-8">
        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">
            {{ strtoupper(substr($article->author, 0, 1)) }}
        </div>
        <div>
            <div class="font-bold text-sm text-stone-900">{{ $article->author }}</div>
            <div class="text-[11px] text-stone-400 flex items-center gap-2">
                <span><i class="fa-regular fa-calendar mr-1"></i>{{ \Carbon\Carbon::parse($article->published_at)->translatedFormat('d F Y, H:i') }} WIB</span>
                <span>•</span>
                <span><i class="fa-regular fa-clock mr-1"></i>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} menit baca</span>
            </div>
        </div>
        <div class="ml-auto flex items-center gap-2">
            <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank"
               class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition text-sm">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
            <button onclick="navigator.clipboard.writeText(window.location.href)" title="Salin Link"
                    class="w-9 h-9 rounded-xl bg-stone-100 text-stone-500 hover:bg-stone-600 hover:text-white flex items-center justify-center transition text-sm">
                <i class="fa-solid fa-link"></i>
            </button>
        </div>
    </div>

    <!-- Excerpt -->
    @if($article->excerpt)
        <div class="p-5 rounded-2xl bg-amber-50/80 border-l-4 border-amber-400 text-stone-700 font-medium italic text-sm leading-relaxed mb-8">
            {{ $article->excerpt }}
        </div>
    @endif

    <!-- Content -->
    <div class="prose max-w-none text-stone-700 text-sm sm:text-base leading-relaxed">
        {!! nl2br(e($article->content)) !!}
    </div>

    <!-- Share Bar -->
    <div class="mt-10 pt-6 border-t border-stone-200 flex items-center justify-between">
        <div class="text-xs text-stone-400 font-medium">Bagikan artikel ini:</div>
        <div class="flex items-center gap-2">
            <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . url()->current()) }}" target="_blank"
               class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white font-bold text-xs px-3 py-2 rounded-xl transition">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp
            </a>
        </div>
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
        <div class="pt-12 border-t border-stone-200 mt-10 space-y-6">
            <h3 class="text-lg font-black text-stone-900">Kabar Terkait Lainnya</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach($relatedArticles as $related)
                    <a href="{{ route('articles.show', $related->slug) }}" class="group bg-white rounded-2xl border border-stone-200 p-4 hover:shadow-lg hover:-translate-y-0.5 transition duration-200">
                        <div class="text-[10px] font-bold text-emerald-700 mb-1">{{ $related->category }}</div>
                        <h4 class="font-extrabold text-stone-900 text-sm group-hover:text-emerald-700 transition line-clamp-2">{{ $related->title }}</h4>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</article>
@endsection
