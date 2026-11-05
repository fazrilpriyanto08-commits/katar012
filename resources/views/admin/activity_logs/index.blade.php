@extends('layouts.admin')

@section('title', 'Pusat Audit & Log Aktivitas - Panel Pengurus RT 012')
@section('page_title', 'Pusat Audit & Rekam Jejak')

@section('content')
<div class="space-y-6">

    <!-- Header & Info Banner (Security & Audit Command) -->
    <div class="relative overflow-hidden bg-gradient-to-r from-stone-950 via-stone-900 to-stone-950 p-6 sm:p-8 rounded-3xl border border-stone-800 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-shield-halved text-amber-400"></i>
                    <span>Hak Akses Terproteksi: Super Administrator</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Audit Trail & Rekam Jejak Pengurus
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Sistem pemantauan terenkripsi yang merekam seluruh aksi penambahan, pembaruan konten, perubahan status, dan penghapusan data secara transparan untuk menjaga akuntabilitas antar panitia RT 12 RW 05.
                </p>
            </div>

            @if($logs->total() > 0)
                <div class="flex-shrink-0">
                    <button type="button" onclick="document.getElementById('modal-clear-log').classList.remove('hidden')"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-rose-950/40 hover:bg-rose-600 text-rose-300 hover:text-white text-xs font-black border border-rose-800/50 hover:border-rose-600 shadow-lg shadow-rose-950/40 transition">
                        <i class="fa-solid fa-trash-can"></i>
                        <span>Bersihkan Seluruh Riwayat Log</span>
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Stats Overview (Executive KPI Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Log -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between hover:shadow-md transition">
            <div>
                <div class="text-[11px] font-black text-stone-400 uppercase tracking-wider">Total Catatan Log</div>
                <div class="text-3xl font-black text-stone-900 mt-1">{{ number_format($metrics['total'] ?? $logs->total(), 0, ',', '.') }}</div>
                <div class="text-[10px] text-stone-500 font-bold mt-1">
                    <i class="fa-solid fa-database text-[9px] mr-1"></i>Rekam jejak tersimpan
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-stone-100 text-stone-700 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>

        <!-- Aktivitas Hari Ini -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between hover:shadow-md transition">
            <div>
                <div class="text-[11px] font-black text-stone-400 uppercase tracking-wider">Aktivitas Hari Ini</div>
                <div class="text-3xl font-black text-emerald-700 mt-1">
                    {{ $metrics['today'] ?? 0 }}
                </div>
                <div class="text-[10px] text-emerald-600 font-bold mt-1 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Tindakan tercatat hari ini</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-bolt"></i>
            </div>
        </div>

        <!-- Perubahan Data -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between hover:shadow-md transition">
            <div>
                <div class="text-[11px] font-black text-stone-400 uppercase tracking-wider">Perubahan Konten / Status</div>
                <div class="text-3xl font-black text-blue-700 mt-1">
                    {{ $metrics['updates'] ?? 0 }}
                </div>
                <div class="text-[10px] text-blue-600 font-bold mt-1">
                    <i class="fa-solid fa-pen-to-square text-[9px] mr-1"></i>Modifikasi & status diperbarui
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-pen-nib"></i>
            </div>
        </div>

        <!-- Tindakan Sensitif (Hapus & Login) -->
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between hover:shadow-md transition">
            <div>
                <div class="text-[11px] font-black text-stone-400 uppercase tracking-wider">Aksi Hapus & Sesi</div>
                <div class="text-3xl font-black text-rose-700 mt-1">
                    {{ $metrics['deletes'] ?? 0 }} <span class="text-xs font-semibold text-stone-400">hapus</span>
                </div>
                <div class="text-[10px] text-rose-600 font-bold mt-1">
                    <i class="fa-solid fa-triangle-exclamation text-[9px] mr-1"></i>Tindakan berdampak tinggi
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fa-solid fa-shield-virus"></i>
            </div>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white p-6 rounded-3xl border border-stone-200/80 shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-stone-100 pb-3">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-filter text-emerald-700 text-sm"></i>
                <h3 class="text-xs font-black text-stone-900 uppercase tracking-wider">Pencarian & Filter Audit Trail</h3>
            </div>
            @if(request()->hasAny(['q', 'role', 'action', 'module']))
                <a href="{{ route('admin.activity-logs.index') }}" class="text-[11px] font-black text-rose-600 hover:underline flex items-center gap-1">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Reset Semua Filter</span>
                </a>
            @endif
        </div>

        <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5">
            
            {{-- Search Keyword --}}
            <div class="lg:col-span-2">
                <label class="block text-[11px] font-black text-stone-500 uppercase tracking-wider mb-1">Cari Kata Kunci</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-stone-400 text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama panitia, rincian aktivitas, judul data..."
                           class="w-full pl-9 pr-3.5 py-2.5 text-xs rounded-xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 font-medium">
                </div>
            </div>

            {{-- Filter Divisi / Role --}}
            <div>
                <label class="block text-[11px] font-black text-stone-500 uppercase tracking-wider mb-1">Divisi Panitia</label>
                <select name="role" class="w-full px-3 py-2.5 text-xs rounded-xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-medium">
                    <option value="">-- Semua Divisi --</option>
                    @foreach($roles as $key => $r)
                        <option value="{{ $key }}" {{ request('role') == $key ? 'selected' : '' }}>
                            {{ $r['badge'] }} ({{ $r['label'] }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Jenis Aksi --}}
            <div>
                <label class="block text-[11px] font-black text-stone-500 uppercase tracking-wider mb-1">Jenis Tindakan</label>
                <select name="action" class="w-full px-3 py-2.5 text-xs rounded-xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-medium">
                    <option value="">-- Semua Tindakan --</option>
                    @foreach($actions as $actKey => $actLabel)
                        <option value="{{ $actKey }}" {{ request('action') == $actKey ? 'selected' : '' }}>
                            {{ $actKey }} ({{ $actLabel }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Modul --}}
            <div>
                <label class="block text-[11px] font-black text-stone-500 uppercase tracking-wider mb-1">Modul Terkait</label>
                <select name="module" class="w-full px-3 py-2.5 text-xs rounded-xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white font-medium">
                    <option value="">-- Semua Modul --</option>
                    @foreach($modules as $m)
                        <option value="{{ $m }}" {{ request('module') == $m ? 'selected' : '' }}>
                            {{ $m }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="sm:col-span-2 lg:col-span-5 flex items-center justify-between pt-2">
                <div class="text-xs text-stone-500 font-semibold">
                    Menampilkan <strong class="text-stone-900">{{ $logs->count() }}</strong> dari <strong class="text-stone-900">{{ $logs->total() }}</strong> rekam jejak
                </div>
                <div class="flex items-center gap-2">
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-black shadow-md shadow-emerald-950/30 transition flex items-center gap-2">
                        <i class="fa-solid fa-filter"></i>
                        <span>Terapkan Filter</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Activity Log Table (Enterprise View) -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200/80 text-[11px] font-black uppercase tracking-wider text-stone-500">
                        <th class="py-4 px-5">Waktu Eksekusi</th>
                        <th class="py-4 px-5">Pengurus / Pelaku</th>
                        <th class="py-4 px-5 text-center">Tindakan</th>
                        <th class="py-4 px-5">Modul Sistem</th>
                        <th class="py-4 px-5">Rincian Perubahan & Log</th>
                        <th class="py-4 px-5 text-right">IP & Keamanan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 text-xs">
                    @forelse($logs as $log)
                        @php
                            $badge = $log->action_badge;
                        @endphp
                        <tr class="hover:bg-stone-50/90 transition group">
                            
                            {{-- Waktu --}}
                            <td class="py-4 px-5 whitespace-nowrap align-top">
                                <div class="font-black text-stone-900 text-xs">
                                    {{ $log->created_at->format('d M Y, H:i') }} WIB
                                </div>
                                <div class="text-[10px] text-stone-400 font-medium mt-0.5 flex items-center gap-1">
                                    <i class="fa-regular fa-clock text-[9px]"></i>
                                    <span>{{ $log->created_at->diffForHumans() }}</span>
                                </div>
                            </td>

                            {{-- Pengurus --}}
                            <td class="py-4 px-5 align-top">
                                <div class="flex items-start gap-2.5">
                                    <div class="w-8 h-8 rounded-xl bg-stone-900 text-amber-400 font-black text-xs flex items-center justify-center flex-shrink-0 shadow-sm">
                                        {{ strtoupper(substr($log->user_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-stone-900 leading-snug">
                                            {{ $log->user_name }}
                                        </div>
                                        <div class="mt-1 flex items-center gap-1.5 flex-wrap">
                                            <span class="inline-block text-[9px] font-black px-2 py-0.5 rounded-md bg-stone-100 text-stone-700 border border-stone-200">
                                                {{ $log->role_badge }}
                                            </span>
                                            @if($log->user)
                                                <span class="text-[10px] text-stone-400 font-mono">({{ $log->user->email }})</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="py-4 px-5 text-center whitespace-nowrap align-top">
                                <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full border {{ $badge['bg'] }} shadow-sm">
                                    <i class="fa-solid {{ $badge['icon'] }}"></i>
                                    <span>{{ $badge['label'] }}</span>
                                </span>
                            </td>

                            {{-- Modul --}}
                            <td class="py-4 px-5 whitespace-nowrap align-top">
                                <span class="font-black text-stone-800 bg-stone-100 px-2.5 py-1 rounded-xl text-[11px] border border-stone-200/80 inline-flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>{{ $log->module }}</span>
                                </span>
                            </td>

                            {{-- Rincian Deskripsi --}}
                            <td class="py-4 px-5 align-top">
                                <div class="text-stone-800 font-semibold leading-relaxed max-w-lg">
                                    {{ $log->description }}
                                </div>
                                @if($log->details)
                                    <div class="text-[10px] text-stone-500 mt-1.5 font-mono bg-stone-50 p-2 rounded-xl border border-stone-200/80 max-w-md">
                                        {{ $log->details }}
                                    </div>
                                @endif
                            </td>

                            {{-- IP Address --}}
                            <td class="py-4 px-5 text-right whitespace-nowrap align-top">
                                <span class="inline-block font-mono text-[11px] text-stone-500 bg-stone-100 px-2 py-0.5 rounded-lg border border-stone-200">
                                    {{ $log->ip_address ?? '127.0.0.1' }}
                                </span>
                                <div class="text-[9px] text-stone-400 font-medium mt-1">
                                    <i class="fa-solid fa-network-wired text-[8px] mr-1"></i>Tervalidasi
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-16 text-center text-stone-400">
                                <div class="w-16 h-16 rounded-3xl bg-stone-100 text-stone-400 flex items-center justify-center mx-auto text-2xl mb-4">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </div>
                                <div class="font-black text-base text-stone-800">Tidak Ada Rekam Jejak Ditemukan</div>
                                <div class="text-xs text-stone-400 mt-1 max-w-md mx-auto">
                                    Tidak ada data aktivitas yang sesuai dengan kriteria pencarian atau filter yang dipilih. Silakan reset filter untuk melihat semua riwayat.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($logs->hasPages())
            <div class="p-5 border-t border-stone-100 bg-stone-50/50">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal Konfirmasi Bersihkan Log -->
<div id="modal-clear-log" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-stone-200 space-y-4">
        <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div>
            <h3 class="text-lg font-black text-stone-900">Bersihkan Riwayat Log Aktivitas?</h3>
            <p class="text-xs text-stone-500 mt-1 leading-relaxed">
                Tindakan ini akan menghapus seluruh catatan audit trail pengurus secara permanen. Hanya Super Admin yang berwenang melakukan tindakan ini.
            </p>
        </div>
        <form method="POST" action="{{ route('admin.activity-logs.clear') }}" class="flex items-center justify-end gap-3 pt-2">
            @csrf
            @method('DELETE')
            <button type="button" onclick="document.getElementById('modal-clear-log').classList.add('hidden')"
                    class="px-4 py-2.5 text-xs font-bold text-stone-600 hover:bg-stone-100 rounded-xl transition">
                Batal
            </button>
            <button type="submit" class="px-5 py-2.5 text-xs font-black bg-rose-600 hover:bg-rose-700 text-white rounded-xl shadow-lg shadow-rose-950/30 transition">
                Ya, Bersihkan Seluruh Log
            </button>
        </form>
    </div>
</div>
@endsection