@extends('layouts.admin')

@section('title', 'Manajemen Hall of Fame - Admin Panel')
@section('page_title', 'Hall of Fame & Prestasi Warga')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-stone-950 via-stone-900 to-amber-950 p-6 sm:p-8 rounded-3xl border border-amber-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-yellow-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-trophy text-amber-400"></i>
                    <span>Apresiasi Tokoh & Prestasi Lingkungan</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Hall of Fame & Penghargaan Warga RT 12
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Dokumentasikan para juara perlombaan 17 Agustus, pemuda berprestasi, tokoh inspiratif, sesepuh yang berjasa, dan teladan lingkungan RT 12 RW 05.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <span class="px-4 py-2 rounded-2xl bg-white/10 text-amber-300 text-xs font-bold border border-white/20">
                    <i class="fa-solid fa-medal mr-1.5"></i> Penghargaan Abadi
                </span>
            </div>
        </div>
    </div>

    {{-- Top Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-stone-500 uppercase tracking-wider">Total Tokoh & Prestasi</span>
            <div class="text-2xl font-black text-stone-900 mt-1">{{ $honorees->total() }}</div>
        </div>
        <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 text-xl">
            <i class="fa-solid fa-trophy"></i>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-stone-500 uppercase tracking-wider">Kategori Terdaftar</span>
            <div class="text-2xl font-black text-emerald-700 mt-1">{{ count($categories) }}</div>
        </div>
        <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-xl">
            <i class="fa-solid fa-shapes"></i>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm flex items-center justify-between">
        <div>
            <span class="text-xs font-bold text-stone-500 uppercase tracking-wider">Tahun Angkatan</span>
            <div class="text-2xl font-black text-stone-900 mt-1">{{ $availableYears->count() }} Tahun</div>
        </div>
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
    </div>
</div>

{{-- Add New Honoree Form --}}
<div class="bg-white rounded-2xl border border-stone-200 shadow-sm mb-8" x-data="{ formOpen: false }">
    <button @click="formOpen = !formOpen" class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-stone-50 transition rounded-2xl">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center text-stone-950 font-bold shadow-sm">
                <i class="fa-solid fa-plus text-base"></i>
            </div>
            <div>
                <div class="font-bold text-sm text-stone-800">Tambah Tokoh / Juara Prestasi</div>
                <div class="text-xs text-stone-400">Catat peraih piala, pemuda inspiratif, atau tokoh teladan RT 012</div>
            </div>
        </div>
        <i class="fa-solid fa-chevron-down text-stone-400 transition" :class="formOpen && 'rotate-180'"></i>
    </button>

    <div x-show="formOpen" x-cloak x-transition class="px-6 pb-6 border-t border-stone-100">
        <form action="{{ route('admin.hall-of-fame.store') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Nama --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Nama Tokoh / Tim / Warga <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" required placeholder="Contoh: Dimas Surya Wicaksono"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                {{-- Judul Prestasi --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Prestasi / Penghargaan <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" required placeholder="Contoh: Juara 1 Lomba Panjat Pinang HUT RI"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Kategori <span class="text-rose-500">*</span></label>
                    <select name="category" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tahun --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Tahun <span class="text-rose-500">*</span></label>
                    <input type="number" name="year" required value="{{ date('Y') }}" min="2000" max="2099"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                {{-- Gelar Badge --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Gelar / Badge <span class="text-rose-500">*</span></label>
                    <select name="award_badge" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
                        @foreach($badges as $badge)
                            <option value="{{ $badge }}">{{ $badge }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Prioritas Tampil --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Urutan Prioritas (0 = Paling Depan)</label>
                    <input type="number" name="order" value="0" min="0"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            {{-- Foto Dokumen/Piala --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Upload Foto dari Galeri HP / Komputer</label>
                    <input type="file" name="photo_file" accept="image/*"
                           class="w-full px-3.5 py-2 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-amber-100 file:text-stone-900 hover:file:bg-amber-200">
                    <p class="text-[11px] text-stone-400 mt-1">Maksimal 10MB (JPG, PNG, WEBP).</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Atau Input URL Foto Online</label>
                    <input type="url" name="photo_url" placeholder="https://..."
                           class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            {{-- Cerita / Deskripsi --}}
            <div>
                <label class="block text-xs font-bold text-stone-600 mb-1.5">Cerita Singkat / Kisah Inspiratif</label>
                <textarea name="description" rows="3" placeholder="Ceritakan bagaimana perjuangan atau keberhasilan warga/pemuda ini..."
                          class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 resize-none"></textarea>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-stone-950 font-black text-sm px-6 py-2.5 rounded-xl shadow transition">
                    <i class="fa-solid fa-trophy mr-1.5"></i> Abadikan di Hall of Fame
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Filter & Search --}}
<div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-5 mb-6">
    <form method="GET" action="{{ route('admin.hall-of-fame.index') }}" class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1 relative">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama tokoh / prestasi..."
                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500">
        </div>

        <select name="category" class="px-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ ($category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>

        <select name="year" class="px-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
            <option value="">Semua Tahun</option>
            @foreach($availableYears as $yr)
                <option value="{{ $yr }}" {{ ($year ?? '') == $yr ? 'selected' : '' }}>Tahun {{ $yr }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-stone-800 hover:bg-stone-900 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition">
            <i class="fa-solid fa-filter mr-1"></i> Filter
        </button>
    </form>
</div>

{{-- Hall of Fame Table --}}
<div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
    @if($honorees->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-stone-50 border-b border-stone-200">
                    <tr>
                        <th class="px-5 py-3.5 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Tokoh / Tim</th>
                        <th class="px-5 py-3.5 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Prestasi</th>
                        <th class="px-5 py-3.5 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-5 py-3.5 text-center text-xs font-bold text-stone-500 uppercase tracking-wider">Tahun</th>
                        <th class="px-5 py-3.5 text-center text-xs font-bold text-stone-500 uppercase tracking-wider">Badge</th>
                        <th class="px-5 py-3.5 text-center text-xs font-bold text-stone-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach($honorees as $item)
                        <tr class="hover:bg-stone-50 transition" x-data="{ editing: false }">
                            {{-- View Mode --}}
                            <template x-if="!editing">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($item->photo)
                                            <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="w-12 h-12 rounded-xl object-cover border border-amber-300 shadow-sm">
                                        @else
                                            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center font-bold">
                                                <i class="fa-solid fa-trophy"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-extrabold text-stone-900">{{ $item->name }}</div>
                                            <div class="text-[11px] text-stone-400">Prioritas: {{ $item->order }}</div>
                                        </div>
                                    </div>
                                </td>
                            </template>

                            <template x-if="!editing">
                                <td class="px-5 py-4">
                                    <div class="font-bold text-stone-800">{{ $item->title }}</div>
                                    @if($item->description)
                                        <div class="text-xs text-stone-400 mt-0.5 line-clamp-1 italic">{{ $item->description }}</div>
                                    @endif
                                </td>
                            </template>

                            <template x-if="!editing">
                                <td class="px-5 py-4">
                                    <span class="text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 px-2.5 py-1 rounded-lg">
                                        {{ $item->category }}
                                    </span>
                                </td>
                            </template>

                            <template x-if="!editing">
                                <td class="px-5 py-4 text-center font-extrabold text-stone-700">
                                    {{ $item->year }}
                                </td>
                            </template>

                            <template x-if="!editing">
                                <td class="px-5 py-4 text-center">
                                    <span class="text-xs font-black bg-amber-100 text-stone-900 border border-amber-300 px-2.5 py-1 rounded-full shadow-xs">
                                        {{ $item->award_badge }}
                                    </span>
                                </td>
                            </template>

                            <template x-if="!editing">
                                <td class="px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button @click="editing = true" class="p-2 rounded-lg text-blue-600 hover:bg-blue-50 transition" title="Edit">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </button>
                                        <form action="{{ route('admin.hall-of-fame.delete', $item) }}" method="POST" onsubmit="return confirm('Hapus data penghargaan {{ $item->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </template>

                            {{-- Inline Edit Mode --}}
                            <template x-if="editing">
                                <td colspan="6" class="px-5 py-5 bg-amber-50/40">
                                    <form action="{{ route('admin.hall-of-fame.update', $item) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-3 items-end">
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Nama</label>
                                                <input type="text" name="name" value="{{ $item->name }}" required
                                                       class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-amber-500">
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Prestasi</label>
                                                <input type="text" name="title" value="{{ $item->title }}" required
                                                       class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-amber-500">
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Kategori</label>
                                                <select name="category" required class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-amber-500 bg-white">
                                                    @foreach($categories as $cat)
                                                        <option value="{{ $cat }}" {{ $item->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Tahun</label>
                                                <input type="number" name="year" value="{{ $item->year }}" min="2000" max="2099" required
                                                       class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-amber-500">
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Badge</label>
                                                <select name="award_badge" required class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-amber-500 bg-white">
                                                    @foreach($badges as $b)
                                                        <option value="{{ $b }}" {{ $item->award_badge == $b ? 'selected' : '' }}>{{ $b }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Ganti Foto</label>
                                                <input type="file" name="photo_file" accept="image/*"
                                                       class="w-full text-[10px] file:mr-1 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:bg-amber-100 file:text-stone-900">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-3">
                                            <div class="sm:col-span-2">
                                                <label class="text-[10px] font-bold text-stone-500">Kisah / Deskripsi</label>
                                                <input type="text" name="description" value="{{ $item->description }}"
                                                       class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-amber-500">
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Urutan Prioritas</label>
                                                <input type="number" name="order" value="{{ $item->order }}" min="0"
                                                       class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-amber-500">
                                            </div>
                                        </div>

                                        <div class="flex gap-2 mt-3 justify-end">
                                            <button type="button" @click="editing = false" class="px-4 py-2 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-600 text-xs font-bold transition">
                                                Batal
                                            </button>
                                            <button type="submit" class="px-4 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-stone-950 text-xs font-black transition shadow">
                                                <i class="fa-solid fa-check mr-1"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </template>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-5 border-t border-stone-100">
            {{ $honorees->withQueryString()->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-4 text-amber-500">
                <i class="fa-solid fa-trophy text-2xl"></i>
            </div>
            <h3 class="font-bold text-stone-600">Belum Ada Data Hall of Fame</h3>
            <p class="text-xs text-stone-400 mt-1">Gunakan formulir "Tambah Tokoh / Juara Prestasi" di atas untuk menambahkan prestasi baru.</p>
        </div>
    @endif
</div>

@endsection
