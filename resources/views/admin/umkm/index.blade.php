@extends('layouts.admin')

@section('title', 'Lapak UMKM Warga - Admin Panel RT 012')
@section('page_title', 'Manajemen Pasar & UMKM Warga')

@section('content')
<div class="space-y-6" x-data="{ createModal: false, editModal: false, activeItem: {} }">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-stone-950 via-stone-900 to-amber-950 p-6 sm:p-8 rounded-3xl border border-amber-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-basket-shopping text-amber-400"></i>
                    <span>Ekonomi & Usaha Warga RT 12 RW 05</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Direktori Pasar & Lapak UMKM Warga
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Kelola etalase usaha mandiri, kuliner, toko sembako, dan jasa milik warga RT 012 RW 05 Kelurahan Lenteng Agung untuk mendorong perputaran ekonomi lokal.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button @click="createModal = true" class="px-4 py-2.5 rounded-2xl bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-stone-950 font-black text-xs shadow-lg transition flex items-center gap-2">
                    <i class="fa-solid fa-plus-circle"></i>
                    <span>Tambah Lapak Baru</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs font-bold text-stone-400 uppercase tracking-wider">Total Lapak</span>
            <div class="text-2xl font-black text-stone-900 mt-1">{{ $metrics['total'] }} Usaha</div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Lapak Aktif</span>
            <div class="text-2xl font-black text-emerald-600 mt-1">{{ $metrics['active'] }} Tayang</div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Kuliner & Jajanan</span>
            <div class="text-2xl font-black text-amber-600 mt-1">{{ $metrics['kuliner'] }} Menu</div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Jasa & Servis</span>
            <div class="text-2xl font-black text-blue-600 mt-1">{{ $metrics['jasa'] }} Layanan</div>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white p-4 rounded-2xl border border-stone-200 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0">
            <a href="{{ route('admin.umkm.index') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ !request('category') ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Semua Kategori
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('admin.umkm.index', ['category' => $cat]) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ request('category') == $cat ? 'bg-stone-900 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <form action="{{ route('admin.umkm.index') }}" method="GET" class="relative sm:w-64">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama toko / pemilik..."
                   class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-8 pr-3 py-1.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <i class="fa-solid fa-search absolute left-3 top-2 text-stone-400 text-xs"></i>
        </form>
    </div>

    <!-- Businesses Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($businesses as $b)
            <div class="bg-white rounded-2xl border border-stone-200/90 overflow-hidden shadow-sm flex flex-col justify-between group hover:shadow-md transition">
                <div>
                    <div class="relative h-44 bg-stone-900 overflow-hidden">
                        <img src="{{ $b->image ?: 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80' }}"
                             alt="{{ $b->name }}" class="w-full h-full object-cover">
                        <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider bg-stone-950/80 backdrop-blur-md text-amber-300 border border-stone-800">
                            {{ $b->category }}
                        </span>
                        <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-md text-[10px] font-black {{ $b->status === 'active' ? 'bg-emerald-500 text-stone-950' : 'bg-rose-500 text-white' }}">
                            {{ strtoupper($b->status) }}
                        </span>
                    </div>

                    <div class="p-4 space-y-2">
                        <div>
                            <h4 class="font-black text-stone-900 text-sm line-clamp-1">{{ $b->name }}</h4>
                            <div class="text-[11px] font-bold text-stone-500 mt-0.5">
                                Pemilik: <span class="text-stone-800">{{ $b->owner_name }}</span>
                            </div>
                        </div>

                        <p class="text-[11px] text-stone-600 line-clamp-2 leading-relaxed">{{ $b->description }}</p>

                        <div class="pt-2 border-t border-stone-100 text-[11px] space-y-1">
                            <div class="flex items-center justify-between">
                                <span class="text-stone-400">Harga:</span>
                                <span class="font-bold text-amber-700">{{ $b->price_range }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-stone-400">WhatsApp:</span>
                                <span class="font-bold text-emerald-700">{{ $b->whatsapp }}</span>
                            </div>
                            <div class="flex items-start gap-1 text-stone-500 text-[10px] pt-0.5">
                                <i class="fa-solid fa-location-dot text-rose-500 mt-0.5"></i>
                                <span class="truncate">{{ $b->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 pt-0 border-t border-stone-100 flex items-center justify-between gap-2 mt-2">
                    <a href="{{ $b->whatsapp_link }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-xs font-bold transition flex items-center gap-1">
                        <i class="fa-brands fa-whatsapp"></i> Chat WA
                    </a>

                    <div class="flex items-center gap-1.5">
                        <button @click="activeItem = {{ json_encode($b) }}; editModal = true" class="p-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 text-xs transition" title="Edit Lapak">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <form action="{{ route('admin.umkm.delete', $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapak usaha ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 text-xs transition" title="Hapus Lapak">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white p-10 rounded-2xl text-center border border-stone-200">
                <i class="fa-solid fa-store-slash text-4xl text-stone-300 mb-2"></i>
                <p class="text-stone-500 text-xs">Belum ada lapak UMKM yang terdaftar.</p>
            </div>
        @endforelse
    </div>

    @if($businesses->hasPages())
        <div class="pt-4">
            {{ $businesses->links() }}
        </div>
    @endif

    <!-- CREATE MODAL -->
    <div x-show="createModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="max-w-lg w-full bg-white rounded-3xl p-6 space-y-4 shadow-2xl max-h-[90vh] overflow-y-auto" @click.outside="createModal = false">
            <div class="flex items-center justify-between border-b pb-3">
                <h3 class="font-black text-stone-900 text-base">Tambah Lapak UMKM Baru</h3>
                <button @click="createModal = false" class="text-stone-400 hover:text-stone-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Nama Usaha *</label>
                        <input type="text" name="name" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Nama Pemilik *</label>
                        <input type="text" name="owner_name" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Kategori *</label>
                        <select name="category" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                            <option value="Kuliner">Kuliner</option>
                            <option value="Sembako">Sembako</option>
                            <option value="Jasa & Servis">Jasa & Servis</option>
                            <option value="Fashion & Busana">Fashion & Busana</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Kisaran Harga</label>
                        <input type="text" name="price_range" placeholder="Rp 10.000 - Rp 25.000" class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">No. WhatsApp *</label>
                        <input type="text" name="whatsapp" required placeholder="081412357231" class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Jam Buka</label>
                        <input type="text" name="opening_hours" placeholder="08:00 - 21:00 WIB" class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-stone-700 mb-1">Alamat di RT 12 *</label>
                    <input type="text" name="address" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-stone-700 mb-1">Deskripsi Produk/Jasa *</label>
                    <textarea name="description" rows="2" required class="w-full bg-stone-50 border rounded-xl p-2.5 text-xs"></textarea>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-stone-700 mb-1">Upload Foto Lapak/Produk</label>
                    <input type="file" name="image_file" accept="image/*" class="w-full text-xs">
                </div>
                <button type="submit" class="w-full py-2.5 bg-emerald-700 text-white font-bold rounded-xl text-xs hover:bg-emerald-800 transition">
                    Simpan Lapak UMKM
                </button>
            </form>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
        <div class="max-w-lg w-full bg-white rounded-3xl p-6 space-y-4 shadow-2xl max-h-[90vh] overflow-y-auto" @click.outside="editModal = false">
            <div class="flex items-center justify-between border-b pb-3">
                <h3 class="font-black text-stone-900 text-base">Edit Lapak UMKM</h3>
                <button @click="editModal = false" class="text-stone-400 hover:text-stone-600"><i class="fa-solid fa-xmark text-lg"></i></button>
            </div>
            <form :action="'{{ url('admin/umkm') }}/' + activeItem.id" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Nama Usaha *</label>
                        <input type="text" name="name" :value="activeItem.name" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Nama Pemilik *</label>
                        <input type="text" name="owner_name" :value="activeItem.owner_name" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Kategori *</label>
                        <select name="category" x-model="activeItem.category" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                            <option value="Kuliner">Kuliner</option>
                            <option value="Sembako">Sembako</option>
                            <option value="Jasa & Servis">Jasa & Servis</option>
                            <option value="Fashion & Busana">Fashion & Busana</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Status Publikasi *</label>
                        <select name="status" x-model="activeItem.status" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                            <option value="active">Active (Tayang)</option>
                            <option value="inactive">Inactive (Disembunyikan)</option>
                            <option value="pending">Pending (Menunggu)</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">No. WhatsApp *</label>
                        <input type="text" name="whatsapp" :value="activeItem.whatsapp" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-stone-700 mb-1">Kisaran Harga</label>
                        <input type="text" name="price_range" :value="activeItem.price_range" class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-stone-700 mb-1">Alamat di RT 12 *</label>
                    <input type="text" name="address" :value="activeItem.address" required class="w-full bg-stone-50 border rounded-xl px-3 py-2 text-xs">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-stone-700 mb-1">Deskripsi Produk/Jasa *</label>
                    <textarea name="description" rows="2" x-model="activeItem.description" required class="w-full bg-stone-50 border rounded-xl p-2.5 text-xs"></textarea>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-stone-700 mb-1">Ganti Foto Lapak (Opsional)</label>
                    <input type="file" name="image_file" accept="image/*" class="w-full text-xs">
                </div>
                <button type="submit" class="w-full py-2.5 bg-amber-500 text-stone-950 font-black rounded-xl text-xs hover:bg-amber-400 transition">
                    Simpan Perubahan Lapak
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
