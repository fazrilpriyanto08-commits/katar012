@extends('layouts.admin')

@section('title', 'Edit Agenda Kegiatan - Admin Katar RT 012')
@section('page_title', 'Edit Agenda Kegiatan')

@section('content')
<div class="max-w-4xl space-y-6">

    <div class="bg-white rounded-2xl border border-stone-200 p-6 sm:p-8 shadow-sm">
        
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Nama Kegiatan <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Tanggal <span class="text-rose-500">*</span></label>
                    <input type="date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Jam Mulai</label>
                    <input type="text" name="start_time" value="{{ old('start_time', $event->start_time) }}" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Jam Selesai</label>
                    <input type="text" name="end_time" value="{{ old('end_time', $event->end_time) }}" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Lokasi / Tempat <span class="text-rose-500">*</span></label>
                    <input type="text" name="location" value="{{ old('location', $event->location) }}" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Status Kegiatan</label>
                    <select name="status" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="Akan Datang" {{ old('status', $event->status) == 'Akan Datang' ? 'selected' : '' }}>Akan Datang</option>
                        <option value="Sedang Berlangsung" {{ old('status', $event->status) == 'Sedang Berlangsung' ? 'selected' : '' }}>Sedang Berlangsung</option>
                        <option value="Selesai" {{ old('status', $event->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Penyelenggara</label>
                <input type="text" name="organizer" value="{{ old('organizer', $event->organizer) }}" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <!-- Upload File / URL Poster Banner -->
            <div class="bg-emerald-50/60 border border-emerald-100 rounded-2xl p-4 space-y-3">
                <div class="font-extrabold text-xs text-emerald-900 flex items-center justify-between">
                    <span class="flex items-center gap-1.5">
                        <i class="fa-solid fa-image text-emerald-700"></i>
                        <span>Poster / Banner Kegiatan</span>
                    </span>
                    @if($event->image)
                        <span class="text-[10px] text-stone-500 font-normal">Sudah terpasang</span>
                    @endif
                </div>

                @if($event->image)
                    <div class="w-24 h-16 rounded-xl overflow-hidden border border-stone-200">
                        <img src="{{ $event->image }}" alt="Poster" class="w-full h-full object-cover">
                    </div>
                @endif
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Ganti Poster dari HP / Komputer</label>
                        <input type="file" name="image_file" accept="image/*" class="w-full text-xs text-stone-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 cursor-pointer bg-white border border-emerald-200 rounded-xl p-1">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-700 mb-1">Atau Ubah Link URL Poster</label>
                        <input type="text" name="image" value="{{ old('image', $event->image) }}" class="w-full bg-white border border-stone-200 rounded-xl px-4 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Deskripsi Rinci Kegiatan <span class="text-rose-500">*</span></label>
                <textarea name="description" rows="5" required class="w-full bg-stone-50 border border-stone-200 rounded-xl p-4 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="pt-4 flex items-center gap-3">
                <button type="submit" class="bg-gradient-to-r from-emerald-700 to-green-700 hover:from-emerald-800 hover:to-green-800 text-white font-bold px-6 py-3 rounded-xl text-xs shadow transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.events.index') }}" class="text-stone-500 hover:text-stone-800 text-xs font-bold px-4 py-3">
                    Batal
                </a>
            </div>
        </form>

    </div>

</div>
@endsection
