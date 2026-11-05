<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $initialLogs = [
            [
                'user_name' => 'Anisa Rahmawati (Bendahara)',
                'user_role' => 'bendahara',
                'action' => 'TAMBAH',
                'module' => 'Kas Keuangan',
                'description' => "Mencatat transaksi Pemasukan: 'Iuran Warga RT 012 (Kolektif 60 KK)' sebesar Rp 3.000.000",
                'created_at' => now()->subHours(5),
            ],
            [
                'user_name' => 'Reza Aditya (Divisi Perlap)',
                'user_role' => 'perlap',
                'action' => 'TAMBAH',
                'module' => 'Inventaris Barang',
                'description' => "Menambahkan aset barang: 4 Unit 'Tenda Kerucut 3x3 Meter' (Kondisi: Baik, Lokasi: Gudang Balai RT 012)",
                'created_at' => now()->subHours(4),
            ],
            [
                'user_name' => 'Fajar Nugraha (Divisi Acara)',
                'user_role' => 'acara',
                'action' => 'TAMBAH',
                'module' => 'Agenda Kegiatan',
                'description' => "Menjadwalkan kegiatan baru: 'Kerja Bakti Akbar & Pengecatan Gapura RT 012' (Status: Akan Datang)",
                'created_at' => now()->subHours(3),
            ],
            [
                'user_name' => 'Siti Nur Aisyah (Sekertaris)',
                'user_role' => 'sekertaris',
                'action' => 'STATUS',
                'module' => 'Aspirasi Warga',
                'description' => "Mengubah status aspirasi 'Bapak Joko Santoso' dari 'Menunggu Ditinjau' ke 'Diproses'",
                'created_at' => now()->subHours(2),
            ],
            [
                'user_name' => 'Bella Oktavia (Divisi Dokum)',
                'user_role' => 'dokum',
                'action' => 'TAMBAH',
                'module' => 'Galeri Foto',
                'description' => "Mengunggah foto dokumentasi: 'Malam Puncak HUT RI Bertema Jumanji Pemuda RT 012' (Kategori: Peringatan HUT RI)",
                'created_at' => now()->subHour(),
            ],
            [
                'user_name' => 'Muhammad Rizky Pratama (Ketua)',
                'user_role' => 'ketua',
                'action' => 'UPDATE',
                'module' => 'Berita & Informasi',
                'description' => "Memperbarui artikel berita: 'Meriah dan Kompak! Semarak Peringatan Lingkungan RT 012 Bertema Petualangan Jumanji'",
                'created_at' => now()->subMinutes(30),
            ],
            [
                'user_name' => 'Administrator Sistem RT 012',
                'user_role' => 'admin',
                'action' => 'LOGIN',
                'module' => 'Autentikasi',
                'description' => 'Berhasil login ke Dashboard Pengurus.',
                'created_at' => now()->subMinutes(10),
            ],
        ];

        foreach ($initialLogs as $log) {
            ActivityLog::create(array_merge($log, [
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            ]));
        }
    }
}
