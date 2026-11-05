@extends('layouts.admin')

@section('title', 'Buku Kas & Transparansi Anggaran - Admin RT 12')
@section('page_title', 'Laporan Kas & Transparansi Anggaran')

@section('content')
<div class="space-y-6" x-data="{ formOpen: false }">

    <!-- 1. Executive Banner Keuangan -->
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-950 via-stone-900 to-stone-950 p-6 sm:p-8 rounded-3xl border border-emerald-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-coins text-amber-400"></i>
                    <span>Divisi Keuangan & Bendahara Kas</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Buku Kas & Transparansi Anggaran RT 12
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Kelola dan pantau seluruh perputaran uang masuk (iuran warga, donatur, sponsor) serta belanja operasional secara rapi, terbuka, dan akuntabel.
                </p>
            </div>

            <div class="flex items-center gap-2.5">
                <button @click="formOpen = !formOpen" class="bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 text-white font-extrabold text-xs px-4 py-2.5 rounded-xl shadow-lg transition flex items-center gap-2">
                    <i class="fa-solid" :class="formOpen ? 'fa-minus' : 'fa-plus'"></i>
                    <span x-text="formOpen ? 'Tutup Formulir' : '+ Catat Transaksi Baru'"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- 2. KPI Cards (Pemasukan, Pengeluaran, Saldo Kas) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm flex items-center justify-between hover:shadow-md transition group">
            <div>
                <span class="text-[11px] font-black uppercase tracking-wider text-stone-400">Total Pemasukan</span>
                <div class="text-2xl font-black text-emerald-700 mt-1">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
                <div class="text-[10px] text-emerald-600 font-bold mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> Dari Iuran & Donatur
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition">
                <i class="fa-solid fa-arrow-down-long"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm flex items-center justify-between hover:shadow-md transition group">
            <div>
                <span class="text-[11px] font-black uppercase tracking-wider text-stone-400">Total Pengeluaran</span>
                <div class="text-2xl font-black text-rose-600 mt-1">Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
                <div class="text-[10px] text-rose-500 font-bold mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-down"></i> Belanja & Operasional
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition">
                <i class="fa-solid fa-arrow-up-long"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm flex items-center justify-between hover:shadow-md transition group">
            <div>
                <span class="text-[11px] font-black uppercase tracking-wider text-stone-400">Sisa Saldo Kas</span>
                <div class="text-2xl font-black text-amber-600 mt-1">Rp {{ number_format($balance, 0, ',', '.') }}</div>
                <div class="text-[10px] text-amber-600 font-bold mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-shield-halved"></i> Saldo Bersih Tersimpan
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-sm group-hover:scale-110 transition">
                <i class="fa-solid fa-wallet"></i>
            </div>
        </div>
    </div>

    <!-- 3. Form Input Collapsible (Catat Transaksi) -->
    <div x-show="formOpen" x-cloak x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
         class="bg-white rounded-3xl border border-stone-200 p-6 sm:p-8 shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-stone-100 pb-3">
            <h3 class="font-black text-stone-900 text-sm flex items-center gap-2">
                <i class="fa-solid fa-file-invoice text-emerald-600"></i>
                <span>Catat Transaksi Kas Baru</span>
            </h3>
            <button @click="formOpen = false" class="text-stone-400 hover:text-stone-600 text-xs font-bold">
                Tutup <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.finances.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="space-y-1 sm:col-span-2">
                    <label class="block text-xs font-bold text-stone-700">Uraian / Keterangan Transaksi <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Iuran Warga Gang H. Saatun / Beli Cat Gapura" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Jenis Transaksi <span class="text-rose-500">*</span></label>
                    <select name="type" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2.5 text-xs font-bold focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        <option value="Pemasukan" {{ old('type') == 'Pemasukan' ? 'selected' : '' }}>🟢 Pemasukan (+)</option>
                        <option value="Pengeluaran" {{ old('type') == 'Pengeluaran' ? 'selected' : '' }}>🔴 Pengeluaran (-)</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" name="category" value="{{ old('category', 'Iuran Warga') }}" required placeholder="Iuran / Donatur / Logistik / Lomba" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Nominal Rupiah <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-xs font-black text-stone-500">Rp</span>
                        <input type="number" name="amount" value="{{ old('amount') }}" required placeholder="50000" min="1000" class="w-full bg-stone-50 border border-stone-200 rounded-xl pl-9 pr-3 py-2.5 text-xs font-black focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Tanggal Transaksi <span class="text-rose-500">*</span></label>
                    <input type="date" name="transaction_date" value="{{ old('transaction_date', date('Y-m-d')) }}" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Foto Nota / Kuitansi (Opsional)</label>
                    <input type="file" name="proof_file" accept="image/*" class="w-full text-xs text-stone-600 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-bold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 cursor-pointer bg-stone-50 border border-stone-200 rounded-xl p-1">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end pt-2">
                <div class="sm:col-span-3 space-y-1">
                    <label class="block text-xs font-bold text-stone-700">Catatan Tambahan (Opsional)</label>
                    <input type="text" name="notes" value="{{ old('notes') }}" placeholder="Keterangan toko, bukti transfer, nomor nota..." class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2.5 text-xs focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                </div>

                <div>
                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-700 to-green-700 hover:from-emerald-800 text-white font-black py-3 px-4 rounded-xl text-xs shadow-md transition flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Catatan Kas
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- 4. Smart Ledger Data Grid (Bukan Tabel CRUD Biasa) -->
    <div class="bg-white rounded-3xl border border-stone-200 overflow-hidden shadow-sm">
        <div class="p-5 border-b border-stone-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-xl bg-stone-100 text-stone-700 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div>
                    <h4 class="font-black text-stone-900 text-sm">Arus Kas & Buku Kas Lengkap</h4>
                    <span class="text-[11px] text-stone-400 font-semibold">Total {{ $transactions->total() }} catatan transaksi</span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-stone-50/80 border-b border-stone-200 text-stone-500 uppercase tracking-wider font-extrabold text-[10px]">
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Uraian Transaksi</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Tipe</th>
                        <th class="p-4 text-right">Nominal</th>
                        <th class="p-4 text-center">Bukti Nota</th>
                        <th class="p-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($transactions as $t)
                        <tr class="hover:bg-stone-50/70 transition">
                            <td class="p-4 whitespace-nowrap text-stone-500 font-bold">
                                {{ \Carbon\Carbon::parse($t->transaction_date)->format('d/m/Y') }}
                            </td>
                            <td class="p-4">
                                <div class="font-extrabold text-stone-900 text-xs">{{ $t->title }}</div>
                                @if($t->notes)
                                    <div class="text-[10px] text-stone-400 mt-0.5">{{ $t->notes }}</div>
                                @endif
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <span class="bg-stone-100 text-stone-700 px-2.5 py-1 rounded-lg text-[10px] font-bold border border-stone-200">
                                    {{ $t->category }}
                                </span>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black {{ $t->type == 'Pemasukan' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                    <i class="fa-solid {{ $t->type == 'Pemasukan' ? 'fa-arrow-down' : 'fa-arrow-up' }} text-[8px]"></i>
                                    {{ $t->type }}
                                </span>
                            </td>
                            <td class="p-4 whitespace-nowrap text-right font-black text-xs {{ $t->type == 'Pemasukan' ? 'text-emerald-700' : 'text-rose-600' }}">
                                {{ $t->type == 'Pemasukan' ? '+' : '-' }} Rp {{ number_format($t->amount, 0, ',', '.') }}
                            </td>
                            <td class="p-4 whitespace-nowrap text-center">
                                @if($t->proof)
                                    <a href="{{ asset($t->proof) }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white text-[10px] font-bold transition">
                                        <i class="fa-solid fa-receipt"></i> Nota
                                    </a>
                                @else
                                    <span class="text-stone-300 text-[10px]">-</span>
                                @endif
                            </td>
                            <td class="p-4 whitespace-nowrap text-right">
                                <form action="{{ route('admin.finances.delete', $t->id) }}" method="POST" onsubmit="return confirm('Hapus catatan transaksi ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-xl bg-stone-100 hover:bg-rose-600 text-stone-500 hover:text-white flex items-center justify-center transition">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-stone-400 text-xs">
                                Belum ada data transaksi kas yang dicatat.
                            </td>
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
@endsection
