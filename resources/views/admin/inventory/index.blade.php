@extends('layouts.admin')

@section('title', 'Inventaris Barang - Admin Panel')
@section('page_title', 'Inventaris Barang & Perlengkapan')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-stone-950 via-stone-900 to-amber-950 p-6 sm:p-8 rounded-3xl border border-amber-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-boxes-stacked text-amber-400"></i>
                    <span>Divisi Perlengkapan & Logistik RT 12</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Gudang Aset & Inventaris Perlengkapan
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Kelola seluruh aset milik bersama (tenda, sound system, meja kursi, terpal, alat kebersihan, dan perlengkapan lomba) beserta kondisi fisik dan lokasi penyimpanannya.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <span class="px-4 py-2 rounded-2xl bg-white/10 text-amber-300 text-xs font-bold border border-white/20">
                    <i class="fa-solid fa-warehouse mr-1.5"></i> Gudang Balai Warga RT 12
                </span>
            </div>
        </div>
    </div>

    {{-- Summary Cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-bold text-stone-500 uppercase tracking-wider">Total Unit</span>
            <div class="w-9 h-9 bg-emerald-50 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-cubes text-emerald-600"></i>
            </div>
        </div>
        <div class="text-2xl font-black text-stone-900">{{ number_format($totalItems) }}</div>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-bold text-stone-500 uppercase tracking-wider">Jenis Barang</span>
            <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-tags text-blue-600"></i>
            </div>
        </div>
        <div class="text-2xl font-black text-stone-900">{{ $totalTypes }}</div>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-bold text-stone-500 uppercase tracking-wider">Kondisi Baik</span>
            <div class="w-9 h-9 bg-emerald-50 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
            </div>
        </div>
        <div class="text-2xl font-black text-emerald-700">{{ $goodCondition }}</div>
    </div>
    <div class="bg-white rounded-2xl p-5 border border-stone-200 shadow-sm">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-bold text-stone-500 uppercase tracking-wider">Perlu Perbaikan</span>
            <div class="w-9 h-9 bg-rose-50 rounded-lg flex items-center justify-center">
                <i class="fa-solid fa-wrench text-rose-500"></i>
            </div>
        </div>
        <div class="text-2xl font-black text-rose-600">{{ $needRepair }}</div>
    </div>
</div>

{{-- Add New Item Form --}}
<div class="bg-white rounded-2xl border border-stone-200 shadow-sm mb-8" x-data="{ formOpen: false }">
    <button @click="formOpen = !formOpen" class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-stone-50 transition rounded-2xl">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-600 rounded-xl flex items-center justify-center">
                <i class="fa-solid fa-plus text-white"></i>
            </div>
            <div>
                <div class="font-bold text-sm text-stone-800">Tambah Barang Baru</div>
                <div class="text-xs text-stone-400">Catat barang inventaris baru milik RT 012</div>
            </div>
        </div>
        <i class="fa-solid fa-chevron-down text-stone-400 transition" :class="formOpen && 'rotate-180'"></i>
    </button>

    <div x-show="formOpen" x-cloak x-transition class="px-6 pb-6 border-t border-stone-100">
        <form action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- Nama Barang --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Nama Barang <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" required placeholder="Contoh: Tenda Kerucut 3x3"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Kategori <span class="text-rose-500">*</span></label>
                    <select name="category" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jumlah & Satuan --}}
                <div class="flex gap-2">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-stone-600 mb-1.5">Jumlah <span class="text-rose-500">*</span></label>
                        <input type="number" name="quantity" required min="1" value="1"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-stone-600 mb-1.5">Satuan <span class="text-rose-500">*</span></label>
                        <select name="unit" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            @foreach($units as $unit)
                                <option value="{{ $unit }}">{{ $unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Kondisi --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Kondisi <span class="text-rose-500">*</span></label>
                    <select name="condition" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                        @foreach($conditions as $cond)
                            <option value="{{ $cond }}" {{ $cond == 'Baik' ? 'selected' : '' }}>{{ $cond }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Lokasi Penyimpanan --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Lokasi Simpan</label>
                    <input type="text" name="storage_location" placeholder="Contoh: Gudang Balai RT"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                {{-- Tanggal Perolehan --}}
                <div>
                    <label class="block text-xs font-bold text-stone-600 mb-1.5">Tanggal Perolehan</label>
                    <input type="date" name="acquired_date"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            {{-- Foto Barang --}}
            <div>
                <label class="block text-xs font-bold text-stone-600 mb-1.5">Foto Barang</label>
                <input type="file" name="photo_file" accept="image/*"
                       class="w-full px-3.5 py-2 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                <p class="text-[11px] text-stone-400 mt-1.5"><i class="fa-solid fa-camera mr-1"></i> Bisa langsung foto dari HP/kamera. Maks 10MB.</p>
            </div>

            {{-- Catatan --}}
            <div>
                <label class="block text-xs font-bold text-stone-600 mb-1.5">Catatan / Keterangan</label>
                <textarea name="notes" rows="2" placeholder="Keterangan tambahan tentang barang ini..."
                          class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 resize-none"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-sm px-6 py-2.5 rounded-xl shadow-sm transition">
                    <i class="fa-solid fa-plus mr-2"></i> Simpan Barang
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Filter & Search --}}
<div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-5 mb-6">
    <form method="GET" action="{{ route('admin.inventory.index') }}" class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1 relative">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari barang..."
                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
        </div>
        <select name="category" class="px-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ ($category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <select name="condition" class="px-4 py-2.5 rounded-xl border border-stone-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
            <option value="">Semua Kondisi</option>
            @foreach($conditions as $cond)
                <option value="{{ $cond }}" {{ ($condition ?? '') == $cond ? 'selected' : '' }}>{{ $cond }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-stone-800 hover:bg-stone-900 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition">
            <i class="fa-solid fa-filter mr-1"></i> Filter
        </button>
    </form>
</div>

{{-- Inventory Table --}}
<div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
    @if($items->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-stone-50 border-b border-stone-200">
                    <tr>
                        <th class="px-5 py-3.5 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Barang</th>
                        <th class="px-5 py-3.5 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-5 py-3.5 text-center text-xs font-bold text-stone-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-5 py-3.5 text-center text-xs font-bold text-stone-500 uppercase tracking-wider">Kondisi</th>
                        <th class="px-5 py-3.5 text-left text-xs font-bold text-stone-500 uppercase tracking-wider">Lokasi Simpan</th>
                        <th class="px-5 py-3.5 text-center text-xs font-bold text-stone-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach($items as $item)
                        <tr class="hover:bg-stone-50 transition" x-data="{ editing: false }">
                            {{-- View Mode --}}
                            <template x-if="!editing">
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($item->photo)
                                            <img src="{{ $item->photo }}" alt="{{ $item->name }}" class="w-10 h-10 rounded-lg object-cover border border-stone-200">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-stone-100 flex items-center justify-center">
                                                <i class="fa-solid fa-box text-stone-300"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-stone-800">{{ $item->name }}</div>
                                            @if($item->notes)
                                                <div class="text-xs text-stone-400 mt-0.5">{{ Str::limit($item->notes, 40) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </template>
                            <template x-if="!editing">
                                <td class="px-5 py-4">
                                    <span class="text-xs font-medium bg-stone-100 text-stone-600 px-2.5 py-1 rounded-lg">{{ $item->category }}</span>
                                </td>
                            </template>
                            <template x-if="!editing">
                                <td class="px-5 py-4 text-center font-bold text-stone-800">
                                    {{ $item->quantity }} <span class="text-stone-400 font-normal">{{ $item->unit }}</span>
                                </td>
                            </template>
                            <template x-if="!editing">
                                <td class="px-5 py-4 text-center">
                                    @php
                                        $condClasses = match($item->condition) {
                                            'Baik' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'Cukup Baik' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            'Rusak Ringan' => 'bg-orange-50 text-orange-700 border-orange-200',
                                            'Rusak Berat' => 'bg-rose-50 text-rose-700 border-rose-200',
                                            default => 'bg-stone-50 text-stone-700 border-stone-200',
                                        };
                                    @endphp
                                    <span class="text-xs font-bold px-2.5 py-1 rounded-full border {{ $condClasses }}">
                                        {{ $item->condition }}
                                    </span>
                                </td>
                            </template>
                            <template x-if="!editing">
                                <td class="px-5 py-4 text-xs text-stone-500">
                                    {{ $item->storage_location ?: '-' }}
                                </td>
                            </template>
                            <template x-if="!editing">
                                <td class="px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button @click="editing = true" class="p-2 rounded-lg text-blue-600 hover:bg-blue-50 transition" title="Edit">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </button>
                                        <form action="{{ route('admin.inventory.delete', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus barang {{ $item->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </template>

                            {{-- Edit Mode (inline) --}}
                            <template x-if="editing">
                                <td colspan="6" class="px-5 py-4">
                                    <form action="{{ route('admin.inventory.update', $item) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 items-end">
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Nama</label>
                                                <input type="text" name="name" value="{{ $item->name }}" required
                                                       class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500">
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Kategori</label>
                                                <select name="category" required class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500 bg-white">
                                                    @foreach($categories as $cat)
                                                        <option value="{{ $cat }}" {{ $item->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="flex gap-1.5">
                                                <div class="flex-1">
                                                    <label class="text-[10px] font-bold text-stone-500">Jumlah</label>
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" required
                                                           class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500">
                                                </div>
                                                <div class="flex-1">
                                                    <label class="text-[10px] font-bold text-stone-500">Satuan</label>
                                                    <select name="unit" required class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500 bg-white">
                                                        @foreach($units as $u)
                                                            <option value="{{ $u }}" {{ $item->unit == $u ? 'selected' : '' }}>{{ $u }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Kondisi</label>
                                                <select name="condition" required class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500 bg-white">
                                                    @foreach($conditions as $c)
                                                        <option value="{{ $c }}" {{ $item->condition == $c ? 'selected' : '' }}>{{ $c }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Lokasi Simpan</label>
                                                <input type="text" name="storage_location" value="{{ $item->storage_location }}"
                                                       class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500">
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Foto Baru</label>
                                                <input type="file" name="photo_file" accept="image/*"
                                                       class="w-full text-[10px] file:mr-1 file:py-1 file:px-2 file:rounded file:border-0 file:text-[10px] file:bg-emerald-50 file:text-emerald-700">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-2 gap-3 mt-3">
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Tanggal Perolehan</label>
                                                <input type="date" name="acquired_date" value="{{ $item->acquired_date ? $item->acquired_date->format('Y-m-d') : '' }}"
                                                       class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500">
                                            </div>
                                            <div>
                                                <label class="text-[10px] font-bold text-stone-500">Catatan</label>
                                                <input type="text" name="notes" value="{{ $item->notes }}" placeholder="Keterangan..."
                                                       class="w-full px-2.5 py-2 rounded-lg border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500">
                                            </div>
                                        </div>
                                        <div class="flex gap-2 mt-3 justify-end">
                                            <button type="button" @click="editing = false" class="px-4 py-2 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-600 text-xs font-bold transition">
                                                Batal
                                            </button>
                                            <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition">
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
            {{ $items->withQueryString()->links('pagination::tailwind') }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="w-16 h-16 bg-stone-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-box-open text-2xl text-stone-300"></i>
            </div>
            <h3 class="font-bold text-stone-600">Belum Ada Barang Inventaris</h3>
            <p class="text-xs text-stone-400 mt-1">Klik tombol "Tambah Barang Baru" di atas untuk mulai mencatat.</p>
        </div>
    @endif
</div>

@endsection
