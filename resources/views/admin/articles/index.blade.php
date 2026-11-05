@extends('layouts.admin')

@section('title', 'Pusat Publikasi Berita - Admin Panel RT 012')
@section('page_title', 'Manajemen Berita & Artikel')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-950 via-stone-900 to-stone-950 p-6 sm:p-8 rounded-3xl border border-emerald-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-regular fa-newspaper text-amber-400"></i>
                    <span>Publikasi Informasi Warga</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Berita, Artikel & Kabar Lingkungan
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Kelola seluruh artikel kabar warga, liputan acara gotong royong, peringatan HUT RI, serta pengumuman resmi lingkungan RT 12 RW 05.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-black shadow-lg shadow-emerald-950/50 transition transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-pen-nib"></i>
                    <span>Tulis Berita Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats Bar -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Total Publikasi</span>
                <div class="text-2xl font-black text-stone-900 mt-1">{{ $articles->total() }} Artikel</div>
                <span class="text-[10px] text-stone-500 font-semibold mt-0.5 block">Tampil di portal publik</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Kategori Berita</span>
                <div class="text-2xl font-black text-blue-700 mt-1">Multi-Kategori</div>
                <span class="text-[10px] text-blue-600 font-semibold mt-0.5 block">Kegiatan, Pengumuman, Edukasi</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-tags"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Pemeriksaan Akses</span>
                <div class="text-2xl font-black text-amber-700 mt-1">Sie Acara & Sekertaris</div>
                <span class="text-[10px] text-amber-600 font-semibold mt-0.5 block">Wewenang edit & rilis berita</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-user-pen"></i>
            </div>
        </div>
    </div>

    <!-- Articles Table Presentation -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        
        <div class="p-5 border-b border-stone-100 flex items-center justify-between bg-stone-50/50">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-list-check text-emerald-700 text-sm"></i>
                <h3 class="text-xs font-black text-stone-900 uppercase tracking-wider">Daftar Artikel & Kabar Warga</h3>
            </div>
            <span class="text-xs text-stone-500 font-medium">
                Menampilkan <strong>{{ $articles->count() }}</strong> dari <strong>{{ $articles->total() }}</strong> artikel
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200/80 text-[11px] font-black uppercase tracking-wider text-stone-500">
                        <th class="py-4 px-5">Artikel & Thumbnail</th>
                        <th class="py-4 px-5">Kategori</th>
                        <th class="py-4 px-5">Penulis</th>
                        <th class="py-4 px-5">Tanggal Publikasi</th>
                        <th class="py-4 px-5 text-right">Aksi & Pengaturan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($articles as $article)
                        <tr class="hover:bg-stone-50/80 transition group">
                            
                            {{-- Judul & Thumbnail --}}
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-14 h-14 rounded-2xl overflow-hidden bg-stone-100 border border-stone-200 flex-shrink-0 relative group">
                                        @if($article->image)
                                            <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-stone-400 bg-stone-100 text-lg">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                        @if($article->is_featured)
                                            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-amber-400 rounded-full ring-2 ring-white" title="Artikel Unggulan"></span>
                                        @endif
                                    </div>
                                    <div class="max-w-md">
                                        <div class="font-black text-stone-900 text-sm group-hover:text-emerald-700 transition line-clamp-1">
                                            {{ $article->title }}
                                        </div>
                                        <div class="text-[11px] text-stone-400 font-mono mt-0.5 truncate">
                                            /berita/{{ $article->slug }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Kategori --}}
                            <td class="py-4 px-5 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black border 
                                    {{ $article->category == 'Kegiatan' ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : ($article->category == 'Pengumuman' ? 'bg-amber-50 text-amber-800 border-amber-200' : 'bg-blue-50 text-blue-800 border-blue-200') }}">
                                    {{ $article->category }}
                                </span>
                            </td>

                            {{-- Penulis --}}
                            <td class="py-4 px-5 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-stone-200 text-stone-700 flex items-center justify-center font-black text-[10px]">
                                        {{ strtoupper(substr($article->author ?? 'P', 0, 1)) }}
                                    </div>
                                    <span class="font-bold text-stone-700 text-xs">{{ $article->author ?? 'Humas RT 012' }}</span>
                                </div>
                            </td>

                            {{-- Tanggal --}}
                            <td class="py-4 px-5 whitespace-nowrap">
                                <div class="font-black text-stone-800 text-xs">
                                    {{ \Carbon\Carbon::parse($article->published_at)->translatedFormat('d M Y') }}
                                </div>
                                <div class="text-[10px] text-stone-400 font-medium mt-0.5">
                                    <i class="fa-regular fa-clock text-[9px] mr-1"></i>{{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="py-4 px-5 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ url('/berita/' . $article->slug) }}" target="_blank" class="p-2 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-600 hover:text-stone-900 transition" title="Lihat di Web Publik">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>

                                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 text-xs font-black border border-amber-200/80 transition" title="Edit Artikel">
                                        <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('admin.articles.delete', $article->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 hover:text-rose-900 border border-rose-200/80 transition" title="Hapus Artikel">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center text-stone-400">
                                <div class="w-16 h-16 rounded-3xl bg-stone-100 text-stone-400 flex items-center justify-center mx-auto text-2xl mb-4">
                                    <i class="fa-regular fa-newspaper"></i>
                                </div>
                                <div class="font-black text-base text-stone-800">Belum Ada Artikel Berita</div>
                                <div class="text-xs text-stone-400 mt-1 max-w-sm mx-auto">
                                    Publikasikan kabar warga, dokumentasi kegiatan, atau pengumuman resmi lingkungan RT 12 sekarang.
                                </div>
                                <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-xl bg-emerald-700 text-white text-xs font-black hover:bg-emerald-800 transition">
                                    <i class="fa-solid fa-plus text-[10px]"></i>
                                    <span>Tulis Berita Pertama</span>
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($articles->hasPages())
            <div class="p-5 border-t border-stone-100 bg-stone-50/50">
                {{ $articles->links() }}
            </div>
        @endif

    </div>

</div>
@endsection