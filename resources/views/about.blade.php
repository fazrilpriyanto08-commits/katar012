@extends('layouts.app')

@section('title', 'Profil & Struktur Pengurus - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<!-- CINEMATIC APP HERO BANNER (JUMANJI LUXURY) -->
<section class="relative jungle-pattern text-white py-16 sm:py-24 overflow-hidden border-b border-emerald-900/60">
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-500/20 rounded-full blur-[110px] pointer-events-none"></div>
    <div class="absolute top-1/3 -right-24 w-80 h-80 bg-amber-500/15 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-950/80 border border-emerald-500/40 text-emerald-300 text-xs font-black backdrop-blur-md shadow-lg">
            <i class="fa-solid fa-compass text-amber-400"></i>
            <span>TENTANG KAMI • RT 12 RW 05 LENTENG AGUNG</span>
        </div>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white leading-tight">
            Mengenal Lebih Dekat <br class="hidden sm:inline">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-yellow-400 to-emerald-300">
                Unit Penghubung Warga
            </span>
        </h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
            Wadah dedikasi pemuda-pemudi bersama sesepuh dan pengurus RT 012 RW 05 Kelurahan Lenteng Agung dalam merawat kebersamaan, keamanan, dan kemajuan lingkungan.
        </p>
    </div>
</section>

<!-- MAIN CONTENT CONTAINER -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 space-y-16">

    <!-- 1. IDENTITAS WILAYAH & QUICK INFO CARDS -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-3xl border border-stone-200/80 shadow-sm hover:shadow-md transition text-center group">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl mx-auto mb-2 group-hover:scale-110 transition">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <div class="text-lg sm:text-xl font-black text-stone-900">RT 012 / RW 05</div>
            <div class="text-[11px] font-bold text-emerald-700 mt-0.5">Kel. Lenteng Agung</div>
        </div>

        <div class="bg-white p-5 rounded-3xl border border-stone-200/80 shadow-sm hover:shadow-md transition text-center group">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl mx-auto mb-2 group-hover:scale-110 transition">
                <i class="fa-solid fa-calendar-star"></i>
            </div>
            <div class="text-lg sm:text-xl font-black text-stone-900">2026 – 2028</div>
            <div class="text-[11px] font-bold text-amber-700 mt-0.5">Masa Bakti Pengurus</div>
        </div>

        <div class="bg-white p-5 rounded-3xl border border-stone-200/80 shadow-sm hover:shadow-md transition text-center group">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl mx-auto mb-2 group-hover:scale-110 transition">
                <i class="fa-solid fa-handshake-angle"></i>
            </div>
            <div class="text-lg sm:text-xl font-black text-stone-900">100% Guyub</div>
            <div class="text-[11px] font-bold text-blue-700 mt-0.5">Semangat Gotong Royong</div>
        </div>

        <div class="bg-white p-5 rounded-3xl border border-stone-200/80 shadow-sm hover:shadow-md transition text-center group">
            <div class="w-12 h-12 rounded-2xl bg-stone-900 text-amber-400 flex items-center justify-center text-xl mx-auto mb-2 group-hover:scale-110 transition">
                <i class="fa-solid fa-paw"></i>
            </div>
            <div class="text-lg sm:text-xl font-black text-stone-900">Edisi Jumanji</div>
            <div class="text-[11px] font-bold text-stone-600 mt-0.5">Tema Petualangan Rimba</div>
        </div>
    </div>

    <!-- 2. NARASI SEJARAH & NILAI ORGANISASI -->
    <div class="bg-white rounded-3xl border border-stone-200 p-8 sm:p-12 shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <div class="lg:col-span-7 space-y-5">
                <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-emerald-800 bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">
                    <i class="fa-solid fa-book-bookmark text-emerald-600"></i> Dedikasi & Perjalanan
                </span>
                
                <h2 class="text-2xl sm:text-4xl font-black text-stone-900 leading-tight">
                    Jembatan Penghubung Antara Warga, Pemuda, & Lingkungan
                </h2>
                
                <p class="text-stone-600 text-sm sm:text-base leading-relaxed">
                    <strong class="text-stone-900">Unit Penghubung Warga RT 12 RW 05</strong> lahir sebagai gerakan kepemudaan modern di Kelurahan Lenteng Agung. Kami hadir bukan hanya saat perayaan 17 Agustusan, melainkan sebagai wadah aktif dalam menjaga kebersihan lingkungan, ketertiban ronda malam, aksi tanggap sosial, dan saluran aspirasi digital warga.
                </p>

                <p class="text-stone-600 text-sm sm:text-base leading-relaxed">
                    Dengan moto <em class="text-emerald-800 font-bold">"Bersatu, Menjelajah, dan Berdampak Nyata"</em>, pemuda RT 012 berkomitmen menjadi garda terdepan yang tanggap, santun, transparan, dan inklusif bagi seluruh warga di Gang H. Saatun dan sekitarnya.
                </p>

                <div class="pt-2 flex items-center gap-3">
                    <div class="flex -space-x-2 overflow-hidden">
                        <img class="inline-block h-9 w-9 rounded-full ring-2 ring-white object-cover" src="{{ asset('images/logo.jpg') }}" alt="Katar">
                        <div class="inline-flex items-center justify-center h-9 w-9 rounded-full ring-2 ring-white bg-emerald-700 text-white text-xs font-bold">012</div>
                        <div class="inline-flex items-center justify-center h-9 w-9 rounded-full ring-2 ring-white bg-amber-500 text-stone-950 text-xs font-bold">05</div>
                    </div>
                    <span class="text-xs font-bold text-stone-500">Menaungi seluruh warga RT 12 RW 05</span>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-r from-emerald-500 via-amber-400 to-green-500 rounded-3xl blur-xl opacity-40 group-hover:opacity-70 transition duration-500"></div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-stone-200 bg-stone-950">
                        <img src="{{ asset('images/jumanji-hero.jpg') }}" alt="Kebersamaan Warga" class="w-full h-80 sm:h-96 object-cover transform group-hover:scale-105 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-stone-950 via-stone-950/30 to-transparent flex flex-col justify-end p-6">
                            <span class="bg-amber-400 text-stone-950 text-[10px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-md inline-block w-fit mb-2">Semangat Rimba Jumanji</span>
                            <p class="text-white text-sm sm:text-base font-extrabold italic leading-snug">
                                "Saling menjaga, bahu-membahu melangkah bersama untuk kebaikan lingkungan kita tercinta."
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- 3. VISI & 5 MISI UTAMA (LUXURY CARD TILES) -->
    <div class="bg-gradient-to-br from-emerald-950 via-stone-900 to-stone-950 text-white rounded-3xl p-8 sm:p-12 border border-emerald-900/60 shadow-xl relative overflow-hidden">
        <div class="absolute -right-24 -top-24 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 relative z-10">
            
            <!-- Visi -->
            <div class="lg:col-span-5 space-y-4 border-b lg:border-b-0 lg:border-r border-emerald-800/50 pb-8 lg:pb-0 lg:pr-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400 text-stone-950 text-xs font-black uppercase tracking-wider">
                    <i class="fa-solid fa-eye"></i> Visi Kami
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-white leading-tight">
                    Mewujudkan pemuda RT 012 yang solid, berakhlak, kreatif, dan responsif terhadap kebutuhan warga.
                </h3>
                <p class="text-stone-300 text-xs sm:text-sm leading-relaxed">
                    Membangun lingkungan RT 12 RW 05 Kelurahan Lenteng Agung yang aman, rukun, bersih, dan berprestasi melalui gotong royong generasi muda dan bimbingan sesepuh.
                </p>
            </div>

            <!-- 5 Misi -->
            <div class="lg:col-span-7 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-900/80 border border-emerald-500/40 text-emerald-300 text-xs font-bold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-list-check text-amber-400"></i> 5 Misi Utama
                </div>

                @php
                    $misiList = [
                        ['no' => '1', 'text' => 'Mempererat tali silaturahmi, kebersamaan, dan komunikasi harmonis antar pemuda serta seluruh warga RT 012 RW 05.'],
                        ['no' => '2', 'text' => 'Menggerakkan kepedulian sosial melalui kerja bakti berkala, aksi peduli lingkungan, dan tanggap kebencanaan.'],
                        ['no' => '3', 'text' => 'Menyalurkan bakat dan potensi positif pemuda di bidang olahraga, kebudayaan, keagamaan, dan teknologi informasi.'],
                        ['no' => '4', 'text' => 'Mendukung terciptanya keamanan lingkungan bersama pengurus RT dan tim ronda siskamling.'],
                        ['no' => '5', 'text' => 'Mewujudkan tata kelola organisasi yang transparan, akuntabel, dan mengutamakan pelayanan warga.'],
                    ];
                @endphp

                <div class="space-y-2.5">
                    @foreach($misiList as $m)
                        <div class="flex items-start gap-3 bg-white/5 hover:bg-white/10 transition p-3.5 rounded-2xl border border-white/10">
                            <div class="w-6 h-6 rounded-full bg-amber-400 text-stone-950 flex-shrink-0 flex items-center justify-center font-black text-xs mt-0.5 shadow">
                                {{ $m['no'] }}
                            </div>
                            <p class="text-xs sm:text-sm text-stone-200 leading-relaxed">{{ $m['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- 4. STRUKTUR ORGANISASI KEPENGURUSAN (MODERN TEAM CARDS) -->
    <div class="space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-emerald-800 bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">
                <i class="fa-solid fa-sitemap text-emerald-600"></i> Bagan Organisasi
            </span>
            <h2 class="text-2xl sm:text-4xl font-black text-stone-900 tracking-tight">
                Susunan Pengurus Masa Bakti 2026 – 2028
            </h2>
            <p class="text-stone-500 text-xs sm:text-sm">
                Badan Pengurus Harian dan Koordinator Divisi Unit Penghubung Warga RT 12 RW 05 Lenteng Agung.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @forelse($structures as $person)
                <div class="bg-white rounded-3xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition duration-300 text-center p-5 sm:p-6 flex flex-col items-center group">
                    <div class="relative mb-3.5">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden border-3 border-emerald-100 group-hover:border-amber-400 transition duration-300 shadow-md">
                            <img src="{{ $person->photo ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80' }}" alt="{{ $person->name }}" class="w-full h-full object-cover">
                        </div>
                        <span class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[9px] font-bold border-2 border-white shadow">
                            <i class="fa-solid fa-check"></i>
                        </span>
                    </div>

                    <div class="space-y-1 flex-1 flex flex-col justify-between w-full">
                        <div>
                            <span class="text-[9px] font-black uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-md inline-block mb-1 border border-amber-200">
                                {{ $person->position }}
                            </span>
                            <h4 class="font-black text-stone-900 text-sm sm:text-base group-hover:text-emerald-700 transition line-clamp-1">
                                {{ $person->name }}
                            </h4>
                            <div class="text-[11px] text-stone-400 font-semibold">{{ $person->division }}</div>
                        </div>

                        @if($person->phone)
                            <div class="mt-3 pt-3 border-t border-stone-100 w-full">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $person->phone) }}" target="_blank"
                                   class="inline-flex items-center justify-center gap-1.5 w-full py-2 px-3 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-800 hover:text-white text-xs font-bold transition">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                    <span class="truncate">{{ $person->phone }}</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-4 bg-white p-12 rounded-3xl text-center border border-stone-200">
                    <p class="text-stone-400 text-sm">Susunan pengurus sedang diperbarui.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- 5. KOTAK SEKRETARIAT & ALAMAT ASLI -->
    <div class="bg-gradient-to-r from-stone-900 via-emerald-950 to-stone-900 text-white rounded-3xl p-6 sm:p-10 border border-emerald-900/60 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-2 text-center md:text-left">
            <span class="bg-amber-400 text-stone-950 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider">
                Lokasi Sekretariat Resmi
            </span>
            <h3 class="text-xl sm:text-2xl font-black text-white">Posko Unit Penghubung Warga RT 12 RW 05</h3>
            <p class="text-xs sm:text-sm text-stone-300">
                Jl. Raya Lenteng Agung, Gg. H. Saatun RT 012 RW 05, Kelurahan Lenteng Agung, Jakarta Selatan
            </p>
        </div>
        <div class="flex-shrink-0">
            <a href="https://wa.me/6281412357231" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold px-6 py-3.5 rounded-2xl shadow-lg transition">
                <i class="fa-brands fa-whatsapp text-lg"></i>
                <span>Hubungi Pengurus Langsung</span>
            </a>
        </div>
    </div>

</div>
@endsection
