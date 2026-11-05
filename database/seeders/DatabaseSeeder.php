<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Aspiration;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\HallOfFame;
use App\Models\InventoryItem;
use App\Models\OrganizationStructure;
use App\Models\User;
use App\Models\YouthMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Pengurus Per Divisi (Admin, Ketua, Wakil, Sekertaris, Bendahara, Acara, Perlap, Dokum)
        $defaultUsers = [
            [
                'name' => 'Administrator Sistem RT 012',
                'email' => 'admin@katar012.id',
                'role' => 'admin',
                'phone' => '081234567800',
            ],
            [
                'name' => 'Muhammad Rizky Pratama (Ketua)',
                'email' => 'ketua@katar012.id',
                'role' => 'ketua',
                'phone' => '081234567890',
            ],
            [
                'name' => 'Dimas Surya Wicaksono (Wakil)',
                'email' => 'wakil@katar012.id',
                'role' => 'wakil',
                'phone' => '081234567891',
            ],
            [
                'name' => 'Siti Nur Aisyah (Sekertaris)',
                'email' => 'sekertaris@katar012.id',
                'role' => 'sekertaris',
                'phone' => '081234567892',
            ],
            [
                'name' => 'Anisa Rahmawati (Bendahara)',
                'email' => 'bendahara@katar012.id',
                'role' => 'bendahara',
                'phone' => '081234567893',
            ],
            [
                'name' => 'Fajar Nugraha (Divisi Acara)',
                'email' => 'acara@katar012.id',
                'role' => 'acara',
                'phone' => '081234567894',
            ],
            [
                'name' => 'Reza Aditya (Divisi Perlap)',
                'email' => 'perlap@katar012.id',
                'role' => 'perlap',
                'phone' => '081234567897',
            ],
            [
                'name' => 'Bella Oktavia (Divisi Dokum)',
                'email' => 'dokum@katar012.id',
                'role' => 'dokum',
                'phone' => '081234567895',
            ],
        ];

        foreach ($defaultUsers as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make('password123'),
                    'role' => $u['role'],
                    'phone' => $u['phone'] ?? null,
                    'is_active' => true,
                ]
            );
        }

        // 2. Struktur Pengurus RT 012 / RW 05
        $structures = [
            [
                'name' => 'Muhammad Rizky Pratama',
                'position' => 'Ketua Karang Taruna',
                'division' => 'Badan Pengurus Harian',
                'photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80',
                'order' => 1,
                'phone' => '081234567890',
            ],
            [
                'name' => 'Dimas Surya Wicaksono',
                'position' => 'Wakil Ketua',
                'division' => 'Badan Pengurus Harian',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=500&q=80',
                'order' => 2,
                'phone' => '081234567891',
            ],
            [
                'name' => 'Siti Nur Aisyah',
                'position' => 'Sekretaris 1',
                'division' => 'Badan Pengurus Harian',
                'photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=500&q=80',
                'order' => 3,
                'phone' => '081234567892',
            ],
            [
                'name' => 'Anisa Rahmawati',
                'position' => 'Bendahara 1',
                'division' => 'Badan Pengurus Harian',
                'photo' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=500&q=80',
                'order' => 4,
                'phone' => '081234567893',
            ],
            [
                'name' => 'Fajar Nugraha',
                'position' => 'Koordinator Olahraga & Rekreasi',
                'division' => 'Divisi Olahraga',
                'photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=500&q=80',
                'order' => 5,
                'phone' => '081234567894',
            ],
            [
                'name' => 'Bella Oktavia',
                'position' => 'Koordinator Humas & Publikasi',
                'division' => 'Divisi Humas',
                'photo' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=500&q=80',
                'order' => 6,
                'phone' => '081234567895',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'position' => 'Koordinator Kerohanian & Sosial',
                'division' => 'Divisi Kerohanian',
                'photo' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=500&q=80',
                'order' => 7,
                'phone' => '081234567896',
            ],
            [
                'name' => 'Reza Aditya',
                'position' => 'Koordinator Kreatif & Perlengkapan',
                'division' => 'Divisi Kreatif',
                'photo' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=500&q=80',
                'order' => 8,
                'phone' => '081234567897',
            ],
        ];

        foreach ($structures as $item) {
            OrganizationStructure::create($item);
        }

        // 3. Berita & Pengumuman
        $articles = [
            [
                'title' => 'Meriah dan Kompak! Semarak Peringatan Lingkungan RT 012 Bertema Petualangan Jumanji',
                'slug' => 'semarak-peringatan-lingkungan-rt-012-bertema-jumanji',
                'category' => 'Kegiatan',
                'excerpt' => 'Kreativitas pemuda-pemudi RT 12 RW 05 memukau warga dengan tema kostum penjelajah rimba Jumanji yang kompak dan penuh semangat.',
                'content' => "Kemeriahan terasa begitu kental di wilayah RT 012 RW 05. Dalam rangka memupuk persatuan serta menyemarakkan acara lingkungan, panitia pemuda mengusung tema unik dan atraktif: 'Jumanji: Menjelajah, Bersatu, dan Berdampak Nyata'.\n\nSeluruh pemuda dan pemudi kompak mengenakan busana ala safari explorer dengan dekorasi panggung bernuansa hutan tropis. Suasana malam semakin meriah dengan berbagai penampilan pentas seni, pembagian hadiah lomba, serta apresiasi bagi tokoh masyarakat.\n\nKetua RT 012 menyampaikan rasa bangga dan terima kasih atas inisiatif luar biasa para generasi muda yang terus menghidupkan kebersamaan warga secara guyub dan menyenangkan.",
                'image' => '/images/jumanji-hero.jpg',
                'author' => 'Humas RT 012',
                'is_featured' => true,
                'published_at' => now()->subDay(),
            ],
            [
                'title' => 'Gotong Royong Bersih Saluran Air Jelang Musim Hujan di Lingkungan RT 012',
                'slug' => 'gotong-royong-bersih-saluran-air-lingkungan-rt-012',
                'category' => 'Kegiatan',
                'excerpt' => 'Puluhan pemuda dan warga RT 012 RW 05 bersama-sama membersihkan selokan dan fasilitas umum guna mencegah genangan air.',
                'content' => "Dalam rangka menjaga kebersihan lingkungan serta mengantisipasi musim penghujan, Karang Taruna RT 012 RW 05 bersama seluruh warga menggelar kegiatan gotong royong akbar pada hari Minggu lalu.\n\nKegiatan ini difokuskan pada pembersihan gorong-gorong, pemangkasan ranting pohon yang rawan patah, serta penyemprotan desinfektan alami untuk mencegah sarang nyamuk DBD.\n\nKetua RT 012 mengapresiasi tingginya inisiatif para pemuda Karang Taruna yang menggerakkan warga dari pagi hari. Ke depannya, agenda ini akan dirutinkan sebulan sekali demi kenyamanan dan kesehatan bersama.",
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=1000&q=80',
                'author' => 'Humas Katar 012',
                'is_featured' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Pendaftaran Turnamen Futsal Antar-Gang Pemuda RT 012 Resmi Dibuka!',
                'slug' => 'pendaftaran-turnamen-futsal-antar-gang-resmi-dibuka',
                'category' => 'Pengumuman',
                'excerpt' => 'Siapkan tim terbaikmu! Turnamen futsal persahabatan pemuda RT 012 akan diselenggarakan akhir bulan ini.',
                'content' => "Divisi Olahraga Karang Taruna RT 012 RW 05 kembali menggelar 'Katar Cup Futsal League'. Kegiatan ini bertujuan mempererat tali persaudaraan antar pemuda serta memupuk sportivitas generasi muda.\n\nPendaftaran dibuka mulai tanggal 1 hingga 15 bulan ini melalui koordinator olahraga atau sekretariat Karang Taruna. Terdapat hadiah menarik, piala bergilir, serta medali untuk para juara.\n\nYuk segera daftarkan tim dari gang kamu sekarang juga!",
                'image' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1000&q=80',
                'author' => 'Sie Olahraga',
                'is_featured' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Program Posko Belajar Gratis untuk Anak-Anak Warga RT 012',
                'slug' => 'program-posko-belajar-gratis-anak-warga',
                'category' => 'Berita',
                'excerpt' => 'Kakak-kakak mahasiswa Karang Taruna mendampingi adik-adik belajar matematika, bahasa Inggris, dan membaca.',
                'content' => "Sebagai bentuk kepedulian di bidang pendidikan, pemuda RT 012 yang berstatus mahasiswa dan alumni memulai program 'Bimbel Sahabat Cilik' setiap Sabtu sore di Balai Warga.\n\nProgram ini bebas biaya bagi seluruh anak usia SD dan SMP di wilayah RT 012 RW 05. Materi yang diberikan meliputi bimbingan PR sekolah, bahasa Inggris dasar, dan literasi membaca yang menyenangkan.",
                'image' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=1000&q=80',
                'author' => 'Divisi Pendidikan',
                'is_featured' => false,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Hasil Rapat Pleno Pemuda: Pembentukan Panitia Peringatan Hari Sumpah Pemuda',
                'slug' => 'hasil-rapat-pleno-panitia-sumpah-pemuda',
                'category' => 'Pengumuman',
                'excerpt' => 'Struktur kepanitiaan dan susunan acara resmi ditetapkan setelah rapat pleno pengurus dan anggota.',
                'content' => "Pada tanggal 20 lalu telah dilaksanakan Rapat Pleno Karang Taruna bertempat di Balai RT 012. Rapat menghasilkan beberapa keputusan penting terkait agenda peringatan Hari Sumpah Pemuda dan bakti sosial masyarakat.\n\nBagi warga yang ingin berpartisipasi atau memberikan donasi dapat langsung menghubungi sekretariat atau melalui formulir aspirasi di website ini.",
                'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1000&q=80',
                'author' => 'Sekretaris Katar',
                'is_featured' => false,
                'published_at' => now()->subDays(14),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }

        // 4. Agenda Kegiatan
        $events = [
            [
                'title' => 'Kerja Bakti Akbar & Pengecatan Gapura RT 012',
                'slug' => 'kerja-bakti-akbar-pengecatan-gapura',
                'description' => 'Aksi bersih-bersih lingkungan bersama seluruh warga dan pemuda, dilanjutkan pengecatan gapura masuk RT 012.',
                'location' => 'Sepanjang Jalan Utama RT 012 RW 05',
                'event_date' => now()->addDays(3)->format('Y-m-d'),
                'start_time' => '07:00',
                'end_time' => '11:00 WIB',
                'status' => 'Akan Datang',
                'organizer' => 'Karang Taruna & Pengurus RT 012',
                'image' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Rapat Koordinasi Bulanan Pemuda & Evaluasi Program',
                'slug' => 'rapat-koordinasi-bulanan-pemuda',
                'description' => 'Rapat rutin bulanan seluruh pengurus dan anggota karang taruna untuk mengevaluasi program kerja serta membahas kas organisasi.',
                'location' => 'Balai Warga RT 012',
                'event_date' => now()->addDays(8)->format('Y-m-d'),
                'start_time' => '19:30',
                'end_time' => '22:00 WIB',
                'status' => 'Akan Datang',
                'organizer' => 'Badan Pengurus Harian',
                'image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'title' => 'Bakti Sosial & Santunan Warga Lanjut Usia',
                'slug' => 'bakti-sosial-santunan-lansia',
                'description' => 'Penyaluran paket sembako dan kebutuhan harian bagi para sesepuh dan warga lanjut usia yang membutuhkan di lingkungan RT 012.',
                'location' => 'Wilayah RT 012 RW 05',
                'event_date' => now()->subDays(12)->format('Y-m-d'),
                'start_time' => '08:30',
                'end_time' => '12:00 WIB',
                'status' => 'Selesai',
                'organizer' => 'Divisi Sosial & Kerohanian',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }

        // 5. Dokumentasi Galeri
        $galleries = [
            [
                'title' => 'Malam Puncak HUT RI Bertema Jumanji Pemuda RT 012',
                'category' => 'Peringatan HUT RI',
                'image_url' => '/images/jumanji-hero.jpg',
                'description' => 'Kompak dan penuh semangat! Seluruh pemuda-pemudi mengenakan kostum penjelajah Jumanji menyemarakkan panggung lingkungan RT 012.',
                'activity_date' => '2026-08-17',
            ],
            [
                'title' => 'Keseruan Lomba Panjat Pinang HUT RI',
                'category' => 'Peringatan 17 Agustus',
                'image_url' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=800&q=80',
                'description' => 'Suasana meriah warga dan anak-anak saat perayaan kemerdekaan RI di lapangan RT 012.',
                'activity_date' => '2026-08-17',
            ],
            [
                'title' => 'Kerja Bakti Lingkungan Asri RT 012',
                'category' => 'Sosial Lingkungan',
                'image_url' => 'https://images.unsplash.com/photo-1618477461853-cf6ed80faba5?auto=format&fit=crop&w=800&q=80',
                'description' => 'Pembersihan saluran air dan penanaman tanaman hias di sepanjang jalan utama.',
                'activity_date' => '2026-09-10',
            ],
            [
                'title' => 'Latihan Rutin Futsal Pemuda',
                'category' => 'Olahraga',
                'image_url' => 'https://images.unsplash.com/photo-1518091043644-c1d4457512c6?auto=format&fit=crop&w=800&q=80',
                'description' => 'Latihan bersama pemuda RT 012 tiap Jumat malam untuk menjaga kebugaran tubuh.',
                'activity_date' => '2026-10-05',
            ],
            [
                'title' => 'Santunan Anak Yatim dan Doa Bersama',
                'category' => 'Keagamaan & Sosial',
                'image_url' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=800&q=80',
                'description' => 'Momen kehangatan berbagi berkah bersama warga dan sesepuh RT 012 RW 05.',
                'activity_date' => '2026-09-25',
            ],
            [
                'title' => 'Posko Belajar Ceria Adik-Adik',
                'category' => 'Edukasi',
                'image_url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80',
                'description' => 'Adik-adik RT 012 antusias belajar membaca dan mewarnai bersama kakak mahasiswa.',
                'activity_date' => '2026-10-18',
            ],
            [
                'title' => 'Rapat Kerja Pengurus Karang Taruna',
                'category' => 'Organisasi',
                'image_url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80',
                'description' => 'Diskusi santai tapi fokus merancang program inovatif untuk kemajuan warga RT 012.',
                'activity_date' => '2026-10-12',
            ],
        ];

        foreach ($galleries as $item) {
            Gallery::create($item);
        }

        // 6. Data Anggota Pemuda RT 012
        $youths = [
            [
                'full_name' => 'Bagus Hendrawan',
                'nickname' => 'Bagus',
                'gender' => 'Laki-laki',
                'birth_date' => '2003-05-14',
                'phone' => '082199887766',
                'address' => 'RT 012 / RW 05 No. 15',
                'occupation' => 'Mahasiswa',
                'interest' => 'Olahraga & IT',
                'status' => 'Aktif',
            ],
            [
                'full_name' => 'Dewi Lestari',
                'nickname' => 'Dewi',
                'gender' => 'Perempuan',
                'birth_date' => '2004-11-20',
                'phone' => '082155443322',
                'address' => 'RT 012 / RW 05 No. 28',
                'occupation' => 'Mahasiswi',
                'interest' => 'Seni Musik & Desain',
                'status' => 'Aktif',
            ],
            [
                'full_name' => 'Arif Budiman',
                'nickname' => 'Arif',
                'gender' => 'Laki-laki',
                'birth_date' => '2001-08-09',
                'phone' => '081322110099',
                'address' => 'RT 012 / RW 05 No. 04',
                'occupation' => 'Karyawan Swasta',
                'interest' => 'Sosial & Kepemimpinan',
                'status' => 'Pengurus',
            ],
            [
                'full_name' => 'Rina Melati',
                'nickname' => 'Rina',
                'gender' => 'Perempuan',
                'birth_date' => '2005-02-17',
                'phone' => '087788990011',
                'address' => 'RT 012 / RW 05 No. 42',
                'occupation' => 'Pelajar',
                'interest' => 'Media & Fotografi',
                'status' => 'Aktif',
            ],
        ];

        foreach ($youths as $youth) {
            YouthMember::create($youth);
        }

        // 7. Contoh Aspirasi Warga
        $aspirations = [
            [
                'name' => 'Bapak Joko Santoso',
                'phone' => '08123445566',
                'rt_rw' => 'RT 012 / RW 05',
                'category' => 'Saran',
                'message' => 'Saran untuk adik-adik pemuda, mohon diadakan lampu penerangan tambahan di pertigaan gang samping pos kamling agar lebih terang saat malam hari.',
                'status' => 'Diproses',
                'admin_notes' => 'Sudah dikoordinasikan dengan seksi sarana dan prasarana RT.',
            ],
            [
                'name' => 'Ibu Sri Wahyuni',
                'phone' => '08139988771',
                'rt_rw' => 'RT 012 / RW 05',
                'category' => 'Ide Kegiatan',
                'message' => 'Alangkah baiknya bila diadakan senam sehat bersama ibu-ibu setiap hari Minggu pagi di lapangan dipandu pemudi Karang Taruna.',
                'status' => 'Selesai',
                'admin_notes' => 'Program senam sehat sudah disepakati mulai bulan depan.',
            ],
        ];

        foreach ($aspirations as $aspiration) {
            Aspiration::create($aspiration);
        }

        // 8. Transparansi Kas & Anggaran Kegiatan 17-an Jumanji
        $finances = [
            [
                'title' => 'Iuran Warga RT 012 (Kolektif 60 KK)',
                'type' => 'income',
                'category' => 'Iuran Warga',
                'amount' => 3000000,
                'transaction_date' => now()->subDays(15)->format('Y-m-d'),
                'notes' => 'Iuran sukarela Rp 50.000 x 60 Kepala Keluarga di wilayah RT 012.',
            ],
            [
                'title' => 'Alokasi Saldo Kas Awal Pemuda RT 012',
                'type' => 'income',
                'category' => 'Kas Rutin',
                'amount' => 1500000,
                'transaction_date' => now()->subDays(20)->format('Y-m-d'),
                'notes' => 'Pencairan saldo kas tabungan organisasi pemuda untuk pembukaan kegiatan.',
            ],
            [
                'title' => 'Donasi Sukarela Bapak RW 05',
                'type' => 'income',
                'category' => 'Donatur / Sponsor',
                'amount' => 1000000,
                'transaction_date' => now()->subDays(10)->format('Y-m-d'),
                'notes' => 'Sumbangan dukungan kepanitiaan HUT RI dari Ketua RW 05.',
            ],
            [
                'title' => 'Sponsorship Kaos Panitia Jumanji Toko Berkah',
                'type' => 'income',
                'category' => 'Donatur / Sponsor',
                'amount' => 800000,
                'transaction_date' => now()->subDays(7)->format('Y-m-d'),
                'notes' => 'Bantuan sponsor pembuatan seragam rompi penjelajah panitia.',
            ],
            [
                'title' => 'Bahan Dekorasi Gapura & Panggung Rimba Jumanji',
                'type' => 'expense',
                'category' => 'Dekorasi Jumanji',
                'amount' => 850000,
                'transaction_date' => now()->subDays(6)->format('Y-m-d'),
                'notes' => 'Pembelian cat kayu, lampu hias warm white, stereofoam, bambu dan dedaunan imitasi.',
            ],
            [
                'title' => 'Pembelian Paket Hadiah Lomba Anak-anak',
                'type' => 'expense',
                'category' => 'Hadiah Lomba',
                'amount' => 1250000,
                'transaction_date' => now()->subDays(5)->format('Y-m-d'),
                'notes' => 'Hadiah lomba makan kerupuk, balap karung helm, kelereng, dan mewarnai.',
            ],
            [
                'title' => 'Sewa Sound System & Lampu Panggung Malam Puncak',
                'type' => 'expense',
                'category' => 'Panggung & Perlengkapan',
                'amount' => 1200000,
                'transaction_date' => now()->subDays(3)->format('Y-m-d'),
                'notes' => 'Paket sewa sound panggung balai warga 1 hari penuh acara puncak.',
            ],
            [
                'title' => 'Konsumsi Kerja Bakti Persiapan & Panitia Lomba',
                'type' => 'expense',
                'category' => 'Konsumsi',
                'amount' => 650000,
                'transaction_date' => now()->subDays(2)->format('Y-m-d'),
                'notes' => 'Snack, air mineral galon/gelas, dan makan siang panitia gotong royong.',
            ],
        ];

        foreach ($finances as $finance) {
            \App\Models\FinanceTransaction::create($finance);
        }

        // 9. Inventaris Barang & Perlengkapan RT 012
        $inventoryItems = [
            [
                'name' => 'Tenda Kerucut 3x3 Meter',
                'category' => 'Tenda & Terpal',
                'quantity' => 4,
                'unit' => 'Unit',
                'condition' => 'Baik',
                'storage_location' => 'Gudang Balai RT 012',
                'acquired_date' => '2024-08-10',
                'notes' => 'Tenda putih untuk acara 17-an dan hajatan warga. Dibeli dari dana kas 2024.',
            ],
            [
                'name' => 'Terpal Biru 4x6 Meter',
                'category' => 'Tenda & Terpal',
                'quantity' => 6,
                'unit' => 'Lembar',
                'condition' => 'Cukup Baik',
                'storage_location' => 'Gudang Balai RT 012',
                'acquired_date' => '2023-07-15',
                'notes' => 'Terpal pelindung hujan untuk area terbuka. Beberapa sudah agak tipis.',
            ],
            [
                'name' => 'Sound System Portable + Mic Wireless',
                'category' => 'Sound System & Elektronik',
                'quantity' => 1,
                'unit' => 'Set',
                'condition' => 'Baik',
                'storage_location' => 'Rumah Ketua RT (Pak Rizky)',
                'acquired_date' => '2025-01-20',
                'notes' => 'Speaker 15 inch bluetooth + 2 mic wireless. Untuk pengajian, rapat, dan acara warga.',
            ],
            [
                'name' => 'Lampu Hias Tumblr LED Warm White',
                'category' => 'Dekorasi & Properti',
                'quantity' => 12,
                'unit' => 'Roll',
                'condition' => 'Baik',
                'storage_location' => 'Kardus Dekorasi - Gudang Balai',
                'acquired_date' => '2026-08-05',
                'notes' => 'Lampu dekorasi 10 meter/roll untuk acara Jumanji 17-an 2026.',
            ],
            [
                'name' => 'Bambu Hias Dekorasi (Potong 2m)',
                'category' => 'Dekorasi & Properti',
                'quantity' => 20,
                'unit' => 'Batang',
                'condition' => 'Cukup Baik',
                'storage_location' => 'Belakang Pos Kamling',
                'acquired_date' => '2026-08-10',
                'notes' => 'Bambu untuk dekorasi gapura dan panggung tema Jumanji.',
            ],
            [
                'name' => 'Meja Lipat Plastik Panjang',
                'category' => 'Meja & Kursi',
                'quantity' => 8,
                'unit' => 'Buah',
                'condition' => 'Baik',
                'storage_location' => 'Gudang Balai RT 012',
                'acquired_date' => '2024-05-01',
                'notes' => 'Meja lipat 180cm untuk bazaar, makan bersama, dan rapat warga.',
            ],
            [
                'name' => 'Kursi Plastik Napolly Merah',
                'category' => 'Meja & Kursi',
                'quantity' => 50,
                'unit' => 'Buah',
                'condition' => 'Baik',
                'storage_location' => 'Gudang Balai RT 012',
                'acquired_date' => '2023-08-01',
                'notes' => 'Kursi warga untuk acara pengajian, rapat, dan kegiatan RT.',
            ],
            [
                'name' => 'Panci Besar Stainless 40cm',
                'category' => 'Dapur & Konsumsi',
                'quantity' => 3,
                'unit' => 'Buah',
                'condition' => 'Baik',
                'storage_location' => 'Dapur Balai RT 012',
                'acquired_date' => '2022-12-10',
                'notes' => 'Panci masak untuk konsumsi acara besar warga.',
            ],
            [
                'name' => 'Kompor Gas Portable + Tabung 3kg',
                'category' => 'Dapur & Konsumsi',
                'quantity' => 2,
                'unit' => 'Set',
                'condition' => 'Baik',
                'storage_location' => 'Dapur Balai RT 012',
                'acquired_date' => '2024-06-15',
                'notes' => 'Kompor cadangan untuk masak gotong royong.',
            ],
            [
                'name' => 'Tali Tambang Plastik 10mm',
                'category' => 'Perlengkapan Lomba',
                'quantity' => 5,
                'unit' => 'Roll',
                'condition' => 'Cukup Baik',
                'storage_location' => 'Gudang Balai RT 012',
                'acquired_date' => '2025-08-10',
                'notes' => 'Tali untuk lomba tarik tambang dan dekorasi bendera.',
            ],
            [
                'name' => 'Karung Goni (Bekas Bersih)',
                'category' => 'Perlengkapan Lomba',
                'quantity' => 15,
                'unit' => 'Lembar',
                'condition' => 'Baik',
                'storage_location' => 'Gudang Balai RT 012',
                'acquired_date' => '2026-08-01',
                'notes' => 'Untuk lomba balap karung 17-an. Sudah dicuci bersih.',
            ],
            [
                'name' => 'Sapu Lidi & Sapu Ijuk',
                'category' => 'Alat Kebersihan',
                'quantity' => 10,
                'unit' => 'Buah',
                'condition' => 'Cukup Baik',
                'storage_location' => 'Pos Kamling RT 012',
                'acquired_date' => '2025-03-01',
                'notes' => 'Sapu untuk kerja bakti rutin lingkungan.',
            ],
            [
                'name' => 'Bola Futsal Mikasa',
                'category' => 'Olahraga',
                'quantity' => 3,
                'unit' => 'Buah',
                'condition' => 'Rusak Ringan',
                'storage_location' => 'Pos Kamling RT 012',
                'acquired_date' => '2025-06-01',
                'notes' => '1 bola sudah agak kempes, perlu ganti pentil. 2 masih bagus.',
            ],
            [
                'name' => 'Lampu Sorot LED 50 Watt',
                'category' => 'Penerangan',
                'quantity' => 4,
                'unit' => 'Buah',
                'condition' => 'Baik',
                'storage_location' => 'Gudang Balai RT 012',
                'acquired_date' => '2026-07-20',
                'notes' => 'Lampu sorot untuk penerangan lapangan saat acara malam.',
            ],
            [
                'name' => 'Bendera Merah Putih Besar (2x3m)',
                'category' => 'Dekorasi & Properti',
                'quantity' => 2,
                'unit' => 'Lembar',
                'condition' => 'Baik',
                'storage_location' => 'Lemari Balai RT 012',
                'acquired_date' => '2025-08-01',
                'notes' => 'Bendera besar untuk pemasangan di gapura saat 17 Agustus.',
            ],
        ];

        foreach ($inventoryItems as $item) {
            InventoryItem::create($item);
        }

        // 10. Hall of Fame / Galeri Kehormatan & Prestasi Warga RT 012
        $hallOfFames = [
            [
                'name' => 'Keluarga Besar Pemuda RT 012',
                'title' => 'Juara 1 Kostum Rimba Jumanji Terbaik & Panggung Terheboh',
                'category' => '17-an & Lomba Rimba',
                'year' => 2026,
                'award_badge' => 'Juara 1 🏆',
                'photo' => '/images/jumanji-hero.jpg',
                'description' => 'Tampil memukau dengan kekompakan kostum penjelajah hutan rimba Jumanji serta panggung petualangan kemerdekaan paling meriah.',
                'order' => 1,
            ],
            [
                'name' => 'Tim Futsal Satria Muda RT 012',
                'title' => 'Juara 1 Futsal Cup Kemerdekaan Antar-RT',
                'category' => 'Olahraga & E-Sport',
                'year' => 2026,
                'award_badge' => 'Medali Emas 🥇',
                'photo' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=800&q=80',
                'description' => 'Tak terkalahkan sepanjang turnamen dengan pertahanan kokoh dan semangat persaudaraan yang tinggi di lapangan.',
                'order' => 2,
            ],
            [
                'name' => 'Siti Nur Aisyah & Kakak Relawan',
                'title' => 'Inisiator Posko Belajar Gratis Anak-Anak Warga',
                'category' => 'Akademik & Pendidikan',
                'year' => 2025,
                'award_badge' => 'Tokoh Teladan 🎖️',
                'photo' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80',
                'description' => 'Menginisiasi bimbel gratis bagi puluhan anak sekolah dasar di lingkungan RT 012 setiap akhir pekan tanpa pamrih.',
                'order' => 3,
            ],
            [
                'name' => 'Pak Bambang Sutrisno',
                'title' => 'Pengabdi Lingkungan & Pelopor Gotong Royong 20 Tahun',
                'category' => 'Tokoh Inspiratif Warga',
                'year' => 2024,
                'award_badge' => 'Penghargaan Khusus 🌟',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80',
                'description' => 'Sosok sesepuh yang selalu berdiri di baris terdepan merawat kebersihan saluran air, keamanan pos ronda, dan kebersamaan warga.',
                'order' => 4,
            ],
            [
                'name' => 'Adinda Zahra (Usia 10 Tahun)',
                'title' => 'Juara 1 Lomba Menggambar & Baca Puisi Kemerdekaan',
                'category' => 'Seni & Kreativitas',
                'year' => 2026,
                'award_badge' => 'Juara 1 🏆',
                'photo' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=800&q=80',
                'description' => 'Karya lukis pemandangan desa dan pembacaan puisi kemerdekaan menyentuh hati seluruh juri dan penonton malam puncak.',
                'order' => 5,
            ],
            [
                'name' => 'Reza Aditya & Tim Dekorasi',
                'title' => 'Gapura Kemerdekaan Jumanji Terkreatif Kelurahan',
                'category' => 'Aksi Sosial & Lingkungan',
                'year' => 2026,
                'award_badge' => 'Juara Favorit ⭐',
                'photo' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=800&q=80',
                'description' => 'Memanfaatkan bambu dan bahan daur ulang ramah lingkungan untuk menciptakan gapura spektakuler bernuansa gerbang hutan Jumanji.',
                'order' => 6,
            ],
        ];

        foreach ($hallOfFames as $hof) {
            HallOfFame::create($hof);
        }

        // 11. Contoh Riwayat Log Aktivitas Pengurus
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
            \App\Models\ActivityLog::create(array_merge($log, [
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            ]));
        }
    }
}
