@extends('layouts.app')

@section('title', 'Sensus & Pendaftaran Pemuda RT 012 / RW 05')

@section('content')
<!-- Hero Banner -->
<section class="relative jungle-pattern text-white py-14 sm:py-20 overflow-hidden">
    <div class="absolute -top-24 -left-24 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-24 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-950/80 border border-emerald-500/40 text-emerald-300 text-xs font-extrabold backdrop-blur-md">
            <i class="fa-solid fa-compass text-amber-400"></i> DATABASE PEMUDA
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">
            Sensus & <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-emerald-300">Pendaftaran Pemuda</span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto">
            Bergabunglah bersama pemuda RT 012 RW 05! Daftarkan dirimu dan berkontribusi untuk kemajuan lingkungan.
        </p>
    </div>
</section>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ step: 1 }">
    <div class="bg-white rounded-3xl border border-stone-200 shadow-sm overflow-hidden">
        
        <!-- Progress Steps -->
        <div class="bg-stone-50 border-b border-stone-100 px-6 py-5">
            <div class="flex items-center justify-between mb-3">
                <h2 class="font-extrabold text-stone-900 text-lg">Formulir Data Pemuda</h2>
                <span class="text-xs font-bold text-stone-400">Langkah <span x-text="step"></span> dari 3</span>
            </div>
            <div class="flex gap-1.5">
                <div class="h-1.5 flex-1 rounded-full transition-all duration-500" :class="step >= 1 ? 'bg-emerald-500' : 'bg-stone-200'"></div>
                <div class="h-1.5 flex-1 rounded-full transition-all duration-500" :class="step >= 2 ? 'bg-emerald-500' : 'bg-stone-200'"></div>
                <div class="h-1.5 flex-1 rounded-full transition-all duration-500" :class="step >= 3 ? 'bg-emerald-500' : 'bg-stone-200'"></div>
            </div>
            <div class="flex justify-between mt-2">
                <button @click="step = 1" class="text-[10px] font-bold" :class="step >= 1 ? 'text-emerald-700' : 'text-stone-400'">
                    <i class="fa-solid fa-id-card mr-0.5"></i> Identitas
                </button>
                <button @click="step >= 2 ? step = 2 : null" class="text-[10px] font-bold" :class="step >= 2 ? 'text-emerald-700' : 'text-stone-400'">
                    <i class="fa-solid fa-phone mr-0.5"></i> Kontak
                </button>
                <button @click="step >= 3 ? step = 3 : null" class="text-[10px] font-bold" :class="step >= 3 ? 'text-emerald-700' : 'text-stone-400'">
                    <i class="fa-solid fa-heart mr-0.5"></i> Profil
                </button>
            </div>
        </div>

        <!-- Quote -->
        <div class="bg-emerald-50 border-b border-emerald-100 px-6 py-3">
            <p class="text-[11px] text-emerald-800 font-medium italic text-center">
                <i class="fa-solid fa-quote-left text-emerald-400 mr-1"></i>
                "Pemuda adalah pilar kemajuan lingkungan. Satu langkah kecilmu, dampak besar bagi RT 012."
            </p>
        </div>

        <form action="{{ route('youth.store') }}" method="POST" class="p-6 sm:p-10">
            @csrf

            <!-- Step 1: Identitas -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Nama Lengkap <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <i class="fa-solid fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Sesuai KTP" required
                                       class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Nama Panggilan</label>
                            <div class="relative">
                                <i class="fa-solid fa-id-badge absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                                <input type="text" name="nickname" value="{{ old('nickname') }}" placeholder="Nama sapaan"
                                       class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Jenis Kelamin <span class="text-rose-500">*</span></label>
                            <select name="gender" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>👨 Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>👩 Perempuan</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Tanggal Lahir</label>
                            <div class="relative">
                                <i class="fa-solid fa-cake-candles absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                                <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                                       class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                            </div>
                        </div>
                    </div>
                    <button type="button" @click="step = 2" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-2xl shadow-lg transition flex items-center justify-center gap-2">
                        Lanjut: Kontak & Alamat <i class="fa-solid fa-arrow-right text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Step 2: Kontak -->
            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="space-y-5">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">No. WhatsApp Aktif <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <i class="fa-brands fa-whatsapp absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-500 text-sm"></i>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="0812xxxxxxxx" required
                                   class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Alamat / Gang / No. Rumah <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <i class="fa-solid fa-house absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                            <input type="text" name="address" value="{{ old('address', 'RT 012 / RW 05 No. ') }}" required
                                   class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="step = 1" class="px-6 py-3.5 bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold rounded-2xl transition">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                        </button>
                        <button type="button" @click="step = 3" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 rounded-2xl shadow-lg transition flex items-center justify-center gap-2">
                            Lanjut: Profil & Minat <i class="fa-solid fa-arrow-right text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 3: Profil -->
            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="space-y-5">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Aktivitas / Pekerjaan</label>
                        <div class="relative">
                            <i class="fa-solid fa-briefcase absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                            <input type="text" name="occupation" value="{{ old('occupation') }}" placeholder="Mahasiswa / Karyawan / Wirausaha"
                                   class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-stone-700 uppercase tracking-wider">Minat / Hobi / Keahlian</label>
                        <div class="relative">
                            <i class="fa-solid fa-palette absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-sm"></i>
                            <input type="text" name="interest" value="{{ old('interest') }}" placeholder="Olahraga, IT, Desain, Musik, Memasak"
                                   class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-10 pr-4 py-3 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="step = 2" class="px-6 py-3.5 bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold rounded-2xl transition">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                        </button>
                        <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-emerald-500/25 transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-user-check"></i> Simpan & Daftarkan
                        </button>
                    </div>
                    <p class="text-[10px] text-stone-400 text-center">Data digunakan internal kepengurusan RT 012 untuk koordinasi dan pendataan pemuda.</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
