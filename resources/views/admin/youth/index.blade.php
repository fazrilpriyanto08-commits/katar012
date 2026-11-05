@extends('layouts.admin')

@section('title', 'Database Sensus Pemuda RT 012 - Admin Panel')
@section('page_title', 'Database & Sensus Pemuda RT 012')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-teal-950 via-stone-900 to-stone-950 p-6 sm:p-8 rounded-3xl border border-teal-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-teal-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-500/20 text-teal-300 border border-teal-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-users text-amber-400"></i>
                    <span>Sensus Generasi Muda RT 12 RW 05</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Database Pemuda & Pemudi RT 012
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Daftar seluruh generasi muda warga RT 12 RW 05 yang telah terdaftar dalam sistem sensus digital. Digunakan untuk pemetaan potensi, kegiatan kepemudaan, dan kepanitiaan lingkungan.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <div class="p-3 bg-stone-900/90 rounded-2xl border border-stone-800 text-right">
                    <div class="text-[10px] font-bold text-stone-400 uppercase tracking-wider">Total Terdata</div>
                    <div class="text-2xl font-black text-teal-400">{{ $members->total() }} Jiwa</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Bar -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Laki-Laki</span>
                <div class="text-2xl font-black text-blue-700 mt-1">
                    {{ \App\Models\YouthMember::where('gender', 'like', '%Laki%')->count() }} Pemuda
                </div>
                <span class="text-[10px] text-blue-600 font-semibold mt-0.5 block">Potensi tenaga & olahraga</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-mars"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Perempuan</span>
                <div class="text-2xl font-black text-rose-600 mt-1">
                    {{ \App\Models\YouthMember::where('gender', 'like', '%Perempuan%')->count() }} Pemudi
                </div>
                <span class="text-[10px] text-rose-600 font-semibold mt-0.5 block">Potensi seni, kreasi & konsumsi</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-venus"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Akses Formulir</span>
                <div class="text-2xl font-black text-emerald-700 mt-1">Sensus Mandiri</div>
                <span class="text-[10px] text-emerald-600 font-semibold mt-0.5 block">Warga mendaftar via web</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-mobile-screen"></i>
            </div>
        </div>
    </div>

    <!-- Youth Table Presentation -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        
        <div class="p-5 border-b border-stone-100 flex items-center justify-between bg-stone-50/50">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-address-book text-teal-700 text-sm"></i>
                <h3 class="text-xs font-black text-stone-900 uppercase tracking-wider">Roster Anggota Pemuda RT 12</h3>
            </div>
            <span class="text-xs text-stone-500 font-medium">
                Menampilkan <strong>{{ $members->count() }}</strong> dari <strong>{{ $members->total() }}</strong> anggota
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200/80 text-[11px] font-black uppercase tracking-wider text-stone-500">
                        <th class="py-4 px-5">Nama Lengkap & Panggilan</th>
                        <th class="py-4 px-5">Gender & Usia</th>
                        <th class="py-4 px-5">Alamat Domisili</th>
                        <th class="py-4 px-5">Kontak WhatsApp</th>
                        <th class="py-4 px-5">Profesi & Minat</th>
                        <th class="py-4 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($members as $m)
                        <tr class="hover:bg-stone-50/80 transition group">
                            
                            {{-- Nama --}}
                            <td class="py-4 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 to-emerald-600 text-white font-black text-xs flex items-center justify-center flex-shrink-0 shadow-sm">
                                        {{ strtoupper(substr($m->full_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-stone-900 text-sm leading-snug">
                                            {{ $m->full_name }}
                                        </div>
                                        <div class="text-[11px] text-stone-400 font-medium mt-0.5">
                                            Panggilan: <span class="font-bold text-stone-600">{{ $m->nickname ?: '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Gender & Usia --}}
                            <td class="py-4 px-5 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black border 
                                    {{ str_contains($m->gender ?? '', 'Laki') ? 'bg-blue-50 text-blue-800 border-blue-200' : 'bg-rose-50 text-rose-800 border-rose-200' }}">
                                    {{ $m->gender }}
                                </span>
                                <div class="text-[11px] text-stone-400 font-medium mt-1">
                                    {{ $m->birth_date ? \Carbon\Carbon::parse($m->birth_date)->age . ' tahun' : '-' }}
                                </div>
                            </td>

                            {{-- Alamat --}}
                            <td class="py-4 px-5">
                                <div class="font-semibold text-stone-800 max-w-xs">
                                    {{ $m->address }}
                                </div>
                                <div class="text-[10px] text-stone-400 font-bold mt-0.5">RT 12 RW 05</div>
                            </td>

                            {{-- WhatsApp --}}
                            <td class="py-4 px-5 whitespace-nowrap">
                                @if($m->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $m->phone) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-black text-xs border border-emerald-200/80 transition">
                                        <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                        <span>{{ $m->phone }}</span>
                                    </a>
                                @else
                                    <span class="text-stone-400">-</span>
                                @endif
                            </td>

                            {{-- Profesi & Minat --}}
                            <td class="py-4 px-5">
                                <div class="font-black text-stone-800">{{ $m->occupation ?: 'Pelajar / Mahasiswa' }}</div>
                                <div class="mt-1">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-stone-100 text-stone-700 border border-stone-200 inline-block">
                                        {{ $m->interest ?: 'Kegiatan Pemuda' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="py-4 px-5 text-right whitespace-nowrap">
                                <form action="{{ route('admin.youth.delete', $m->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota pemuda ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 hover:text-rose-900 border border-rose-200/80 transition" title="Hapus Data">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-16 text-center text-stone-400">
                                <div class="w-16 h-16 rounded-3xl bg-stone-100 text-stone-400 flex items-center justify-center mx-auto text-2xl mb-4">
                                    <i class="fa-solid fa-users-slash"></i>
                                </div>
                                <div class="font-black text-base text-stone-800">Belum Ada Pemuda Terdata</div>
                                <div class="text-xs text-stone-400 mt-1 max-w-sm mx-auto">
                                    Ajak pemuda-pemudi RT 12 mendaftarkan diri secara online melalui halaman Sensus Pemuda.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
            <div class="p-5 border-t border-stone-100 bg-stone-50/50">
                {{ $members->links() }}
            </div>
        @endif

    </div>

</div>
@endsection