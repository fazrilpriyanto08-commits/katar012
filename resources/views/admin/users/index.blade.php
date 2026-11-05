@extends('layouts.admin')

@section('title', 'Manajemen Akun Pengurus - Admin Panel RT 012')
@section('page_title', 'Registrasi & Akun Pengurus')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-stone-950 via-stone-900 to-emerald-950 p-6 sm:p-8 rounded-3xl border border-emerald-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-solid fa-users-gear text-amber-400"></i>
                    <span>Otoritas & Manajemen Akses Pengurus</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Registrasi & Pengaturan Akun Panitia
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Kelola hak akses berjenjang per divisi (Ketua, Wakil, Sekertaris, Bendahara, Acara, Perlap, Dokum, dan Admin). Setiap divisi memiliki wewenang khusus untuk menjaga integritas data.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <span class="px-4 py-2 rounded-2xl bg-white/10 text-stone-200 text-xs font-bold border border-white/20">
                    <i class="fa-solid fa-lock text-emerald-400 mr-1.5"></i> Autentikasi Terenkripsi
                </span>
            </div>
        </div>
    </div>

    <!-- Top Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black text-stone-400 uppercase tracking-wider">Total Akun Aktif</span>
                <div class="text-2xl font-black text-stone-900 mt-1">{{ $users->total() }} Akun</div>
                <span class="text-[10px] text-stone-500 font-semibold mt-0.5 block">Tercatat di sistem RT 12</span>
            </div>
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 text-xl shadow-inner">
                <i class="fa-solid fa-users-gear"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black text-stone-400 uppercase tracking-wider">Divisi Kepanitiaan</span>
                <div class="text-2xl font-black text-amber-700 mt-1">{{ count($roles) }} Divisi</div>
                <span class="text-[10px] text-amber-600 font-semibold mt-0.5 block">Matriks hak akses terpisah</span>
            </div>
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 text-xl shadow-inner">
                <i class="fa-solid fa-sitemap"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black text-stone-400 uppercase tracking-wider">Tingkat Keamanan</span>
                <div class="text-2xl font-black text-blue-700 mt-1">Multi-Role RBAC</div>
                <span class="text-[10px] text-blue-600 font-semibold mt-0.5 block">Proteksi menu & audit log</span>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-xl shadow-inner">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
        </div>
    </div>

    <!-- Add New User Form Card -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden" x-data="{ formOpen: false }">
        <button @click="formOpen = !formOpen" class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-stone-50/80 transition">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 bg-emerald-700 rounded-2xl flex items-center justify-center text-white font-black shadow-md shadow-emerald-950/20">
                    <i class="fa-solid fa-user-plus text-base"></i>
                </div>
                <div>
                    <div class="font-black text-sm text-stone-900">Registrasi Akun Pengurus Baru</div>
                    <div class="text-xs text-stone-400 mt-0.5">Buat akun login mandiri untuk anggota per divisi RT 12 RW 05</div>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs font-black text-emerald-700">
                <span x-text="formOpen ? 'Tutup Formulir' : '+ Buka Formulir'"></span>
                <i class="fa-solid fa-chevron-down transition-transform duration-200" :class="formOpen && 'rotate-180'"></i>
            </div>
        </button>

        <div x-show="formOpen" x-cloak x-transition class="px-6 pb-6 pt-2 border-t border-stone-100">
            <form action="{{ route('admin.users.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-xs font-black text-stone-700 mb-1">Nama Lengkap Pengurus <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Muhammad Rizky Pratama"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    {{-- Alamat Email Login --}}
                    <div>
                        <label class="block text-xs font-black text-stone-700 mb-1">Alamat Email Login <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Contoh: bendahara@katar012.id"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    {{-- Divisi / Role --}}
                    <div>
                        <label class="block text-xs font-black text-stone-700 mb-1">Divisi / Jabatan <span class="text-rose-500">*</span></label>
                        <select name="role" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs font-bold focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                            <option value="">-- Pilih Jabatan / Divisi --</option>
                            @foreach($roles as $key => $r)
                                <option value="{{ $key }}" {{ old('role') == $key ? 'selected' : '' }}>
                                    {{ $r['badge'] }} - {{ $r['label'] }} ({{ $r['desc'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- No WhatsApp --}}
                    <div>
                        <label class="block text-xs font-black text-stone-700 mb-1">Nomor WhatsApp / HP</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-black text-stone-700 mb-1">Kata Sandi (Minimal 6 karakter) <span class="text-rose-500">*</span></label>
                        <input type="password" name="password" required placeholder="••••••••"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="block text-xs font-black text-stone-700 mb-1">Ulangi Kata Sandi <span class="text-rose-500">*</span></label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-stone-200 text-xs focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                {{-- Role info card --}}
                <div class="bg-stone-50 border border-stone-200/80 rounded-2xl p-4 text-xs text-stone-600">
                    <span class="font-black text-stone-900 flex items-center gap-1.5 mb-1.5">
                        <i class="fa-solid fa-shield-halved text-emerald-700"></i> Matriks Hak Akses Berdasarkan Divisi:
                    </span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 text-[11px] mt-2">
                        <div>⚡ <strong>Admin:</strong> Hak penuh semua modul & kelola akun.</div>
                        <div>👑 <strong>Ketua / Wakil:</strong> Seluruh modul konten (kecuali kas keuangan & kelola akun).</div>
                        <div>💰 <strong>Bendahara:</strong> Khusus Kas & Buku Keuangan.</div>
                        <div>📦 <strong>Perlap:</strong> Khusus Logistik & Inventaris Barang.</div>
                        <div>🎪 <strong>Acara:</strong> Berita & Kalender Agenda Kegiatan.</div>
                        <div>📸 <strong>Dokum:</strong> Galeri Foto & Hall of Fame.</div>
                        <div>📝 <strong>Sekertaris:</strong> Berita, Aspirasi Warga, & Database Pemuda.</div>
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="bg-emerald-700 hover:bg-emerald-800 text-white font-black text-xs px-6 py-2.5 rounded-xl shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-user-check"></i>
                        <span>Daftarkan Akun Pengurus</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Filter Toolbar -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm p-5">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-stone-400 text-xs"></i>
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama pengurus, email login, atau nomor WhatsApp..."
                       class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-stone-200 text-xs font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>

            <select name="role" class="px-4 py-2.5 rounded-xl border border-stone-200 text-xs font-bold focus:outline-none focus:ring-2 focus:ring-emerald-500 bg-white">
                <option value="">Semua Divisi / Jabatan</option>
                @foreach($roles as $key => $r)
                    <option value="{{ $key }}" {{ ($role ?? '') == $key ? 'selected' : '' }}>{{ $r['label'] }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-stone-900 hover:bg-stone-800 text-white font-black text-xs px-5 py-2.5 rounded-xl transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-filter"></i>
                <span>Filter</span>
            </button>

            @if($search || $role)
                <a href="{{ route('admin.users.index') }}" class="text-center bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold text-xs px-4 py-2.5 rounded-xl transition flex items-center justify-center gap-1">
                    <i class="fa-solid fa-xmark"></i> Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Users Table Presentation -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-stone-100 flex items-center justify-between bg-stone-50/50">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-users text-emerald-700 text-sm"></i>
                <h3 class="text-xs font-black text-stone-900 uppercase tracking-wider">Daftar Akun Pengurus Aktif</h3>
            </div>
            <span class="text-xs text-stone-500 font-medium">
                Menampilkan <strong>{{ $users->count() }}</strong> dari <strong>{{ $users->total() }}</strong> akun
            </span>
        </div>

        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-stone-50 border-b border-stone-200/80 text-[11px] font-black uppercase tracking-wider text-stone-500">
                            <th class="py-4 px-5">Nama Pengurus</th>
                            <th class="py-4 px-5">Email Login</th>
                            <th class="py-4 px-5 text-center">Divisi / Jabatan</th>
                            <th class="py-4 px-5">No. WhatsApp</th>
                            <th class="py-4 px-5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-stone-50/80 transition" x-data="{ editing: false }">
                                {{-- View Mode --}}
                                <template x-if="!editing">
                                    <td class="py-4 px-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-600 to-teal-700 text-white font-black flex items-center justify-center text-xs shadow-sm flex-shrink-0">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="font-black text-stone-900 text-sm flex items-center gap-2">
                                                    <span>{{ $user->name }}</span>
                                                    @if(auth()->id() === $user->id)
                                                        <span class="text-[9px] font-black uppercase bg-emerald-600 text-white px-2 py-0.5 rounded-full">
                                                            Anda
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="text-[11px] text-stone-400 font-medium mt-0.5">Dibuat: {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                </template>

                                <template x-if="!editing">
                                    <td class="py-4 px-5 whitespace-nowrap">
                                        <span class="font-mono text-xs font-bold text-stone-800 bg-stone-100 px-2.5 py-1 rounded-xl border border-stone-200">
                                            {{ $user->email }}
                                        </span>
                                    </td>
                                </template>

                                <template x-if="!editing">
                                    <td class="py-4 px-5 text-center whitespace-nowrap">
                                        @php
                                            $badgeClasses = match($user->role) {
                                                'admin' => 'bg-rose-100 text-rose-900 border-rose-300',
                                                'ketua' => 'bg-emerald-100 text-emerald-900 border-emerald-300',
                                                'wakil' => 'bg-teal-100 text-teal-900 border-teal-300',
                                                'bendahara' => 'bg-amber-100 text-amber-900 border-amber-300',
                                                'perlap' => 'bg-orange-100 text-orange-900 border-orange-300',
                                                'acara' => 'bg-indigo-100 text-indigo-900 border-indigo-300',
                                                'dokum' => 'bg-purple-100 text-purple-900 border-purple-300',
                                                'sekertaris' => 'bg-blue-100 text-blue-900 border-blue-300',
                                                default => 'bg-stone-100 text-stone-800 border-stone-300',
                                            };
                                        @endphp
                                        <span class="text-[11px] font-black px-3 py-1 rounded-full border {{ $badgeClasses }} shadow-xs inline-block">
                                            {{ $user->role_badge }}
                                        </span>
                                    </td>
                                </template>

                                <template x-if="!editing">
                                    <td class="py-4 px-5 text-xs font-medium text-stone-600 whitespace-nowrap">
                                        @if($user->phone)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" class="hover:text-emerald-700 flex items-center gap-1.5 font-bold">
                                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                                <span>{{ $user->phone }}</span>
                                            </a>
                                        @else
                                            <span class="text-stone-300">-</span>
                                        @endif
                                    </td>
                                </template>

                                <template x-if="!editing">
                                    <td class="py-4 px-5 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-1.5">
                                            <button @click="editing = true" class="p-2 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200/80 transition" title="Edit Akun">
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </button>

                                            @if(auth()->id() !== $user->id)
                                                <form action="{{ route('admin.users.delete', $user) }}" method="POST" onsubmit="return confirm('Hapus akun pengurus {{ $user->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200/80 transition" title="Hapus Akun">
                                                        <i class="fa-solid fa-trash text-xs"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </template>

                                {{-- Inline Edit Mode --}}
                                <template x-if="editing">
                                    <td colspan="5" class="py-4 px-5 bg-emerald-50/40">
                                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end">
                                                <div>
                                                    <label class="text-[10px] font-black text-stone-600">Nama</label>
                                                    <input type="text" name="name" value="{{ $user->name }}" required
                                                           class="w-full px-3 py-2 rounded-xl border border-stone-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black text-stone-600">Email Login</label>
                                                    <input type="email" name="email" value="{{ $user->email }}" required
                                                           class="w-full px-3 py-2 rounded-xl border border-stone-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black text-stone-600">Divisi / Jabatan</label>
                                                    <select name="role" required class="w-full px-3 py-2 rounded-xl border border-stone-200 text-xs font-bold focus:ring-2 focus:ring-emerald-500 bg-white">
                                                        @foreach($roles as $key => $r)
                                                            <option value="{{ $key }}" {{ $user->role == $key ? 'selected' : '' }}>{{ $r['badge'] }} - {{ $r['label'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black text-stone-600">No. WhatsApp</label>
                                                    <input type="text" name="phone" value="{{ $user->phone }}" placeholder="08..."
                                                           class="w-full px-3 py-2 rounded-xl border border-stone-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500">
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-3">
                                                <div>
                                                    <label class="text-[10px] font-black text-stone-600">Ganti Kata Sandi (Kosongkan bila tetap)</label>
                                                    <input type="password" name="password" placeholder="Minimal 6 karakter"
                                                           class="w-full px-3 py-2 rounded-xl border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black text-stone-600">Ulangi Kata Sandi Baru</label>
                                                    <input type="password" name="password_confirmation" placeholder="Ulangi kata sandi"
                                                           class="w-full px-3 py-2 rounded-xl border border-stone-200 text-xs focus:ring-2 focus:ring-emerald-500">
                                                </div>
                                            </div>

                                            <div class="flex gap-2 mt-3 justify-end">
                                                <button type="button" @click="editing = false" class="px-4 py-2 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-600 text-xs font-black transition">
                                                    Batal
                                                </button>
                                                <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-black transition shadow">
                                                    <i class="fa-solid fa-check mr-1"></i> Simpan Perubahan
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </template>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-stone-100 bg-stone-50/50">
                {{ $users->withQueryString()->links('pagination::tailwind') }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-stone-100 rounded-3xl flex items-center justify-center mx-auto mb-4 text-stone-400">
                    <i class="fa-solid fa-users text-2xl"></i>
                </div>
                <h3 class="font-black text-stone-700">Belum Ada Akun Pengurus Ditemukan</h3>
                <p class="text-xs text-stone-400 mt-1">Daftarkan akun pengurus baru menggunakan formulir di atas.</p>
            </div>
        @endif
    </div>

</div>
@endsection