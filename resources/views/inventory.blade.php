@extends('layouts.app')

@section('title', 'Inventaris Barang & Perlengkapan - Unit Penghubung Warga RT 12 RW 05')

@section('content')

{{-- Hero Section --}}
<section class="jungle-pattern py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 bg-emerald-900/60 text-emerald-200 text-xs font-bold px-4 py-1.5 rounded-full border border-emerald-700/50 mb-5">
            <i class="fa-solid fa-boxes-stacked text-amber-400"></i>
            Daftar Inventaris & Perlengkapan RT 012
        </span>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
            Barang Milik <span class="text-amber-400">Warga RT 012</span>
        </h1>
        <p class="text-stone-300 mt-4 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
            Transparansi daftar barang inventaris dan perlengkapan yang dimiliki RT 012 RW 05 untuk kepentingan bersama warga.
        </p>
    </div>
</section>

{{-- Stats Cards --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-stone-100 text-center">
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-cubes text-emerald-600 text-xl"></i>
            </div>
            <div class="text-2xl font-black text-stone-900">{{ number_format($totalItems) }}</div>
            <div class="text-xs font-bold text-stone-500 mt-1">Total Unit Barang</div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-stone-100 text-center">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-tags text-blue-600 text-xl"></i>
            </div>
            <div class="text-2xl font-black text-stone-900">{{ $totalTypes }}</div>
            <div class="text-xs font-bold text-stone-500 mt-1">Jenis Barang</div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-stone-100 text-center">
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
            </div>
            <div class="text-2xl font-black text-emerald-700">{{ $goodCondition }}</div>
            <div class="text-xs font-bold text-stone-500 mt-1">Kondisi Baik</div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-lg border border-stone-100 text-center">
            <div class="w-12 h-12 bg-rose-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-wrench text-rose-500 text-xl"></i>
            </div>
            <div class="text-2xl font-black text-rose-600">{{ $needRepair }}</div>
            <div class="text-xs font-bold text-stone-500 mt-1">Perlu Perbaikan</div>
        </div>
    </div>
</section>

{{-- Filter & Search --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-stone-100">
        <form method="GET" action="{{ route('inventory') }}" class="flex flex-col sm:flex-row gap-3">
            {{-- Search --}}
            <div class="flex-1 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama barang, lokasi simpan..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            {{-- Category Filter --}}
            <select name="category" class="px-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            {{-- Condition Filter --}}
            <select name="condition" class="px-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                <option value="">Semua Kondisi</option>
                <option value="Baik" {{ ($condition ?? '') == 'Baik' ? 'selected' : '' }}>✅ Baik</option>
                <option value="Cukup Baik" {{ ($condition ?? '') == 'Cukup Baik' ? 'selected' : '' }}>⚠️ Cukup Baik</option>
                <option value="Rusak Ringan" {{ ($condition ?? '') == 'Rusak Ringan' ? 'selected' : '' }}>🔧 Rusak Ringan</option>
                <option value="Rusak Berat" {{ ($condition ?? '') == 'Rusak Berat' ? 'selected' : '' }}>❌ Rusak Berat</option>
            </select>
            <button type="submit" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm px-6 py-2.5 rounded-xl transition shadow-sm">
                <i class="fa-solid fa-filter mr-1.5"></i> Filter
            </button>
            @if($search || $category || $condition)
                <a href="{{ route('inventory') }}" class="text-center bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold text-sm px-4 py-2.5 rounded-xl transition">
                    <i class="fa-solid fa-xmark mr-1"></i> Reset
                </a>
            @endif
        </form>
    </div>
</section>

{{-- Inventory Grid --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-16">
    @if($items->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($items as $item)
                <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition duration-300 group">
                    {{-- Photo --}}
                    <div class="relative h-44 bg-stone-100 overflow-hidden">
                        @if($item->photo)
                            <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-stone-300">
                                <i class="fa-solid fa-box-open text-4xl mb-2"></i>
                                <span class="text-xs font-medium">Belum ada foto</span>
                            </div>
                        @endif
                        {{-- Condition Badge --}}
                        @php
                            $condColor = match($item->condition) {
                                'Baik' => 'bg-emerald-500',
                                'Cukup Baik' => 'bg-amber-500',
                                'Rusak Ringan' => 'bg-orange-500',
                                'Rusak Berat' => 'bg-rose-500',
                                default => 'bg-stone-500',
                            };
                        @endphp
                        <span class="absolute top-3 right-3 {{ $condColor }} text-white text-[10px] font-bold px-2.5 py-1 rounded-full shadow">
                            {{ $item->condition }}
                        </span>
                        {{-- Category Badge --}}
                        <span class="absolute top-3 left-3 bg-black/60 text-white text-[10px] font-bold px-2.5 py-1 rounded-full backdrop-blur-sm">
                            {{ $item->category }}
                        </span>
                    </div>

                    {{-- Info --}}
                    <div class="p-4">
                        <h3 class="font-bold text-stone-900 text-sm leading-snug mb-2">{{ $item->name }}</h3>
                        
                        <div class="space-y-1.5 text-xs text-stone-500">
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-boxes-stacked text-emerald-500"></i> Jumlah
                                </span>
                                <span class="font-bold text-stone-800">{{ $item->quantity }} {{ $item->unit }}</span>
                            </div>
                            @if($item->storage_location)
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fa-solid fa-location-dot text-amber-500"></i> Lokasi
                                    </span>
                                    <span class="font-medium text-stone-600 truncate max-w-[120px]">{{ $item->storage_location }}</span>
                                </div>
                            @endif
                            @if($item->acquired_date)
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fa-regular fa-calendar text-blue-500"></i> Diperoleh
                                    </span>
                                    <span class="font-medium text-stone-600">{{ $item->acquired_date->format('d M Y') }}</span>
                                </div>
                            @endif
                        </div>

                        @if($item->notes)
                            <p class="mt-3 text-xs text-stone-400 leading-relaxed border-t border-stone-50 pt-2.5">
                                {{ Str::limit($item->notes, 80) }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $items->withQueryString()->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center py-20">
            <div class="w-20 h-20 bg-stone-100 rounded-full flex items-center justify-center mx-auto mb-5">
                <i class="fa-solid fa-box-open text-3xl text-stone-300"></i>
            </div>
            <h3 class="font-bold text-stone-600 text-lg">Belum Ada Barang Inventaris</h3>
            <p class="text-stone-400 text-sm mt-2">Data inventaris barang RT 012 belum tersedia atau tidak sesuai filter yang dipilih.</p>
        </div>
    @endif
</section>

{{-- Info Section --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
    <div class="bg-gradient-to-br from-emerald-50 to-stone-50 rounded-2xl p-8 border border-emerald-100">
        <div class="flex flex-col sm:flex-row items-start gap-5">
            <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-circle-info text-emerald-600 text-2xl"></i>
            </div>
            <div>
                <h3 class="font-bold text-stone-800 text-base mb-2">Tentang Inventaris RT 012</h3>
                <p class="text-sm text-stone-600 leading-relaxed mb-3">
                    Halaman ini menampilkan daftar barang-barang inventaris milik bersama warga RT 012 RW 05. 
                    Semua barang dapat dipinjam oleh warga untuk keperluan acara hajatan, kegiatan lingkungan, atau kepentingan umum lainnya.
                </p>
                <div class="flex flex-wrap gap-2">
                    <a href="https://wa.me/6281412357231?text=Assalamualaikum%2C%20saya%20ingin%20meminjam%20barang%20inventaris%20RT%20012." target="_blank"
                       class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2 rounded-lg transition shadow-sm">
                        <i class="fa-brands fa-whatsapp"></i> Hubungi Pengurus (Pinjam Barang)
                    </a>
                    <a href="{{ route('aspiration') }}" class="inline-flex items-center gap-2 bg-white hover:bg-stone-50 text-stone-700 text-xs font-bold px-4 py-2 rounded-lg transition border border-stone-200">
                        <i class="fa-solid fa-bullhorn"></i> Laporkan Kerusakan Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
