@extends('layouts.app')

@section('title', 'Pasar & Lapak UMKM Warga RT 12 RW 05 - Lenteng Agung')

@section('content')
<div class="bg-stone-50 min-h-screen py-8 sm:py-12" x-data="{ registerModal: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- HEADER BANNER -->
        <div class="relative overflow-hidden bg-gradient-to-r from-stone-950 via-stone-900 to-emerald-950 p-6 sm:p-10 rounded-3xl border border-amber-500/30 text-white shadow-2xl">
            <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-amber-500/15 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-emerald-500/15 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[11px] font-black tracking-wider uppercase">
                        <i class="fa-solid fa-basket-shopping text-amber-400"></i>
                        <span>Ekonomi & Usaha Tetangga RT 12 RW 05</span>
                    </div>
                    <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-white leading-tight">
                        Pasar & Lapak UMKM Warga
                    </h1>
                    <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                        Beli dari tetangga, majukan lingkungan kita! Temukan aneka jajanan lezat, warung sembako, laundry kilat, hingga jasa servis terpercaya asli milik warga RT 012 RW 05 Kelurahan Lenteng Agung.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <button @click="registerModal = true" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-stone-950 font-black text-xs sm:text-sm shadow-xl shadow-amber-400/20 transition hover:scale-105 active:scale-95 flex items-center gap-2">
                        <i class="fa-solid fa-plus-circle text-base"></i>
                        <span>Daftarkan Usaha Anda</span>
                    </button>
                    <a href="https://wa.me/6281412357231?text=Halo%20Humas%20RT%2012%2C%20saya%20warga%20mau%20konsultasi%20promosi%20UMKM" target="_blank"
                       class="px-4 py-3 rounded-2xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold border border-white/20 transition flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i>
                        <span>Bantuan Humas</span>
                    </a>
                </div>
            </div>

            <!-- LIVE STATS STRIP -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-8 pt-6 border-t border-white/10">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-3.5 text-center">
                    <div class="text-xl sm:text-2xl font-black text-amber-400">{{ $stats['total'] }}</div>
                    <div class="text-[10px] sm:text-xs text-stone-300 font-bold uppercase tracking-wider mt-0.5">Total Usaha Warga</div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-3.5 text-center">
                    <div class="text-xl sm:text-2xl font-black text-emerald-400">{{ $stats['kuliner'] }}</div>
                    <div class="text-[10px] sm:text-xs text-stone-300 font-bold uppercase tracking-wider mt-0.5">Kuliner & Jajanan</div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-3.5 text-center">
                    <div class="text-xl sm:text-2xl font-black text-blue-400">{{ $stats['sembako'] }}</div>
                    <div class="text-[10px] sm:text-xs text-stone-300 font-bold uppercase tracking-wider mt-0.5">Sembako & Kebutuhan</div>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-2xl p-3.5 text-center">
                    <div class="text-xl sm:text-2xl font-black text-rose-400">{{ $stats['jasa'] }}</div>
                    <div class="text-[10px] sm:text-xs text-stone-300 font-bold uppercase tracking-wider mt-0.5">Jasa & Servis</div>
                </div>
            </div>
        </div>

        <!-- SEARCH & FILTER TOOLBAR -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-stone-200/80 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Category Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0 hide-scrollbar">
                @foreach($categories as $cat)
                    <a href="{{ route('umkm.index', ['category' => $cat === 'Semua' ? null : $cat, 'q' => request('q')]) }}"
                       class="px-4 py-2 rounded-xl text-xs font-extrabold whitespace-nowrap transition {{ ($category == $cat || (!$category && $cat == 'Semua')) ? 'bg-emerald-700 text-white shadow-md shadow-emerald-700/20' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Search Form -->
            <form action="{{ route('umkm.index') }}" method="GET" class="relative min-w-[260px] sm:w-72">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari jajanan, sembako, servis..."
                       class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-9 pr-4 py-2 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-stone-400 text-xs"></i>
                @if(request('q'))
                    <a href="{{ route('umkm.index', ['category' => request('category')]) }}" class="absolute right-3 top-2.5 text-stone-400 hover:text-stone-600 text-xs">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </form>
        </div>

        <!-- ALERT SUCCESS -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-300 text-emerald-950 p-4 rounded-2xl flex items-center gap-3 text-xs font-semibold shadow-sm animate-fade-in">
                <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-sm flex-shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <div class="font-black text-emerald-900">Berhasil!</div>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
        @endif

        <!-- BUSINESS CARDS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($businesses as $b)
                <div class="bg-white rounded-3xl border border-stone-200/90 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition duration-300 flex flex-col justify-between group">
                    <div>
                        <!-- Cover Image -->
                        <div class="relative h-48 sm:h-52 bg-stone-900 overflow-hidden">
                            <img src="{{ $b->image ?: 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80' }}"
                                 alt="{{ $b->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <!-- Badges -->
                            <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider backdrop-blur-md bg-stone-950/80 text-amber-300 border border-stone-800">
                                    <i class="fa-solid {{ $b->category_badge['icon'] }} mr-1"></i> {{ $b->category }}
                                </span>
                            </div>

                            @if($b->is_verified)
                                <div class="absolute top-3 right-3 bg-emerald-600/90 backdrop-blur-md text-white px-2.5 py-1 rounded-lg text-[10px] font-black border border-emerald-400/40 shadow flex items-center gap-1">
                                    <i class="fa-solid fa-circle-check text-emerald-200"></i>
                                    <span>Warga RT 12</span>
                                </div>
                            @endif

                            @if($b->opening_hours)
                                <div class="absolute bottom-3 left-3 bg-white/95 backdrop-blur-md text-stone-900 px-2.5 py-0.5 rounded-lg text-[10px] font-bold shadow flex items-center gap-1">
                                    <i class="fa-regular fa-clock text-emerald-700"></i>
                                    <span>{{ $b->opening_hours }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 space-y-3">
                            <div>
                                <h3 class="font-black text-stone-900 text-base group-hover:text-emerald-700 transition line-clamp-1">
                                    {{ $b->name }}
                                </h3>
                                <div class="text-xs font-bold text-stone-500 flex items-center gap-1.5 mt-0.5">
                                    <i class="fa-solid fa-user-circle text-stone-400"></i>
                                    <span>Pemilik: <strong class="text-stone-700">{{ $b->owner_name }}</strong></span>
                                </div>
                            </div>

                            <p class="text-xs text-stone-600 line-clamp-2 leading-relaxed">
                                {{ $b->description }}
                            </p>

                            <!-- Price & Address Strip -->
                            <div class="space-y-1.5 pt-2 border-t border-stone-100 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-stone-400 font-medium">Kisaran Harga:</span>
                                    <span class="font-extrabold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md border border-amber-200/60">
                                        {{ $b->price_range ?: 'Hubungi Penjual' }}
                                    </span>
                                </div>
                                <div class="flex items-start gap-1.5 text-stone-500 text-[11px] pt-1">
                                    <i class="fa-solid fa-location-dot text-rose-500 mt-0.5 flex-shrink-0"></i>
                                    <span class="truncate">{{ $b->address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp CTA Footer -->
                    <div class="p-4 pt-0">
                        <a href="{{ $b->whatsapp_link }}" target="_blank"
                           class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white font-black text-xs shadow-md shadow-emerald-600/20 flex items-center justify-center gap-2 transition hover:scale-[1.02] active:scale-95">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Pesan via WhatsApp (Chat Penjual)</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 bg-white rounded-3xl p-12 text-center border border-stone-200">
                    <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-3xl mx-auto mb-4">
                        <i class="fa-solid fa-store-slash"></i>
                    </div>
                    <h3 class="font-black text-stone-900 text-base">Belum Ada Usaha yang Ditemukan</h3>
                    <p class="text-xs text-stone-500 max-w-md mx-auto mt-1 mb-5">
                        Tidak ada usaha yang sesuai dengan kata kunci pencarian Anda. Jadilah yang pertama mendaftarkan lapak usaha warga di RT 12!
                    </p>
                    <button @click="registerModal = true" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow transition">
                        Daftarkan Usaha Sekarang
                    </button>
                </div>
            @endforelse
        </div>

        <!-- PAGINATION -->
        @if($businesses->hasPages())
            <div class="pt-4">
                {{ $businesses->links() }}
            </div>
        @endif

    </div>

    <!-- MODAL PENDAFTARAN USAHA WARGA -->
    <div x-show="registerModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         @keydown.escape.window="registerModal = false">
        
        <div class="relative max-w-xl w-full bg-white rounded-3xl overflow-hidden shadow-2xl border border-stone-200 p-6 sm:p-8 space-y-5 max-h-[90vh] overflow-y-auto custom-scrollbar" @click.outside="registerModal = false">
            <div class="flex items-center justify-between border-b border-stone-100 pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-black">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <div>
                        <h3 class="font-black text-stone-900 text-base sm:text-lg">Daftarkan Lapak Usaha Anda</h3>
                        <p class="text-[11px] text-stone-500">Gratis untuk seluruh warga RT 012 RW 05</p>
                    </div>
                </div>
                <button @click="registerModal = false" class="text-stone-400 hover:text-stone-600 p-1">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-stone-700">Nama Toko / Usaha <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" required placeholder="Contoh: Warung Nasi Uduk Bu Siti"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-stone-700">Nama Pemilik (Warga) <span class="text-rose-500">*</span></label>
                        <input type="text" name="owner_name" required placeholder="Contoh: Ibu Siti Rohmah"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-stone-700">Kategori Usaha <span class="text-rose-500">*</span></label>
                        <select name="category" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <option value="Kuliner">Kuliner & Makanan</option>
                            <option value="Sembako">Sembako & Kebutuhan Rumah</option>
                            <option value="Jasa & Servis">Jasa & Servis (AC, Elektronik, Laundry, Jahit)</option>
                            <option value="Fashion & Busana">Fashion & Busana</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-stone-700">Kisaran Harga</label>
                        <input type="text" name="price_range" placeholder="Contoh: Rp 10.000 - Rp 25.000"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-stone-700">No. WhatsApp Penjual <span class="text-rose-500">*</span></label>
                        <input type="text" name="whatsapp" required placeholder="081412357231"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-bold text-stone-700">Jam Operasional / Buka</label>
                        <input type="text" name="opening_hours" placeholder="Contoh: 06:00 - 11:00 WIB"
                               class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Alamat Rumah / Lapak di RT 12 <span class="text-rose-500">*</span></label>
                    <input type="text" name="address" required placeholder="Contoh: Gg. H. Saatun No. 12 RT 012 RW 05"
                           class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Deskripsi Menu / Produk / Layanan <span class="text-rose-500">*</span></label>
                    <textarea name="description" rows="3" required placeholder="Jelaskan produk atau keunggulan usaha Anda..."
                              class="w-full bg-stone-50 border border-stone-200 rounded-xl p-3 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                </div>

                <div class="space-y-1 bg-amber-50/70 border border-amber-200/80 rounded-2xl p-4">
                    <label class="block text-xs font-bold text-amber-900">Foto Produk / Lapak (Dari HP / Kamera)</label>
                    <input type="file" name="image_file" accept="image/*"
                           class="w-full text-xs text-stone-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-500 file:text-stone-950 hover:file:bg-amber-600 cursor-pointer bg-white border border-amber-300 rounded-xl p-1">
                    <div class="text-[10px] text-amber-800/80 mt-1">Format: JPG, PNG maksimal 2MB. (Jika kosong, akan dipakai ilustrasi otomatis sesuai kategori).</div>
                </div>

                <button type="submit" class="w-full py-3 bg-gradient-to-r from-emerald-700 to-green-700 hover:from-emerald-800 hover:to-green-800 text-white font-black text-xs rounded-xl shadow-lg transition">
                    <i class="fa-solid fa-paper-plane mr-1.5"></i> Kirim & Tayangkan Lapak Saya
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
