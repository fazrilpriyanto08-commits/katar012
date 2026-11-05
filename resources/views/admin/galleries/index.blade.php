@extends('layouts.admin')

@section('title', 'Pusat Dokumentasi Galeri - Admin Panel RT 012')
@section('page_title', 'Manajemen Dokumentasi Galeri')

@section('content')
<div class="space-y-6" x-data="{ uploadOpen: false }">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-stone-950 via-stone-900 to-indigo-950 p-6 sm:p-8 rounded-3xl border border-indigo-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-camera text-amber-400"></i>
                    <span>Divisi Dokumentasi & Media</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Pusat Arsip Foto & Dokumentasi RT 012
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Abadikan setiap momen kebersamaan, peringatan 17 Agustus, gotong royong, turnamen pemuda, dan kegiatan sosial warga RT 12 RW 05.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button @click="uploadOpen = !uploadOpen" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-black shadow-lg shadow-indigo-950/50 transition transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span x-text="uploadOpen ? 'Tutup Formulir' : '+ Unggah Foto Baru'"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Upload Form Card (Collapsible) -->
    <div x-show="uploadOpen" x-cloak x-transition class="bg-white rounded-3xl border border-stone-200/80 p-6 shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-stone-100 pb-3">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-photo-film text-indigo-700 text-sm"></i>
                <h3 class="text-xs font-black text-stone-900 uppercase tracking-wider">Unggah Dokumentasi Kegiatan Baru</h3>
            </div>
            <button @click="uploadOpen = false" class="text-stone-400 hover:text-stone-700 text-xs font-bold">
                <i class="fa-solid fa-xmark"></i> Batal
            </button>
        </div>

        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <label class="block text-xs font-black text-stone-700">Judul Kegiatan / Momen <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Semarak Karnaval 17-an RT 12" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-black text-stone-700">Kategori Kegiatan <span class="text-rose-500">*</span></label>
                    <input type="text" name="category" value="{{ old('category') }}" required placeholder="Peringatan HUT RI / Olahraga / Sosial" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-black text-stone-700">Tanggal Kegiatan</label>
                    <input type="date" name="activity_date" value="{{ old('activity_date') }}" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-indigo-50/50 border border-indigo-100 rounded-2xl p-4">
                <div class="space-y-1">
                    <label class="block text-xs font-black text-indigo-950 flex items-center gap-1.5">
                        <i class="fa-solid fa-cloud-arrow-up text-indigo-600"></i>
                        <span>Pilih File Gambar dari Komputer / HP</span>
                    </label>
                    <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-stone-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 cursor-pointer bg-white border border-indigo-200 rounded-xl p-1">
                    <p class="text-[10px] text-stone-500 font-medium">Mendukung format JPG, PNG, WEBP (Maksimal 10 MB)</p>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-black text-stone-700">Atau Tautan URL Gambar (Opsional)</label>
                    <input type="text" name="image_url" value="{{ old('image_url') }}" placeholder="https://..." class="w-full bg-white border border-stone-200 rounded-xl px-3.5 py-2 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <p class="text-[10px] text-stone-400">Kosongkan bila sudah memilih file gambar di samping.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
                <div class="sm:col-span-3 space-y-1">
                    <label class="block text-xs font-black text-stone-700">Keterangan Singkat Foto</label>
                    <input type="text" name="description" value="{{ old('description') }}" placeholder="Ceritakan kisah atau keseruan momen dalam foto ini..." class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black py-2.5 px-4 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        <span>Simpan Foto</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Gallery Grid Presentation -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @forelse($galleries as $item)
            <div class="bg-white rounded-3xl border border-stone-200/80 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                <div class="relative aspect-video overflow-hidden bg-stone-100">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <span class="absolute top-3 left-3 bg-stone-900/85 backdrop-blur-md text-amber-300 text-[10px] font-black px-2.5 py-0.5 rounded-full border border-stone-700 shadow-sm">
                        {{ $item->category }}
                    </span>
                </div>

                <div class="p-4 space-y-2 flex-grow flex flex-col justify-between">
                    <div>
                        <h4 class="font-black text-stone-900 text-sm group-hover:text-indigo-600 transition truncate leading-snug">
                            {{ $item->title }}
                        </h4>
                        <p class="text-xs text-stone-500 mt-1 line-clamp-2 leading-relaxed">
                            {{ $item->description ?: 'Dokumentasi kegiatan resmi lingkungan RT 12 RW 05.' }}
                        </p>
                    </div>

                    <div class="pt-3 border-t border-stone-100 flex items-center justify-between text-xs">
                        <span class="text-stone-400 font-bold text-[10px] flex items-center gap-1">
                            <i class="fa-regular fa-calendar text-[9px]"></i>
                            <span>{{ $item->activity_date ? \Carbon\Carbon::parse($item->activity_date)->format('d M Y') : '-' }}</span>
                        </span>

                        <form action="{{ route('admin.galleries.delete', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto dokumentasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 transition" title="Hapus Foto">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-stone-200 text-stone-400 text-xs">
                <div class="w-16 h-16 rounded-3xl bg-stone-100 text-stone-400 flex items-center justify-center mx-auto text-2xl mb-4">
                    <i class="fa-regular fa-images"></i>
                </div>
                <div class="font-black text-base text-stone-800">Belum Ada Foto Dokumentasi</div>
                <div class="text-xs text-stone-400 mt-1 max-w-sm mx-auto">
                    Unggah foto keseruan kegiatan, gotong royong, atau perayaan lingkungan sekarang.
                </div>
                <button @click="uploadOpen = true" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-xl bg-indigo-600 text-white text-xs font-black hover:bg-indigo-700 transition">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    <span>Unggah Foto Pertama</span>
                </button>
            </div>
        @endforelse
    </div>

    @if($galleries->hasPages())
        <div class="p-4 bg-white rounded-2xl border border-stone-200 shadow-sm">
            {{ $galleries->links() }}
        </div>
    @endif

</div>
@endsection