@extends('layouts.admin')

@section('title', 'Struktur Pengurus - Admin Katar RT 012')
@section('page_title', 'Manajemen Struktur Organisasi')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-stone-950 via-stone-900 to-emerald-950 p-6 sm:p-8 rounded-3xl border border-emerald-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-sitemap text-amber-400"></i>
                    <span>Bagan & Kepengurusan Organisasi</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Struktur Pengurus & Bagan Organisasi
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Kelola susunan nama-nama pimpinan (Ketua, Wakil, Sekertaris, Bendahara) dan seksi-seksi divisi kepanitiaan Unit Penghubung Warga RT 12 RW 05.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <span class="px-4 py-2 rounded-2xl bg-white/10 text-emerald-300 text-xs font-bold border border-white/20">
                    <i class="fa-solid fa-users-line mr-1.5"></i> Bagan Resmi RT 12
                </span>
            </div>
        </div>
    </div>

    <!-- Add Structure Card -->
    <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-sm">
        <h3 class="font-extrabold text-stone-900 text-sm mb-4">Tambah Anggota Pengurus Baru</h3>
        
        <form action="{{ route('admin.structures.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Nama Lengkap *</label>
                    <input type="text" name="name" required placeholder="Nama pengurus" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Jabatan *</label>
                    <input type="text" name="position" required placeholder="Contoh: Ketua Karang Taruna" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Divisi / Seksi *</label>
                    <input type="text" name="division" required placeholder="Contoh: BPH / Sie Olahraga / Humas" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-emerald-50/60 border border-emerald-100 rounded-2xl p-4">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-emerald-900">Upload Foto Pengurus (Dari HP/Laptop)</label>
                    <input type="file" name="photo_file" accept="image/*" class="w-full text-xs text-stone-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 cursor-pointer bg-white border border-emerald-200 rounded-xl p-1">
                </div>
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Atau Masukkan URL Foto (Opsional)</label>
                    <input type="text" name="photo" placeholder="https://..." class="w-full bg-white border border-stone-200 rounded-xl px-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 items-end">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">No. WhatsApp / HP</label>
                    <input type="text" name="phone" placeholder="0812xxxx" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Urutan Tampil (Angka)</label>
                    <input type="number" name="order" value="10" placeholder="1, 2, 3..." class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-700 to-green-700 hover:from-emerald-800 hover:to-green-800 text-white font-bold py-2.5 px-5 rounded-xl text-xs shadow transition">
                        <i class="fa-solid fa-user-plus mr-1"></i> Simpan Pengurus
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Structure List Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($structures as $s)
            <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm text-center flex flex-col items-center justify-between group">
                <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-emerald-600 shadow mb-3">
                    <img src="{{ $s->photo ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80' }}" alt="{{ $s->name }}" class="w-full h-full object-cover">
                </div>

                <div class="space-y-1">
                    <span class="text-[10px] font-black text-emerald-700 uppercase">{{ $s->position }}</span>
                    <h4 class="font-extrabold text-stone-900 text-sm">{{ $s->name }}</h4>
                    <p class="text-[11px] text-stone-400">{{ $s->division }}</p>
                    <div class="text-[10px] text-stone-500">Urutan: #{{ $s->order }}</div>
                </div>

                <div class="pt-3 mt-3 border-t border-stone-100 w-full flex items-center justify-between text-xs">
                    <span class="text-stone-400 text-[11px]">{{ $s->phone ?: '-' }}</span>
                    <form action="{{ route('admin.structures.delete', $s->id) }}" method="POST" onsubmit="return confirm('Hapus pengurus ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold p-1">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
