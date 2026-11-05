@extends('layouts.admin')

@section('title', 'Aspirasi & Suara Warga - Admin Panel RT 012')
@section('page_title', 'Manajemen Aspirasi Warga')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-amber-950 via-stone-900 to-stone-950 p-6 sm:p-8 rounded-3xl border border-amber-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-bullhorn text-amber-400"></i>
                    <span>Kotak Suara & Aspirasi Warga</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Pusat Masukan, Saran & Keluhan Warga
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Tinjau, tanggapi, dan tindaklanjuti setiap aspirasi masyarakat RT 12 RW 05 secara transparan untuk menjaga keharmonisan dan kemajuan lingkungan kita bersama.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <span class="px-4 py-2 rounded-2xl bg-white/10 text-stone-200 text-xs font-bold border border-white/20">
                    <i class="fa-solid fa-shield-halved text-emerald-400 mr-1.5"></i> Respon Cepat 24/7
                </span>
            </div>
        </div>
    </div>

    <!-- Quick Stats Bar -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Total Aspirasi</span>
                <div class="text-2xl font-black text-stone-900 mt-1">{{ $aspirations->total() }} Pesan</div>
                <span class="text-[10px] text-stone-500 font-semibold mt-0.5 block">Dari seluruh warga</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-stone-100 text-stone-700 flex items-center justify-center text-lg">
                <i class="fa-solid fa-inbox"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-amber-600 tracking-wider">Menunggu Ditinjau</span>
                <div class="text-2xl font-black text-amber-600 mt-1">
                    {{ \App\Models\Aspiration::where('status', 'Menunggu Ditinjau')->count() }}
                </div>
                <span class="text-[10px] text-amber-700 font-bold mt-0.5 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>Perlu respon panitia</span>
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-clock"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-blue-600 tracking-wider">Sedang Diproses</span>
                <div class="text-2xl font-black text-blue-700 mt-1">
                    {{ \App\Models\Aspiration::where('status', 'Diproses')->count() }}
                </div>
                <span class="text-[10px] text-blue-600 font-semibold mt-0.5 block">Dalam tindak lanjut</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-emerald-600 tracking-wider">Tuntas / Selesai</span>
                <div class="text-2xl font-black text-emerald-700 mt-1">
                    {{ \App\Models\Aspiration::where('status', 'Selesai')->count() }}
                </div>
                <span class="text-[10px] text-emerald-600 font-semibold mt-0.5 block">Solusi telah diberikan</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
    </div>

    <!-- Aspirations List -->
    <div class="space-y-4">
        @forelse($aspirations as $asp)
            <div class="bg-white rounded-3xl border border-stone-200/80 p-6 shadow-sm hover:shadow-md transition space-y-4">
                
                <!-- Card Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-stone-100">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 text-white font-black text-base flex items-center justify-center flex-shrink-0 shadow-sm">
                            {{ strtoupper(substr($asp->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="font-black text-stone-900 text-sm sm:text-base leading-snug">{{ $asp->name }}</h3>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-stone-100 text-stone-700 border border-stone-200">
                                    {{ $asp->rt_rw ?? 'RT 12 RW 05' }}
                                </span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                    Kategori: {{ $asp->category ?? 'Umum' }}
                                </span>
                            </div>
                            <div class="text-[11px] text-stone-400 font-medium mt-0.5 flex items-center gap-1.5">
                                <i class="fa-regular fa-clock text-[10px]"></i>
                                <span>{{ \Carbon\Carbon::parse($asp->created_at)->translatedFormat('d F Y, H:i') }} WIB</span>
                                <span>•</span>
                                <span>{{ \Carbon\Carbon::parse($asp->created_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Direct Contact & Delete Actions -->
                    <div class="flex items-center gap-2 self-end sm:self-center">
                        @if($asp->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $asp->phone) }}?text=Halo%20{{ urlencode($asp->name) }},%20kami%20dari%20Pengurus%20Unit%20Penghubung%20Warga%20RT%2012%20RW%2005%20ingin%20menindaklanjuti%20aspirasi%20Anda." target="_blank" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-black px-3.5 py-2 rounded-xl text-xs shadow-sm transition">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Chat Warga</span>
                            </a>
                        @endif

                        <form action="{{ route('admin.aspirations.delete', $asp->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aspirasi dari {{ $asp->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 hover:text-rose-900 border border-rose-200/80 transition" title="Hapus Aspirasi">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Message Quote -->
                <div class="p-4 rounded-2xl bg-stone-50 border border-stone-200/60 text-xs sm:text-sm text-stone-700 leading-relaxed italic">
                    <i class="fa-solid fa-quote-left text-stone-300 mr-2 text-base"></i>
                    {{ $asp->message }}
                </div>

                <!-- Status Update Form -->
                <form action="{{ route('admin.aspirations.update', $asp->id) }}" method="POST" class="pt-2 flex flex-col md:flex-row items-center gap-3">
                    @csrf
                    @method('PUT')

                    <div class="w-full md:w-56 flex-shrink-0">
                        <label class="block text-[10px] font-black uppercase text-stone-400 tracking-wider mb-1">Status Penanganan</label>
                        <select name="status" class="w-full bg-white border border-stone-200 rounded-xl px-3 py-2 text-xs font-black focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <option value="Menunggu Ditinjau" {{ $asp->status == 'Menunggu Ditinjau' ? 'selected' : '' }}>⏳ Menunggu Ditinjau</option>
                            <option value="Diproses" {{ $asp->status == 'Diproses' ? 'selected' : '' }}>⚙️ Sedang Diproses</option>
                            <option value="Selesai" {{ $asp->status == 'Selesai' ? 'selected' : '' }}>✅ Selesai / Dituntaskan</option>
                        </select>
                    </div>

                    <div class="w-full md:flex-1">
                        <label class="block text-[10px] font-black uppercase text-stone-400 tracking-wider mb-1">Catatan Respon Pengurus (Tampil ke Warga)</label>
                        <input type="text" name="admin_notes" value="{{ $asp->admin_notes }}" placeholder="Contoh: Tim gotong royong akan membersihkan saluran pada hari Minggu..." class="w-full bg-white border border-stone-200 rounded-xl px-3 py-2 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    <div class="w-full md:w-auto self-end">
                        <button type="submit" class="w-full md:w-auto bg-stone-900 hover:bg-emerald-700 text-white font-black px-5 py-2.5 rounded-xl text-xs shadow transition whitespace-nowrap">
                            <i class="fa-solid fa-floppy-disk mr-1.5"></i>
                            <span>Simpan Respon</span>
                        </button>
                    </div>
                </form>

            </div>
        @empty
            <div class="text-center py-16 bg-white rounded-3xl border border-stone-200 text-stone-400 text-xs">
                <div class="w-16 h-16 rounded-3xl bg-stone-100 text-stone-400 flex items-center justify-center mx-auto text-2xl mb-4">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <div class="font-black text-base text-stone-800">Belum Ada Aspirasi Masuk</div>
                <div class="text-xs text-stone-400 mt-1 max-w-sm mx-auto">
                    Warga dapat mengirim saran dan aspirasi melalui formulir publik di halaman Aspirasi Warga.
                </div>
            </div>
        @endforelse
    </div>

    @if($aspirations->hasPages())
        <div class="p-4 bg-white rounded-2xl border border-stone-200 shadow-sm">
            {{ $aspirations->links() }}
        </div>
    @endif

</div>
@endsection