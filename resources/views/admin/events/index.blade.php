@extends('layouts.admin')

@section('title', 'Jadwal Agenda & Proker - Admin Panel RT 012')
@section('page_title', 'Manajemen Agenda Kegiatan')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="relative overflow-hidden bg-gradient-to-r from-stone-950 via-stone-900 to-purple-950 p-6 sm:p-8 rounded-3xl border border-purple-900/40 text-white shadow-xl">
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full bg-purple-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30 text-[11px] font-black tracking-wider uppercase">
                    <i class="fa-regular fa-calendar-check text-amber-400"></i>
                    <span>Divisi Acara & Program Kerja</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Kalender Agenda & Aksi Lingkungan
                </h1>
                <p class="text-xs sm:text-sm text-stone-300 max-w-2xl font-medium leading-relaxed">
                    Jadwalkan kegiatan gotong royong, perlombaan 17 Agustus, rapat pengurus, turnamen olahraga, dan aksi bakti sosial warga RT 12 RW 05.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-purple-600 hover:bg-purple-500 text-white text-xs font-black shadow-lg shadow-purple-950/50 transition transform hover:-translate-y-0.5">
                    <i class="fa-regular fa-calendar-plus"></i>
                    <span>Tambah Agenda Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats Bar -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Total Program Kerja</span>
                <div class="text-2xl font-black text-stone-900 mt-1">{{ $events->total() }} Acara</div>
                <span class="text-[10px] text-stone-500 font-semibold mt-0.5 block">Tercatat di sistem RT 12</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Status Acara</span>
                <div class="text-2xl font-black text-emerald-700 mt-1">Akan Datang & Selesai</div>
                <span class="text-[10px] text-emerald-600 font-semibold mt-0.5 block">Pantau timeline proker</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-flag-checkered"></i>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-stone-200/80 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-black uppercase text-stone-400 tracking-wider">Wewenang Modul</span>
                <div class="text-2xl font-black text-blue-700 mt-1">Divisi Acara & Pimpinan</div>
                <span class="text-[10px] text-blue-600 font-semibold mt-0.5 block">Kelola rundown & teknis</span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                <i class="fa-solid fa-people-roof"></i>
            </div>
        </div>
    </div>

    <!-- Events List Presentation -->
    <div class="bg-white rounded-3xl border border-stone-200/80 shadow-sm overflow-hidden">
        
        <div class="p-5 border-b border-stone-100 flex items-center justify-between bg-stone-50/50">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-calendar-days text-purple-700 text-sm"></i>
                <h3 class="text-xs font-black text-stone-900 uppercase tracking-wider">Timeline Kegiatan RT 12</h3>
            </div>
            <span class="text-xs text-stone-500 font-medium">
                Menampilkan <strong>{{ $events->count() }}</strong> dari <strong>{{ $events->total() }}</strong> kegiatan
            </span>
        </div>

        <div class="divide-y divide-stone-100">
            @forelse($events as $event)
                <div class="p-5 hover:bg-stone-50/80 transition flex flex-col md:flex-row md:items-center justify-between gap-5 group">
                    
                    <div class="flex items-start gap-4">
                        <!-- Date Badge -->
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-600 to-indigo-700 text-white flex flex-col items-center justify-center font-black flex-shrink-0 shadow-md shadow-purple-900/20 group-hover:scale-105 transition-transform">
                            <span class="text-[10px] uppercase tracking-wider leading-none">{{ \Carbon\Carbon::parse($event->event_date)->isoFormat('MMM') }}</span>
                            <span class="text-xl leading-none mt-1">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                        </div>

                        <!-- Details -->
                        <div class="space-y-1">
                            <div class="flex items-center gap-2.5 flex-wrap">
                                <h4 class="font-black text-stone-900 text-base group-hover:text-purple-700 transition">
                                    {{ $event->title }}
                                </h4>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black border 
                                    {{ $event->status == 'Selesai' ? 'bg-stone-100 text-stone-600 border-stone-200' : 'bg-emerald-50 text-emerald-800 border-emerald-300' }}">
                                    {{ $event->status ?? 'Akan Datang' }}
                                </span>
                            </div>

                            <p class="text-xs text-stone-500 line-clamp-1 max-w-xl">
                                {{ $event->description ?: 'Kegiatan kemasyarakatan dalam rangka mempererat silaturahmi warga RT 12 RW 05.' }}
                            </p>

                            <div class="flex items-center gap-3 text-[11px] text-stone-400 font-semibold flex-wrap pt-1">
                                <span class="flex items-center gap-1 text-stone-600">
                                    <i class="fa-solid fa-location-dot text-amber-500"></i>
                                    <span>{{ $event->location ?? 'Lingkungan RT 12' }}</span>
                                </span>
                                <span>•</span>
                                <span class="flex items-center gap-1 text-stone-600">
                                    <i class="fa-regular fa-clock text-blue-500"></i>
                                    <span>{{ $event->start_time ?? '08:00' }} - {{ $event->end_time ?? 'Selesai' }} WIB</span>
                                </span>
                                <span>•</span>
                                <span class="flex items-center gap-1 text-purple-700 font-bold">
                                    <i class="fa-solid fa-users text-purple-500"></i>
                                    <span>{{ $event->organizer ?? 'Panitia RT 12' }}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 self-end md:self-center flex-shrink-0">
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 text-xs font-black border border-amber-200/80 transition" title="Edit Agenda">
                            <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                            <span>Edit Acara</span>
                        </a>

                        <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda kegiatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 hover:text-rose-900 border border-rose-200/80 transition" title="Hapus Agenda">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="py-16 text-center text-stone-400">
                    <div class="w-16 h-16 rounded-3xl bg-stone-100 text-stone-400 flex items-center justify-center mx-auto text-2xl mb-4">
                        <i class="fa-regular fa-calendar-xmark"></i>
                    </div>
                    <div class="font-black text-base text-stone-800">Belum Ada Agenda Kegiatan</div>
                    <div class="text-xs text-stone-400 mt-1 max-w-sm mx-auto">
                        Jadwalkan kegiatan gotong royong, perlombaan, atau rapat koordinasi pengurus sekarang.
                    </div>
                    <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-xl bg-purple-700 text-white text-xs font-black hover:bg-purple-800 transition">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Buat Agenda Pertama</span>
                    </a>
                </div>
            @endforelse
        </div>

        @if($events->hasPages())
            <div class="p-5 border-t border-stone-100 bg-stone-50/50">
                {{ $events->links() }}
            </div>
        @endif

    </div>

</div>
@endsection