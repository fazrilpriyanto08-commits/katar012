@extends('layouts.admin')

@section('title', 'Tulis Berita Baru - Admin Katar RT 012')
@section('page_title', 'Tulis Berita / Pengumuman Baru')

@section('content')
<div class="max-w-4xl space-y-6">

    <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm">
        
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Judul Artikel <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Kerja Bakti Massal Sambut Ramadhan di Lingkungan RT 012" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Kategori <span class="text-rose-500">*</span></label>
                    <select name="category" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="Berita">Berita</option>
                        <option value="Pengumuman">Pengumuman</option>
                        <option value="Kegiatan">Kegiatan</option>
                        <option value="Artikel">Artikel</option>
                    </select>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Penulis</label>
                    <input type="text" name="author" value="{{ old('author', 'Humas RT 012') }}" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <!-- Upload File / URL Gambar Sampul -->
            <div class="bg-emerald-50/60 border border-emerald-100 rounded-2xl p-4 space-y-3">
                <div class="font-extrabold text-xs text-emerald-900 flex items-center gap-1.5">
                    <i class="fa-solid fa-image text-emerald-700"></i>
                    <span>Gambar Sampul Berita</span>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Upload Foto dari HP / Komputer</label>
                        <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-stone-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 cursor-pointer bg-white border border-emerald-200 rounded-xl p-1">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Atau Gunakan Link URL Gambar</label>
                        <input type="text" name="image" value="{{ old('image') }}" placeholder="https://..." class="w-full bg-white border border-stone-200 rounded-xl px-4 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Ringkasan Singkat (Excerpt)</label>
                <textarea name="excerpt" rows="2" placeholder="Ringkasan 1-2 kalimat tentang artikel ini..." class="w-full bg-stone-50 border border-stone-200 rounded-xl p-4 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('excerpt') }}</textarea>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Isi Berita Lengkap <span class="text-rose-500">*</span></label>
                <textarea name="content" rows="10" required placeholder="Tuliskan berita atau pengumuman secara lengkap di sini..." class="w-full bg-stone-50 border border-stone-200 rounded-xl p-4 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('content') }}</textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" class="rounded border-stone-300 text-emerald-600 focus:ring-emerald-500">
                <label for="is_featured" class="text-xs font-semibold text-stone-700">Tampilkan sebagai Berita Sorotan di Beranda</label>
            </div>

            <div class="pt-4 flex items-center gap-3">
                <button type="submit" class="bg-gradient-to-r from-emerald-700 to-green-700 hover:from-emerald-800 hover:to-green-800 text-white font-bold px-6 py-3 rounded-xl text-xs shadow transition">
                    Publikasikan Berita
                </button>
                <a href="{{ route('admin.articles.index') }}" class="text-stone-500 hover:text-stone-800 text-xs font-bold px-4 py-3">
                    Batal
                </a>
            </div>
        </form>

    </div>

</div>
@endsection
