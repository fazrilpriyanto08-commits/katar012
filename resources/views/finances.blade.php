@extends('layouts.app')

@section('title', 'Transparansi Kas & Donasi 17-an - Unit Penghubung Warga RT 12 RW 05')

@section('content')
<!-- Header Banner (Jumanji Style) -->
<div class="bg-gradient-to-br from-emerald-950 via-stone-900 to-green-950 text-white py-14 border-b border-emerald-800/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-400/20 text-amber-300 text-xs font-black uppercase tracking-wider border border-amber-400/30">
            <i class="fa-solid fa-coins"></i> Laporan Keuangan Terbuka
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">Transparansi Kas & Anggaran 17-an</h1>
        <p class="text-stone-300 text-sm sm:text-base max-w-2xl mx-auto">
            Laporan terbuka iuran warga, dana sponsor, dan pengeluaran kepanitiaan HUT RI Tema Jumanji RT 12 RW 05 demi akuntabilitas bersama.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12" x-data="{ showProofModal: false, proofImg: '', proofTitle: '' }">

    <!-- 3 Big Cards: Saldo, Pemasukan, Pengeluaran -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Total Pemasukan -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-emerald-200 shadow-sm flex items-center justify-between relative overflow-hidden">
            <div class="space-y-1">
                <div class="text-xs font-bold text-emerald-700 uppercase tracking-wider flex items-center gap-1">
                    <i class="fa-solid fa-arrow-down-long"></i> Total Dana Terkumpul
                </div>
                <div class="text-2xl sm:text-3xl font-black text-stone-900">
                    Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </div>
                <div class="text-[11px] text-stone-500">Iuran warga, kas awal & donatur</div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl font-bold">
                <i class="fa-solid fa-hand-holding-dollar"></i>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-rose-200 shadow-sm flex items-center justify-between relative overflow-hidden">
            <div class="space-y-1">
                <div class="text-xs font-bold text-rose-600 uppercase tracking-wider flex items-center gap-1">
                    <i class="fa-solid fa-arrow-up-long"></i> Total Pengeluaran
                </div>
                <div class="text-2xl sm:text-3xl font-black text-stone-900">
                    Rp {{ number_format($totalExpense, 0, ',', '.') }}
                </div>
                <div class="text-[11px] text-stone-500">Hadiah lomba, panggung & konsumsi</div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-2xl font-bold">
                <i class="fa-solid fa-receipt"></i>
            </div>
        </div>

        <!-- Sisa Saldo Kas Terkini -->
        <div class="bg-gradient-to-br from-emerald-900 via-green-900 to-stone-950 text-white rounded-3xl p-6 sm:p-8 border border-emerald-700 shadow-lg flex items-center justify-between relative overflow-hidden">
            <div class="space-y-1 relative z-10">
                <div class="text-xs font-black text-amber-400 uppercase tracking-wider flex items-center gap-1">
                    <i class="fa-solid fa-wallet"></i> Sisa Saldo Kas Terkini
                </div>
                <div class="text-2xl sm:text-3xl font-black text-white">
                    Rp {{ number_format($balance, 0, ',', '.') }}
                </div>
                <div class="text-[11px] text-emerald-200">Saldo aman & siap digunakan</div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-white/10 text-amber-400 flex items-center justify-center text-2xl font-bold border border-white/20">
                <i class="fa-solid fa-vault"></i>
            </div>
        </div>

    </div>

    <!-- Saluran Donasi & Iuran Warga Callout -->
    <div class="bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-400 text-stone-950 rounded-3xl p-6 sm:p-8 shadow-md border border-amber-300">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            
            <div class="lg:col-span-8 space-y-2">
                <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-stone-950 text-amber-300 text-xs font-black uppercase">
                    <i class="fa-solid fa-heart"></i> Partisipasi Warga & Donatur
                </div>
                <h3 class="text-xl sm:text-2xl font-black tracking-tight">Ingin Menyalurkan Donasi atau Iuran 17-an?</h3>
                <p class="text-xs sm:text-sm text-stone-900 font-medium leading-relaxed">
                    Setiap rupiah sumbangan Anda sangat berarti untuk memeriahkan pesta rakyat dan kebahagiaan adik-adik serta warga RT 012 RW 05. Seluruh donasi akan langsung tercatat secara terbuka di halaman ini.
                </p>
                <div class="pt-2 flex flex-wrap items-center gap-4 text-xs font-bold text-stone-900">
                    <span class="bg-white/80 px-3 py-1.5 rounded-xl border border-stone-800/10">
                        <i class="fa-solid fa-building-columns text-emerald-800 mr-1"></i> Rekening BCA: <span class="font-mono text-sm">123-456-7890</span> (a.n. Bendahara Katar RT 012)
                    </span>
                    <span class="bg-white/80 px-3 py-1.5 rounded-xl border border-stone-800/10">
                        <i class="fa-solid fa-money-bill-wave text-emerald-800 mr-1"></i> Tunai: Melalui Pengurus RT / Gang
                    </span>
                </div>
            </div>

            <div class="lg:col-span-4 flex justify-start lg:justify-end">
                <a href="https://wa.me/6281412357231?text=Halo%20Bendahara%20Katar%20RT%20012,%20saya%20warga%20RT%20012%20ingin%20konfirmasi%20iuran/donasi%20kegiatan%2017-an." target="_blank" class="inline-flex items-center gap-2 bg-stone-950 hover:bg-stone-900 text-white font-extrabold px-6 py-3.5 rounded-2xl shadow transition text-xs sm:text-sm">
                    <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i>
                    <span>Konfirmasi via WhatsApp</span>
                </a>
            </div>

        </div>
    </div>

    <!-- Filter & Tabel Rincian Arus Kas -->
    <div class="space-y-6">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-black text-stone-900">Rincian Keluar Masuk Kas</h2>
                <p class="text-xs text-stone-500 mt-0.5">Catatan pembukuan transparan per transaksi.</p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-center gap-2">
                <a href="{{ route('finances') }}" class="px-4 py-2 rounded-xl text-xs font-extrabold transition {{ !$filter ? 'bg-emerald-700 text-white shadow-sm' : 'bg-white text-stone-600 hover:bg-stone-100 border border-stone-200' }}">
                    Semua
                </a>
                <a href="{{ route('finances', ['type' => 'income']) }}" class="px-4 py-2 rounded-xl text-xs font-extrabold transition {{ $filter == 'income' ? 'bg-emerald-700 text-white shadow-sm' : 'bg-white text-stone-600 hover:bg-stone-100 border border-stone-200' }}">
                    Pemasukan (+)
                </a>
                <a href="{{ route('finances', ['type' => 'expense']) }}" class="px-4 py-2 rounded-xl text-xs font-extrabold transition {{ $filter == 'expense' ? 'bg-rose-700 text-white shadow-sm' : 'bg-white text-stone-600 hover:bg-stone-100 border border-stone-200' }}">
                    Pengeluaran (-)
                </a>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-3xl border border-stone-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-stone-50 border-b border-stone-200 text-stone-500 uppercase tracking-wider font-extrabold">
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Uraian / Keterangan Transaksi</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Tipe</th>
                            <th class="p-4 text-right">Nominal (Rp)</th>
                            <th class="p-4 text-center">Bukti Nota</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($transactions as $t)
                            <tr class="hover:bg-stone-50/60 transition">
                                <td class="p-4 whitespace-nowrap text-stone-500 font-semibold">
                                    {{ \Carbon\Carbon::parse($t->transaction_date)->translatedFormat('d M Y') }}
                                </td>
                                <td class="p-4">
                                    <div class="font-extrabold text-stone-900 text-sm">{{ $t->title }}</div>
                                    @if($t->notes)
                                        <div class="text-[11px] text-stone-500 mt-0.5">{{ $t->notes }}</div>
                                    @endif
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <span class="bg-stone-100 text-stone-700 font-bold px-2.5 py-1 rounded-md text-[11px]">
                                        {{ $t->category }}
                                    </span>
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    @if($t->type == 'income')
                                        <span class="bg-emerald-50 text-emerald-800 font-black px-2.5 py-1 rounded-md text-[10px] uppercase">
                                            + Pemasukan
                                        </span>
                                    @else
                                        <span class="bg-rose-50 text-rose-800 font-black px-2.5 py-1 rounded-md text-[10px] uppercase">
                                            - Pengeluaran
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-right whitespace-nowrap font-black text-sm {{ $t->type == 'income' ? 'text-emerald-700' : 'text-rose-600' }}">
                                    {{ $t->type == 'income' ? '+' : '-' }} {{ number_format($t->amount, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-center whitespace-nowrap">
                                    @if($t->proof_image)
                                        <button @click="showProofModal = true; proofImg = '{{ $t->proof_image }}'; proofTitle = '{{ addslashes($t->title) }}'" class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 hover:text-emerald-900 bg-emerald-50 px-2.5 py-1 rounded-lg">
                                            <i class="fa-solid fa-receipt"></i>
                                            <span>Lihat Nota</span>
                                        </button>
                                    @else
                                        <span class="text-stone-300">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-stone-400">Belum ada transaksi pada kategori ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-stone-100">
                {{ $transactions->links() }}
            </div>
        </div>

    </div>

    <!-- Proof Lightbox Modal -->
    <div x-show="showProofModal" x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-sm"
         @keydown.escape.window="showProofModal = false">
        
        <div class="relative max-w-lg w-full bg-stone-900 rounded-3xl overflow-hidden shadow-2xl border border-stone-800" @click.outside="showProofModal = false">
            <button @click="showProofModal = false" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-black/60 text-white flex items-center justify-center hover:bg-black/80">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="p-4 max-h-[75vh] flex items-center justify-center bg-black">
                <img :src="proofImg" :alt="proofTitle" class="max-h-[75vh] w-auto object-contain">
            </div>
            <div class="p-4 bg-stone-900 text-white">
                <div class="text-xs text-amber-400 font-bold uppercase">Bukti Nota / Kuitansi</div>
                <div class="text-sm font-extrabold mt-0.5" x-text="proofTitle"></div>
            </div>
        </div>
    </div>

</div>
@endsection
