@extends('layouts.admin')

@section('title', 'Tambah Agenda Baru - Admin Katar RT 012')
@section('page_title', 'Tambah Agenda Kegiatan Baru')

@section('content')
<div class="max-w-4xl space-y-6">

    <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm">
        
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Nama Kegiatan <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Kerja Bakti Massal Minggu Pagi" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Tanggal <span class="text-rose-500">*</span></label>
                    <input type="date" name="event_date" value="{{ old('event_date') }}" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Jam Mulai</label>
                    <input type="text" name="start_time" value="{{ old('start_time', '07:30') }}" placeholder="07:30" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Jam Selesai</label>
                    <input type="text" name="end_time" value="{{ old('end_time', '11:00 WIB') }}" placeholder="11:00 WIB" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Lokasi / Tempat <span class="text-rose-500">*</span></label>
                    <input type="text" name="location" value="{{ old('location') }}" required placeholder="Contoh: Balai Warga RT 012" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Status Kegiatan</label>
                    <select name="status" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="Akan Datang">Akan Datang</option>
                        <option value="Sedang Berlangsung">Sedang Berlangsung</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Penyelenggara</label>
                <input type="text" name="organizer" value="{{ old('organizer', 'Unit Penghubung Warga RT 12') }}" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <!-- Upload File / URL Poster Banner -->
            <div class="bg-emerald-50/60 border border-emerald-100 rounded-2xl p-4 space-y-3">
                <div class="font-extrabold text-xs text-emerald-900 flex items-center gap-1.5">
                    <i class="fa-solid fa-image text-emerald-700"></i>
                    <span>Poster / Banner Kegiatan</span>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Upload Poster dari HP / Komputer</label>
                        <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-stone-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 cursor-pointer bg-white border border-emerald-200 rounded-xl p-1">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Atau Gunakan Link URL Poster</label>
                        <input type="text" name="image" value="{{ old('image') }}" placeholder="https://..." class="w-full bg-white border border-stone-200 rounded-xl px-4 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Deskripsi Rinci Kegiatan <span class="text-rose-500">*</span></label>
                <textarea name="description" rows="5" required placeholder="Jelaskan tujuan kegiatan, susunan acara, peralatan yang perlu dibawa warga, dll..." class="w-full bg-stone-50 border border-stone-200 rounded-xl p-4 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('description') }}</textarea>
            </div>

            <div class="pt-4 flex items-center gap-3">
                <button type="submit" class="bg-gradient-to-r from-emerald-700 to-green-700 hover:from-emerald-800 hover:to-green-800 text-white font-bold px-6 py-3 rounded-xl text-xs shadow transition">
                    Simpan Agenda Kegiatan
                </button>
                <a href="{{ route('admin.events.index') }}" class="text-stone-500 hover:text-stone-800 text-xs font-bold px-4 py-3">
                    Batal
                </a>
            </div>
        </form>

    </div>

</div>
@endsection
