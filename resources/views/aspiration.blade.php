@extends('layouts.app')

@section('title', 'Kotak Aspirasi Warga - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<!-- Hero Banner -->
<section class="relative jungle-pattern text-white py-14 sm:py-20 overflow-hidden">
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-24 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-950/80 border border-emerald-500/40 text-emerald-300 text-xs font-extrabold backdrop-blur-md">
            <i class="fa-solid fa-bullhorn text-amber-400"></i> SUARA & MASUKAN WARGA
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
            Kotak Aspirasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-emerald-300">Warga</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto">
            Ruang komunikasi terbuka bagi warga RT 012 RW 05 untuk menyampaikan aspirasi, ide, maupun saran perbaikan.
        </p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Multi-Step Form -->
        <div class="lg:col-span-7" x-data="{ step: 1 }">
            <div class="bg-white rounded-3xl border border-stone-200 shadow-sm overflow-hidden">
                
                <!-- Progress Bar -->
                <div class="bg-stone-50 border-b border-stone-100 px-6 py-4">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="font-extrabold text-stone-900 text-lg">Kirim Aspirasi</h2>
                        <span class="text-xs font-bold text-stone-400">Langkah <span x-text="step"></span> dari 2</span>
                    </div>
                    <div class="flex gap-2">
                        <div class="h-1.5 flex-1 rounded-full transition-all duration-500" :class="step >= 1 ? 'bg-emerald-500' : 'bg-stone-200'"></div>
                        <div class="h-1.5 flex-1 rounded-full transition-all duration-500" :class="step >= 2 ? 'bg-emerald-500' : 'bg-stone-200'"></div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <button @click="step = 1" class="text-[10px] font-bold transition" :class="step >= 1 ? 'text-emerald-700' : 'text-stone-400'">
                            <i class="fa-solid fa-user mr-0.5"></i> Data Diri
                        </button>
                        <button @click="step = 2" class="text-[10px] font-bold transition" :class="step >= 2 ? 'text-emerald-700' : 'text-stone-400'">
                            <i class="fa-solid fa-message mr-0.5"></i> Detail Aspirasi
                        </button>
                    </div>
                </div>

                <form action="{{ route('aspiration.store') }}" method="POST" class="p-6 sm:p-8">
                    @csrf

                    <!-- Step 1: Data Diri -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="space-y-5">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">
                                    Nama Lengkap <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fa-solid fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Bpk. Bambang" required
                                           class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">
                                    No. WhatsApp / HP <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <i class="fa-brands fa-whatsapp absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-500 text-sm"></i>
                                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="0812xxxxxxx" required
                                           class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Lingkungan / Domisili</label>
                                <div class="relative">
                                    <i class="fa-solid fa-location-dot absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                                    <input type="text" name="rt_rw" value="{{ old('rt_rw', 'RT 012 / RW 05') }}"
                                           class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                </div>
                            </div>
                            <button type="button" @click="step = 2" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-2xl shadow-lg transition flex items-center justify-center gap-2">
                                Lanjut ke Detail Aspirasi <i class="fa-solid fa-arrow-right text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Detail Aspirasi -->
                    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="space-y-5">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">
                                    Kategori Aspirasi <span class="text-rose-500">*</span>
                                </label>
                                <select name="category" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                                    <option value="Saran" {{ old('category') == 'Saran' ? 'selected' : '' }}>🏡 Saran Lingkungan</option>
                                    <option value="Ide Kegiatan" {{ old('category') == 'Ide Kegiatan' ? 'selected' : '' }}>💡 Ide / Usulan Kegiatan</option>
                                    <option value="Keluhan" {{ old('category') == 'Keluhan' ? 'selected' : '' }}>⚠️ Keluhan / Kendala</option>
                                    <option value="Bantuan/Donasi" {{ old('category') == 'Bantuan/Donasi' ? 'selected' : '' }}>🤝 Bantuan & Donasi</option>
                                    <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>📌 Lainnya</option>
                                </select>
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">
                                    Isi Pesan Aspirasi <span class="text-rose-500">*</span>
                                </label>
                                <textarea name="message" rows="5" required placeholder="Tuliskan secara jelas saran, ide, atau hal yang ingin disampaikan..."
                                          class="w-full bg-stone-50 border border-stone-200 rounded-xl p-4 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition resize-none">{{ old('message') }}</textarea>
                            </div>

                            <!-- Trust Badges -->
                            <div class="flex flex-wrap gap-3 py-2">
                                <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-stone-500 bg-stone-50 px-3 py-1.5 rounded-full border border-stone-200">
                                    <i class="fa-solid fa-shield-halved text-emerald-500"></i> Privasi Terjaga
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-stone-500 bg-stone-50 px-3 py-1.5 rounded-full border border-stone-200">
                                    <i class="fa-solid fa-bolt text-amber-500"></i> Respon Cepat
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-stone-500 bg-stone-50 px-3 py-1.5 rounded-full border border-stone-200">
                                    <i class="fa-solid fa-check-double text-blue-500"></i> Ditindaklanjuti
                                </span>
                            </div>

                            <div class="flex gap-3">
                                <button type="button" @click="step = 1" class="px-6 py-3.5 bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold rounded-2xl transition">
                                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                                </button>
                                <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white font-bold py-3.5 rounded-2xl shadow-lg shadow-emerald-500/25 transition flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-paper-plane text-sm"></i> Kirim Aspirasi
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-5 space-y-6">
            <!-- WhatsApp CTA -->
            <div class="bg-gradient-to-br from-emerald-700 to-green-800 text-white p-6 rounded-3xl shadow-lg relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 text-7xl text-white/5"><i class="fa-brands fa-whatsapp"></i></div>
                <div class="relative z-10">
                    <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-xl mb-3">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h3 class="font-bold text-base">Butuh Bantuan Mendesak?</h3>
                    <p class="text-xs text-emerald-100 leading-relaxed mt-1">
                        Hubungi pengurus langsung melalui WhatsApp untuk respon cepat.
                    </p>
                    <a href="https://wa.me/6281412357231" target="_blank" class="inline-flex items-center gap-2 bg-white text-emerald-800 font-bold px-4 py-2.5 rounded-xl text-xs hover:bg-emerald-50 transition mt-3">
                        Chat WhatsApp Humas <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                    </a>
                </div>
            </div>

            <!-- Recent Aspirations -->
            <div class="bg-white rounded-3xl border border-stone-200 p-6 space-y-4 shadow-sm">
                <h3 class="font-extrabold text-stone-900 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-clipboard-check text-emerald-600"></i> Tindak Lanjut Aspirasi
                </h3>
                <div class="space-y-3">
                    @forelse($recentAspirations as $asp)
                        <div class="p-3.5 rounded-2xl bg-stone-50 border border-stone-100 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-stone-800">{{ $asp->name }}</span>
                                <span class="text-[9px] font-extrabold px-2 py-0.5 rounded-full {{ $asp->status == 'Selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $asp->status }}
                                </span>
                            </div>
                            <p class="text-[11px] text-stone-500 italic">"{{ Str::limit($asp->message, 80) }}"</p>
                            @if($asp->admin_notes)
                                <div class="text-[10px] text-emerald-700 bg-emerald-50 p-2 rounded-lg font-medium">
                                    <i class="fa-solid fa-comment-dots mr-1"></i> {{ $asp->admin_notes }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-xs text-stone-400 text-center py-4">Belum ada riwayat respon.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
