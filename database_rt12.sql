-- Dump Database Lengkap RT 12 RW 05 untuk MySQL InfinityFree
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `activity_logs`;
DROP TABLE IF EXISTS `businesses`;
DROP TABLE IF EXISTS `hall_of_fames`;
DROP TABLE IF EXISTS `inventory_items`;
DROP TABLE IF EXISTS `finance_transactions`;
DROP TABLE IF EXISTS `organization_structures`;
DROP TABLE IF EXISTS `youth_members`;
DROP TABLE IF EXISTS `aspirations`;
DROP TABLE IF EXISTS `galleries`;
DROP TABLE IF EXISTS `events`;
DROP TABLE IF EXISTS `articles`;
DROP TABLE IF EXISTS `users`;

-- 1. users
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'admin',
  `division` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. articles
CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL DEFAULT 'Berita',
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `author` varchar(100) DEFAULT 'Pengurus RT 012',
  `is_featured` tinyint(1) DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. events
CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `start_time` varchar(20) DEFAULT NULL,
  `end_time` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Akan Datang',
  `organizer` varchar(100) DEFAULT 'Karang Taruna RT 012',
  `image` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. galleries
CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT 'Kegiatan',
  `image_url` varchar(500) NOT NULL,
  `description` text DEFAULT NULL,
  `activity_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. aspirations
CREATE TABLE `aspirations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `rt_rw` varchar(50) DEFAULT 'RT 012 / RW 05',
  `category` varchar(100) DEFAULT 'Saran',
  `message` text NOT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Ditinjau',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. youth_members
CREATE TABLE `youth_members` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `interest` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. organization_structures
CREATE TABLE `organization_structures` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(150) NOT NULL,
  `division` varchar(150) DEFAULT 'Pengurus Harian',
  `photo` varchar(500) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. finance_transactions
CREATE TABLE `finance_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` enum('income','expense') NOT NULL,
  `category` varchar(100) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `proof_image` varchar(500) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. inventory_items
CREATE TABLE `inventory_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `unit` varchar(50) DEFAULT 'Buah',
  `condition` varchar(50) DEFAULT 'Baik',
  `storage_location` varchar(255) DEFAULT NULL,
  `photo` varchar(500) DEFAULT NULL,
  `acquired_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. hall_of_fames
CREATE TABLE `hall_of_fames` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `award_badge` varchar(100) DEFAULT 'Juara 1',
  `photo` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. businesses
CREATE TABLE `businesses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT 'Kuliner',
  `description` text DEFAULT NULL,
  `price_range` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT 'RT 012 RW 05 Lenteng Agung',
  `whatsapp` varchar(50) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `opening_hours` varchar(100) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 1,
  `status` varchar(50) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 12. activity_logs
CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_role` varchar(50) DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `module` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_created_at_index` (`user_id`,`created_at`),
  KEY `activity_logs_module_action_index` (`module`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ================= DATA RECORD ================

-- Data tabel users
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `is_active`) VALUES ('1', 'Administrator Sistem RT 012', 'admin@katar012.id', NULL, '$2y$12$IE9oZ9vSByTesTC5LIHBEOi66IEFQQG7v5DA0oC0RKOHZEEq98ami', NULL, '2026-10-30 06:30:45', '2026-11-02 15:02:39', 'admin', '081234567800', '1');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `is_active`) VALUES ('10', 'Muhammad Rizky Pratama (Ketua)', 'ketua@katar012.id', NULL, '$2y$12$XBr4CCjk68a2osyplr.TQ.1e9S00fQE/SgiPCWmJjh/8BPLNiDXga', NULL, '2026-10-30 07:57:46', '2026-11-02 15:02:39', 'ketua', '081234567890', '1');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `is_active`) VALUES ('11', 'Dimas Surya Wicaksono (Wakil)', 'wakil@katar012.id', NULL, '$2y$12$6cFXTBKW/v95zwMNQCgtwexSKKsbIRVTiqunE7V.Tbf6wZinCbmYu', NULL, '2026-10-30 07:57:46', '2026-11-02 15:02:39', 'wakil', '081234567891', '1');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `is_active`) VALUES ('12', 'Siti Nur Aisyah (Sekertaris)', 'sekertaris@katar012.id', NULL, '$2y$12$ExSnxemZmemZ5PHvf2nWSepsl7v5jRdaxM1UediuaT9tYKH/WaZ1m', NULL, '2026-10-30 07:57:47', '2026-11-02 15:02:39', 'sekertaris', '081234567892', '1');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `is_active`) VALUES ('13', 'Anisa Rahmawati (Bendahara)', 'bendahara@katar012.id', NULL, '$2y$12$idRQOMMTjO3TH3pYVPVqUOsFGEuvmH1mPulQEizdu/cwGETmPetQC', NULL, '2026-10-30 07:57:47', '2026-11-02 15:02:40', 'bendahara', '081234567893', '1');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `is_active`) VALUES ('14', 'Fajar Nugraha (Divisi Acara)', 'acara@katar012.id', NULL, '$2y$12$4yELPAMxjJFrHHtRIZGcye/NxLWv2L5yuDBek/mRTgD5IfVUwnc3m', NULL, '2026-10-30 07:57:47', '2026-11-02 15:02:40', 'acara', '081234567894', '1');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `is_active`) VALUES ('15', 'Reza Aditya (Divisi Perlap)', 'perlap@katar012.id', NULL, '$2y$12$OU3QnpyvVwWth4qh0WIpjet3XCrzk8GXNQjd7cGRKk0Yve3MUgITS', NULL, '2026-10-30 07:57:47', '2026-11-02 15:02:40', 'perlap', '081234567897', '1');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `phone`, `is_active`) VALUES ('16', 'Bella Oktavia (Divisi Dokum)', 'dokum@katar012.id', NULL, '$2y$12$Uf/J2lcwP/g.bSwBoT4TYO.icDcr7tCqbFnpm7QbQ4C3ar9jzaVWK', NULL, '2026-10-30 07:57:48', '2026-11-02 16:26:27', 'dokum', '081234567895', '1');

-- Data tabel articles
INSERT INTO `articles` (`id`, `title`, `slug`, `category`, `excerpt`, `content`, `image`, `author`, `is_featured`, `published_at`, `created_at`, `updated_at`) VALUES ('1', 'Meriah dan Kompak! Semarak Peringatan Lingkungan RT 012 Bertema Petualangan Jumanji', 'semarak-peringatan-lingkungan-rt-012-bertema-jumanji', 'Kegiatan', 'Kreativitas pemuda-pemudi RT 12 RW 05 memukau warga dengan tema kostum penjelajah rimba Jumanji yang kompak dan penuh semangat.', 'Kemeriahan terasa begitu kental di wilayah RT 012 RW 05. Dalam rangka memupuk persatuan serta menyemarakkan acara lingkungan, panitia pemuda mengusung tema unik dan atraktif: \'Jumanji: Menjelajah, Bersatu, dan Berdampak Nyata\'.

Seluruh pemuda dan pemudi kompak mengenakan busana ala safari explorer dengan dekorasi panggung bernuansa hutan tropis. Suasana malam semakin meriah dengan berbagai penampilan pentas seni, pembagian hadiah lomba, serta apresiasi bagi tokoh masyarakat.

Ketua RT 012 menyampaikan rasa bangga dan terima kasih atas inisiatif luar biasa para generasi muda yang terus menghidupkan kebersamaan warga secara guyub dan menyenangkan.', '/images/jumanji-hero.jpg', 'Humas RT 012', '1', '2026-11-01 15:02:40', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `articles` (`id`, `title`, `slug`, `category`, `excerpt`, `content`, `image`, `author`, `is_featured`, `published_at`, `created_at`, `updated_at`) VALUES ('2', 'Gotong Royong Bersih Saluran Air Jelang Musim Hujan di Lingkungan RT 012', 'gotong-royong-bersih-saluran-air-lingkungan-rt-012', 'Kegiatan', 'Puluhan pemuda dan warga RT 012 RW 05 bersama-sama membersihkan selokan dan fasilitas umum guna mencegah genangan air.', 'Dalam rangka menjaga kebersihan lingkungan serta mengantisipasi musim penghujan, Karang Taruna RT 012 RW 05 bersama seluruh warga menggelar kegiatan gotong royong akbar pada hari Minggu lalu.

Kegiatan ini difokuskan pada pembersihan gorong-gorong, pemangkasan ranting pohon yang rawan patah, serta penyemprotan desinfektan alami untuk mencegah sarang nyamuk DBD.

Ketua RT 012 mengapresiasi tingginya inisiatif para pemuda Karang Taruna yang menggerakkan warga dari pagi hari. Ke depannya, agenda ini akan dirutinkan sebulan sekali demi kenyamanan dan kesehatan bersama.', 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=1000&q=80', 'Humas Katar 012', '1', '2026-10-31 15:02:40', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `articles` (`id`, `title`, `slug`, `category`, `excerpt`, `content`, `image`, `author`, `is_featured`, `published_at`, `created_at`, `updated_at`) VALUES ('3', 'Pendaftaran Turnamen Futsal Antar-Gang Pemuda RT 012 Resmi Dibuka!', 'pendaftaran-turnamen-futsal-antar-gang-resmi-dibuka', 'Pengumuman', 'Siapkan tim terbaikmu! Turnamen futsal persahabatan pemuda RT 012 akan diselenggarakan akhir bulan ini.', 'Divisi Olahraga Karang Taruna RT 012 RW 05 kembali menggelar \'Katar Cup Futsal League\'. Kegiatan ini bertujuan mempererat tali persaudaraan antar pemuda serta memupuk sportivitas generasi muda.

Pendaftaran dibuka mulai tanggal 1 hingga 15 bulan ini melalui koordinator olahraga atau sekretariat Karang Taruna. Terdapat hadiah menarik, piala bergilir, serta medali untuk para juara.

Yuk segera daftarkan tim dari gang kamu sekarang juga!', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1000&q=80', 'Sie Olahraga', '1', '2026-10-28 15:02:40', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `articles` (`id`, `title`, `slug`, `category`, `excerpt`, `content`, `image`, `author`, `is_featured`, `published_at`, `created_at`, `updated_at`) VALUES ('4', 'Program Posko Belajar Gratis untuk Anak-Anak Warga RT 012', 'program-posko-belajar-gratis-anak-warga', 'Berita', 'Kakak-kakak mahasiswa Karang Taruna mendampingi adik-adik belajar matematika, bahasa Inggris, dan membaca.', 'Sebagai bentuk kepedulian di bidang pendidikan, pemuda RT 012 yang berstatus mahasiswa dan alumni memulai program \'Bimbel Sahabat Cilik\' setiap Sabtu sore di Balai Warga.

Program ini bebas biaya bagi seluruh anak usia SD dan SMP di wilayah RT 012 RW 05. Materi yang diberikan meliputi bimbingan PR sekolah, bahasa Inggris dasar, dan literasi membaca yang menyenangkan.', 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=1000&q=80', 'Divisi Pendidikan', '0', '2026-10-23 15:02:40', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `articles` (`id`, `title`, `slug`, `category`, `excerpt`, `content`, `image`, `author`, `is_featured`, `published_at`, `created_at`, `updated_at`) VALUES ('5', 'Hasil Rapat Pleno Pemuda: Pembentukan Panitia Peringatan Hari Sumpah Pemuda', 'hasil-rapat-pleno-panitia-sumpah-pemuda', 'Pengumuman', 'Struktur kepanitiaan dan susunan acara resmi ditetapkan setelah rapat pleno pengurus dan anggota.', 'Pada tanggal 20 lalu telah dilaksanakan Rapat Pleno Karang Taruna bertempat di Balai RT 012. Rapat menghasilkan beberapa keputusan penting terkait agenda peringatan Hari Sumpah Pemuda dan bakti sosial masyarakat.

Bagi warga yang ingin berpartisipasi atau memberikan donasi dapat langsung menghubungi sekretariat atau melalui formulir aspirasi di website ini.', 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1000&q=80', 'Sekretaris Katar', '0', '2026-10-19 15:02:40', '2026-11-02 15:02:40', '2026-11-02 15:02:40');

-- Data tabel events
INSERT INTO `events` (`id`, `title`, `slug`, `description`, `location`, `event_date`, `start_time`, `end_time`, `status`, `organizer`, `image`, `created_at`, `updated_at`) VALUES ('1', 'Kerja Bakti Akbar & Pengecatan Gapura RT 012', 'kerja-bakti-akbar-pengecatan-gapura', 'Aksi bersih-bersih lingkungan bersama seluruh warga dan pemuda, dilanjutkan pengecatan gapura masuk RT 012.', 'Sepanjang Jalan Utama RT 012 RW 05', '2026-11-05 00:00:00', '07:00', '11:00 WIB', 'Akan Datang', 'Karang Taruna & Pengurus RT 012', 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?auto=format&fit=crop&w=800&q=80', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `events` (`id`, `title`, `slug`, `description`, `location`, `event_date`, `start_time`, `end_time`, `status`, `organizer`, `image`, `created_at`, `updated_at`) VALUES ('2', 'Rapat Koordinasi Bulanan Pemuda & Evaluasi Program', 'rapat-koordinasi-bulanan-pemuda', 'Rapat rutin bulanan seluruh pengurus dan anggota karang taruna untuk mengevaluasi program kerja serta membahas kas organisasi.', 'Balai Warga RT 012', '2026-11-10 00:00:00', '19:30', '22:00 WIB', 'Akan Datang', 'Badan Pengurus Harian', 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&w=800&q=80', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `events` (`id`, `title`, `slug`, `description`, `location`, `event_date`, `start_time`, `end_time`, `status`, `organizer`, `image`, `created_at`, `updated_at`) VALUES ('3', 'Bakti Sosial & Santunan Warga Lanjut Usia', 'bakti-sosial-santunan-lansia', 'Penyaluran paket sembako dan kebutuhan harian bagi para sesepuh dan warga lanjut usia yang membutuhkan di lingkungan RT 012.', 'Wilayah RT 012 RW 05', '2026-10-21 00:00:00', '08:30', '12:00 WIB', 'Selesai', 'Divisi Sosial & Kerohanian', 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80', '2026-11-02 15:02:40', '2026-11-02 15:02:40');

-- Data tabel galleries
INSERT INTO `galleries` (`id`, `title`, `category`, `image_url`, `description`, `activity_date`, `created_at`, `updated_at`) VALUES ('1', 'Malam Puncak HUT RI Bertema Jumanji Pemuda RT 012', 'Peringatan HUT RI', '/images/jumanji-hero.jpg', 'Kompak dan penuh semangat! Seluruh pemuda-pemudi mengenakan kostum penjelajah Jumanji menyemarakkan panggung lingkungan RT 012.', '2026-08-17 00:00:00', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `galleries` (`id`, `title`, `category`, `image_url`, `description`, `activity_date`, `created_at`, `updated_at`) VALUES ('2', 'Keseruan Lomba Panjat Pinang HUT RI', 'Peringatan 17 Agustus', 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?auto=format&fit=crop&w=800&q=80', 'Suasana meriah warga dan anak-anak saat perayaan kemerdekaan RI di lapangan RT 012.', '2026-08-17 00:00:00', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `galleries` (`id`, `title`, `category`, `image_url`, `description`, `activity_date`, `created_at`, `updated_at`) VALUES ('3', 'Kerja Bakti Lingkungan Asri RT 012', 'Sosial Lingkungan', 'https://images.unsplash.com/photo-1618477461853-cf6ed80faba5?auto=format&fit=crop&w=800&q=80', 'Pembersihan saluran air dan penanaman tanaman hias di sepanjang jalan utama.', '2026-09-10 00:00:00', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `galleries` (`id`, `title`, `category`, `image_url`, `description`, `activity_date`, `created_at`, `updated_at`) VALUES ('4', 'Latihan Rutin Futsal Pemuda', 'Olahraga', 'https://images.unsplash.com/photo-1518091043644-c1d4457512c6?auto=format&fit=crop&w=800&q=80', 'Latihan bersama pemuda RT 012 tiap Jumat malam untuk menjaga kebugaran tubuh.', '2026-10-05 00:00:00', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `galleries` (`id`, `title`, `category`, `image_url`, `description`, `activity_date`, `created_at`, `updated_at`) VALUES ('5', 'Santunan Anak Yatim dan Doa Bersama', 'Keagamaan & Sosial', 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?auto=format&fit=crop&w=800&q=80', 'Momen kehangatan berbagi berkah bersama warga dan sesepuh RT 012 RW 05.', '2026-09-25 00:00:00', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `galleries` (`id`, `title`, `category`, `image_url`, `description`, `activity_date`, `created_at`, `updated_at`) VALUES ('6', 'Posko Belajar Ceria Adik-Adik', 'Edukasi', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80', 'Adik-adik RT 012 antusias belajar membaca dan mewarnai bersama kakak mahasiswa.', '2026-10-18 00:00:00', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `galleries` (`id`, `title`, `category`, `image_url`, `description`, `activity_date`, `created_at`, `updated_at`) VALUES ('7', 'Rapat Kerja Pengurus Karang Taruna', 'Organisasi', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80', 'Diskusi santai tapi fokus merancang program inovatif untuk kemajuan warga RT 012.', '2026-10-12 00:00:00', '2026-11-02 15:02:40', '2026-11-02 15:02:40');

-- Data tabel aspirations
INSERT INTO `aspirations` (`id`, `name`, `phone`, `rt_rw`, `category`, `message`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES ('1', 'Bapak Joko Santoso', '08123445566', 'RT 012 / RW 05', 'Saran', 'Saran untuk adik-adik pemuda, mohon diadakan lampu penerangan tambahan di pertigaan gang samping pos kamling agar lebih terang saat malam hari.', 'Diproses', 'Sudah dikoordinasikan dengan seksi sarana dan prasarana RT.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `aspirations` (`id`, `name`, `phone`, `rt_rw`, `category`, `message`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES ('2', 'Ibu Sri Wahyuni', '08139988771', 'RT 012 / RW 05', 'Ide Kegiatan', 'Alangkah baiknya bila diadakan senam sehat bersama ibu-ibu setiap hari Minggu pagi di lapangan dipandu pemudi Karang Taruna.', 'Selesai', 'Program senam sehat sudah disepakati mulai bulan depan.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');

-- Data tabel youth_members
INSERT INTO `youth_members` (`id`, `full_name`, `nickname`, `gender`, `birth_date`, `phone`, `address`, `occupation`, `interest`, `status`, `created_at`, `updated_at`) VALUES ('1', 'Bagus Hendrawan', 'Bagus', 'Laki-laki', '2003-05-14 00:00:00', '082199887766', 'RT 012 / RW 05 No. 15', 'Mahasiswa', 'Olahraga & IT', 'Aktif', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `youth_members` (`id`, `full_name`, `nickname`, `gender`, `birth_date`, `phone`, `address`, `occupation`, `interest`, `status`, `created_at`, `updated_at`) VALUES ('2', 'Dewi Lestari', 'Dewi', 'Perempuan', '2004-11-20 00:00:00', '082155443322', 'RT 012 / RW 05 No. 28', 'Mahasiswi', 'Seni Musik & Desain', 'Aktif', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `youth_members` (`id`, `full_name`, `nickname`, `gender`, `birth_date`, `phone`, `address`, `occupation`, `interest`, `status`, `created_at`, `updated_at`) VALUES ('3', 'Arif Budiman', 'Arif', 'Laki-laki', '2001-08-09 00:00:00', '081322110099', 'RT 012 / RW 05 No. 04', 'Karyawan Swasta', 'Sosial & Kepemimpinan', 'Pengurus', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `youth_members` (`id`, `full_name`, `nickname`, `gender`, `birth_date`, `phone`, `address`, `occupation`, `interest`, `status`, `created_at`, `updated_at`) VALUES ('4', 'Rina Melati', 'Rina', 'Perempuan', '2005-02-17 00:00:00', '087788990011', 'RT 012 / RW 05 No. 42', 'Pelajar', 'Media & Fotografi', 'Aktif', '2026-11-02 15:02:40', '2026-11-02 15:02:40');

-- Data tabel organization_structures
INSERT INTO `organization_structures` (`id`, `name`, `position`, `division`, `photo`, `order`, `phone`, `created_at`, `updated_at`) VALUES ('1', 'Muhammad Rizky Pratama', 'Ketua Karang Taruna', 'Badan Pengurus Harian', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=500&q=80', '1', '081234567890', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `organization_structures` (`id`, `name`, `position`, `division`, `photo`, `order`, `phone`, `created_at`, `updated_at`) VALUES ('2', 'Dimas Surya Wicaksono', 'Wakil Ketua', 'Badan Pengurus Harian', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=500&q=80', '2', '081234567891', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `organization_structures` (`id`, `name`, `position`, `division`, `photo`, `order`, `phone`, `created_at`, `updated_at`) VALUES ('3', 'Siti Nur Aisyah', 'Sekretaris 1', 'Badan Pengurus Harian', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=500&q=80', '3', '081234567892', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `organization_structures` (`id`, `name`, `position`, `division`, `photo`, `order`, `phone`, `created_at`, `updated_at`) VALUES ('4', 'Anisa Rahmawati', 'Bendahara 1', 'Badan Pengurus Harian', 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=500&q=80', '4', '081234567893', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `organization_structures` (`id`, `name`, `position`, `division`, `photo`, `order`, `phone`, `created_at`, `updated_at`) VALUES ('5', 'Fajar Nugraha', 'Koordinator Olahraga & Rekreasi', 'Divisi Olahraga', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=500&q=80', '5', '081234567894', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `organization_structures` (`id`, `name`, `position`, `division`, `photo`, `order`, `phone`, `created_at`, `updated_at`) VALUES ('6', 'Bella Oktavia', 'Koordinator Humas & Publikasi', 'Divisi Humas', 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=500&q=80', '6', '081234567895', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `organization_structures` (`id`, `name`, `position`, `division`, `photo`, `order`, `phone`, `created_at`, `updated_at`) VALUES ('7', 'Ahmad Fauzi', 'Koordinator Kerohanian & Sosial', 'Divisi Kerohanian', 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=500&q=80', '7', '081234567896', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `organization_structures` (`id`, `name`, `position`, `division`, `photo`, `order`, `phone`, `created_at`, `updated_at`) VALUES ('8', 'Reza Aditya', 'Koordinator Kreatif & Perlengkapan', 'Divisi Kreatif', 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=500&q=80', '8', '081234567897', '2026-11-02 15:02:40', '2026-11-02 15:02:40');

-- Data tabel finance_transactions
INSERT INTO `finance_transactions` (`id`, `title`, `type`, `category`, `amount`, `transaction_date`, `proof_image`, `notes`, `created_at`, `updated_at`) VALUES ('1', 'Iuran Warga RT 012 (Kolektif 60 KK)', 'income', 'Iuran Warga', '3000000', '2026-10-18 00:00:00', NULL, 'Iuran sukarela Rp 50.000 x 60 Kepala Keluarga di wilayah RT 012.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `finance_transactions` (`id`, `title`, `type`, `category`, `amount`, `transaction_date`, `proof_image`, `notes`, `created_at`, `updated_at`) VALUES ('2', 'Alokasi Saldo Kas Awal Pemuda RT 012', 'income', 'Kas Rutin', '1500000', '2026-10-13 00:00:00', NULL, 'Pencairan saldo kas tabungan organisasi pemuda untuk pembukaan kegiatan.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `finance_transactions` (`id`, `title`, `type`, `category`, `amount`, `transaction_date`, `proof_image`, `notes`, `created_at`, `updated_at`) VALUES ('3', 'Donasi Sukarela Bapak RW 05', 'income', 'Donatur / Sponsor', '1000000', '2026-10-23 00:00:00', NULL, 'Sumbangan dukungan kepanitiaan HUT RI dari Ketua RW 05.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `finance_transactions` (`id`, `title`, `type`, `category`, `amount`, `transaction_date`, `proof_image`, `notes`, `created_at`, `updated_at`) VALUES ('4', 'Sponsorship Kaos Panitia Jumanji Toko Berkah', 'income', 'Donatur / Sponsor', '800000', '2026-10-26 00:00:00', NULL, 'Bantuan sponsor pembuatan seragam rompi penjelajah panitia.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `finance_transactions` (`id`, `title`, `type`, `category`, `amount`, `transaction_date`, `proof_image`, `notes`, `created_at`, `updated_at`) VALUES ('5', 'Bahan Dekorasi Gapura & Panggung Rimba Jumanji', 'expense', 'Dekorasi Jumanji', '850000', '2026-10-27 00:00:00', NULL, 'Pembelian cat kayu, lampu hias warm white, stereofoam, bambu dan dedaunan imitasi.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `finance_transactions` (`id`, `title`, `type`, `category`, `amount`, `transaction_date`, `proof_image`, `notes`, `created_at`, `updated_at`) VALUES ('6', 'Pembelian Paket Hadiah Lomba Anak-anak', 'expense', 'Hadiah Lomba', '1250000', '2026-10-28 00:00:00', NULL, 'Hadiah lomba makan kerupuk, balap karung helm, kelereng, dan mewarnai.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `finance_transactions` (`id`, `title`, `type`, `category`, `amount`, `transaction_date`, `proof_image`, `notes`, `created_at`, `updated_at`) VALUES ('7', 'Sewa Sound System & Lampu Panggung Malam Puncak', 'expense', 'Panggung & Perlengkapan', '1200000', '2026-10-30 00:00:00', NULL, 'Paket sewa sound panggung balai warga 1 hari penuh acara puncak.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `finance_transactions` (`id`, `title`, `type`, `category`, `amount`, `transaction_date`, `proof_image`, `notes`, `created_at`, `updated_at`) VALUES ('8', 'Konsumsi Kerja Bakti Persiapan & Panitia Lomba', 'expense', 'Konsumsi', '650000', '2026-10-31 00:00:00', NULL, 'Snack, air mineral galon/gelas, dan makan siang panitia gotong royong.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');

-- Data tabel inventory_items
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('1', 'Tenda Kerucut 3x3 Meter', 'Tenda & Terpal', '4', 'Unit', 'Baik', 'Gudang Balai RT 012', NULL, '2024-08-10 00:00:00', 'Tenda putih untuk acara 17-an dan hajatan warga. Dibeli dari dana kas 2024.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('2', 'Terpal Biru 4x6 Meter', 'Tenda & Terpal', '6', 'Lembar', 'Cukup Baik', 'Gudang Balai RT 012', NULL, '2023-07-15 00:00:00', 'Terpal pelindung hujan untuk area terbuka. Beberapa sudah agak tipis.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('3', 'Sound System Portable + Mic Wireless', 'Sound System & Elektronik', '1', 'Set', 'Baik', 'Rumah Ketua RT (Pak Rizky)', NULL, '2025-01-20 00:00:00', 'Speaker 15 inch bluetooth + 2 mic wireless. Untuk pengajian, rapat, dan acara warga.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('4', 'Lampu Hias Tumblr LED Warm White', 'Dekorasi & Properti', '12', 'Roll', 'Baik', 'Kardus Dekorasi - Gudang Balai', NULL, '2026-08-05 00:00:00', 'Lampu dekorasi 10 meter/roll untuk acara Jumanji 17-an 2026.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('5', 'Bambu Hias Dekorasi (Potong 2m)', 'Dekorasi & Properti', '20', 'Batang', 'Cukup Baik', 'Belakang Pos Kamling', NULL, '2026-08-10 00:00:00', 'Bambu untuk dekorasi gapura dan panggung tema Jumanji.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('6', 'Meja Lipat Plastik Panjang', 'Meja & Kursi', '8', 'Buah', 'Baik', 'Gudang Balai RT 012', NULL, '2024-05-01 00:00:00', 'Meja lipat 180cm untuk bazaar, makan bersama, dan rapat warga.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('7', 'Kursi Plastik Napolly Merah', 'Meja & Kursi', '50', 'Buah', 'Baik', 'Gudang Balai RT 012', NULL, '2023-08-01 00:00:00', 'Kursi warga untuk acara pengajian, rapat, dan kegiatan RT.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('8', 'Panci Besar Stainless 40cm', 'Dapur & Konsumsi', '3', 'Buah', 'Baik', 'Dapur Balai RT 012', NULL, '2022-12-10 00:00:00', 'Panci masak untuk konsumsi acara besar warga.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('9', 'Kompor Gas Portable + Tabung 3kg', 'Dapur & Konsumsi', '2', 'Set', 'Baik', 'Dapur Balai RT 012', NULL, '2024-06-15 00:00:00', 'Kompor cadangan untuk masak gotong royong.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('10', 'Tali Tambang Plastik 10mm', 'Perlengkapan Lomba', '5', 'Roll', 'Cukup Baik', 'Gudang Balai RT 012', NULL, '2025-08-10 00:00:00', 'Tali untuk lomba tarik tambang dan dekorasi bendera.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('11', 'Karung Goni (Bekas Bersih)', 'Perlengkapan Lomba', '15', 'Lembar', 'Baik', 'Gudang Balai RT 012', NULL, '2026-08-01 00:00:00', 'Untuk lomba balap karung 17-an. Sudah dicuci bersih.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('12', 'Sapu Lidi & Sapu Ijuk', 'Alat Kebersihan', '10', 'Buah', 'Cukup Baik', 'Pos Kamling RT 012', NULL, '2025-03-01 00:00:00', 'Sapu untuk kerja bakti rutin lingkungan.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('13', 'Bola Futsal Mikasa', 'Olahraga', '3', 'Buah', 'Rusak Ringan', 'Pos Kamling RT 012', NULL, '2025-06-01 00:00:00', '1 bola sudah agak kempes, perlu ganti pentil. 2 masih bagus.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('14', 'Lampu Sorot LED 50 Watt', 'Penerangan', '4', 'Buah', 'Baik', 'Gudang Balai RT 012', NULL, '2026-07-20 00:00:00', 'Lampu sorot untuk penerangan lapangan saat acara malam.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `inventory_items` (`id`, `name`, `category`, `quantity`, `unit`, `condition`, `storage_location`, `photo`, `acquired_date`, `notes`, `created_at`, `updated_at`) VALUES ('15', 'Bendera Merah Putih Besar (2x3m)', 'Dekorasi & Properti', '2', 'Lembar', 'Baik', 'Lemari Balai RT 012', NULL, '2025-08-01 00:00:00', 'Bendera besar untuk pemasangan di gapura saat 17 Agustus.', '2026-11-02 15:02:40', '2026-11-02 15:02:40');

-- Data tabel hall_of_fames
INSERT INTO `hall_of_fames` (`id`, `name`, `title`, `category`, `year`, `award_badge`, `photo`, `description`, `order`, `created_at`, `updated_at`) VALUES ('1', 'Keluarga Besar Pemuda RT 012', 'Juara 1 Kostum Rimba Jumanji Terbaik & Panggung Terheboh', '17-an & Lomba Rimba', '2026', 'Juara 1 🏆', '/images/jumanji-hero.jpg', 'Tampil memukau dengan kekompakan kostum penjelajah hutan rimba Jumanji serta panggung petualangan kemerdekaan paling meriah.', '1', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `hall_of_fames` (`id`, `name`, `title`, `category`, `year`, `award_badge`, `photo`, `description`, `order`, `created_at`, `updated_at`) VALUES ('2', 'Tim Futsal Satria Muda RT 012', 'Juara 1 Futsal Cup Kemerdekaan Antar-RT', 'Olahraga & E-Sport', '2026', 'Medali Emas 🥇', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=800&q=80', 'Tak terkalahkan sepanjang turnamen dengan pertahanan kokoh dan semangat persaudaraan yang tinggi di lapangan.', '2', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `hall_of_fames` (`id`, `name`, `title`, `category`, `year`, `award_badge`, `photo`, `description`, `order`, `created_at`, `updated_at`) VALUES ('3', 'Siti Nur Aisyah & Kakak Relawan', 'Inisiator Posko Belajar Gratis Anak-Anak Warga', 'Akademik & Pendidikan', '2025', 'Tokoh Teladan 🎖️', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80', 'Menginisiasi bimbel gratis bagi puluhan anak sekolah dasar di lingkungan RT 012 setiap akhir pekan tanpa pamrih.', '3', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `hall_of_fames` (`id`, `name`, `title`, `category`, `year`, `award_badge`, `photo`, `description`, `order`, `created_at`, `updated_at`) VALUES ('4', 'Pak Bambang Sutrisno', 'Pengabdi Lingkungan & Pelopor Gotong Royong 20 Tahun', 'Tokoh Inspiratif Warga', '2024', 'Penghargaan Khusus 🌟', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80', 'Sosok sesepuh yang selalu berdiri di baris terdepan merawat kebersihan saluran air, keamanan pos ronda, dan kebersamaan warga.', '4', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `hall_of_fames` (`id`, `name`, `title`, `category`, `year`, `award_badge`, `photo`, `description`, `order`, `created_at`, `updated_at`) VALUES ('5', 'Adinda Zahra (Usia 10 Tahun)', 'Juara 1 Lomba Menggambar & Baca Puisi Kemerdekaan', 'Seni & Kreativitas', '2026', 'Juara 1 🏆', 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=800&q=80', 'Karya lukis pemandangan desa dan pembacaan puisi kemerdekaan menyentuh hati seluruh juri dan penonton malam puncak.', '5', '2026-11-02 15:02:40', '2026-11-02 15:02:40');
INSERT INTO `hall_of_fames` (`id`, `name`, `title`, `category`, `year`, `award_badge`, `photo`, `description`, `order`, `created_at`, `updated_at`) VALUES ('6', 'Reza Aditya & Tim Dekorasi', 'Gapura Kemerdekaan Jumanji Terkreatif Kelurahan', 'Aksi Sosial & Lingkungan', '2026', 'Juara Favorit ⭐', 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=800&q=80', 'Memanfaatkan bambu dan bahan daur ulang ramah lingkungan untuk menciptakan gapura spektakuler bernuansa gerbang hutan Jumanji.', '6', '2026-11-02 15:02:40', '2026-11-02 15:02:40');

-- Data tabel businesses
INSERT INTO `businesses` (`id`, `name`, `owner_name`, `category`, `description`, `price_range`, `address`, `whatsapp`, `image`, `opening_hours`, `is_verified`, `status`, `created_at`, `updated_at`) VALUES ('1', 'Warung Nasi Uduk & Lontong Sayur Bu Siti', 'Ibu Siti Rohmah', 'Kuliner', 'Menyediakan nasi uduk Betawi pulen, lontong sayur labu siam, semur jengkol, tahu tempe bacem, telur balado dan aneka gorengan hangat setiap pagi.', 'Rp 10.000 - Rp 25.000', 'Gg. H. Saatun RT 012/05 No. 12', '081412357231', 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80', '06:00 - 11:00 WIB (Pagi)', '1', 'active', '2026-11-04 18:35:24', '2026-11-04 18:35:24');
INSERT INTO `businesses` (`id`, `name`, `owner_name`, `category`, `description`, `price_range`, `address`, `whatsapp`, `image`, `opening_hours`, `is_verified`, `status`, `created_at`, `updated_at`) VALUES ('2', 'Toko Sembako Berkah RT 12', 'Bapak H. Mahfudz', 'Sembako', 'Sedia beras pandan wangi, minyak goreng, telur ayam segar, gula, tepung, mie instan, gas elpiji 3kg & galon air mineral. Siap antar ke rumah warga RT 12.', 'Harga Grosir & Eceran Warga', 'Gg. H. Saatun RT 012 No. 04 (Dekat Pos Ronda)', '081412357231', 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?auto=format&fit=crop&w=600&q=80', '07:00 - 21:00 WIB', '1', 'active', '2026-11-04 18:35:24', '2026-11-04 18:35:24');
INSERT INTO `businesses` (`id`, `name`, `owner_name`, `category`, `description`, `price_range`, `address`, `whatsapp`, `image`, `opening_hours`, `is_verified`, `status`, `created_at`, `updated_at`) VALUES ('3', 'Laundry Express Kiloan Teh Rina', 'Teh Rina Marlina', 'Jasa & Servis', 'Cuci kering setrika wangi dengan deterjen antibakteri. Gratis antar-jemput cucian khusus sesama warga RT 12 RW 05.', 'Mulai Rp 7.000 / Kg', 'Gg. H. Saatun No. 5B RT 012 RW 05', '081412357231', 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?auto=format&fit=crop&w=600&q=80', '08:00 - 20:00 WIB', '1', 'active', '2026-11-04 18:35:24', '2026-11-04 18:35:24');
INSERT INTO `businesses` (`id`, `name`, `owner_name`, `category`, `description`, `price_range`, `address`, `whatsapp`, `image`, `opening_hours`, `is_verified`, `status`, `created_at`, `updated_at`) VALUES ('4', 'Aneka Gorengan Gurih & Es Mas Dimas', 'Dimas Surya', 'Kuliner', 'Bakwan sayur renyah, tahu isi pedas, tempe mendoan krispi, pisang aroma cokelat, es teh manis jumbo dan es jeruk peras segar sore hari.', 'Rp 1.500 - Rp 10.000', 'Depan Lapangan Bulutangkis RT 12', '081412357231', 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?auto=format&fit=crop&w=600&q=80', '15:30 - 22:00 WIB (Sore - Malam)', '1', 'active', '2026-11-04 18:35:24', '2026-11-04 18:35:24');
INSERT INTO `businesses` (`id`, `name`, `owner_name`, `category`, `description`, `price_range`, `address`, `whatsapp`, `image`, `opening_hours`, `is_verified`, `status`, `created_at`, `updated_at`) VALUES ('5', 'Servis AC & Perbaikan Elektronik Bang Jampang', 'Bang Supriadi (Jampang)', 'Jasa & Servis', 'Cuci AC berkala, isi freon, servis kulkas, mesin cuci, kipas angin dan instalasi listrik rumah tangga. Bergaransi dan harga khusus tetangga.', 'Cuci AC Rp 65.000 (Konsultasi Gratis)', 'Jl. Raya Lenteng Agung RT 12 RW 05', '081412357231', 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=600&q=80', '08:00 - 17:00 WIB', '1', 'active', '2026-11-04 18:35:24', '2026-11-04 18:35:24');
INSERT INTO `businesses` (`id`, `name`, `owner_name`, `category`, `description`, `price_range`, `address`, `whatsapp`, `image`, `opening_hours`, `is_verified`, `status`, `created_at`, `updated_at`) VALUES ('6', 'Rumah Jahit & Vermak Busana Bu Maryam', 'Ibu Hj. Maryam', 'Fashion & Busana', 'Menerima jahit baju gamis, kemeja batik, seragam sekolah, permak celana levis, ganti resleting dan pasang kancing cepat dan rapi.', 'Permak Mulai Rp 15.000', 'Gg. H. Saatun No. 20 RT 012 RW 05', '081412357231', 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=600&q=80', '09:00 - 18:00 WIB', '1', 'active', '2026-11-04 18:35:24', '2026-11-04 18:35:24');

-- Data tabel activity_logs
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('1', '1', 'Administrator Sistem RT 012', 'admin', 'HAPUS', 'Log Aktivitas', 'Membersihkan seluruh riwayat log aktivitas pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-10-30 07:49:10', '2026-10-30 07:49:10');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('2', '1', 'Administrator Sistem RT 012', 'admin', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-02 14:58:55', '2026-11-02 14:58:55');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('3', NULL, 'Anisa Rahmawati (Bendahara)', 'bendahara', 'TAMBAH', 'Kas Keuangan', 'Mencatat transaksi Pemasukan: \'Iuran Warga RT 012 (Kolektif 60 KK)\' sebesar Rp 3.000.000', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '2026-11-02 10:02:40', '2026-11-02 15:02:40');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('4', NULL, 'Reza Aditya (Divisi Perlap)', 'perlap', 'TAMBAH', 'Inventaris Barang', 'Menambahkan aset barang: 4 Unit \'Tenda Kerucut 3x3 Meter\' (Kondisi: Baik, Lokasi: Gudang Balai RT 012)', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '2026-11-02 11:02:40', '2026-11-02 15:02:40');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('5', NULL, 'Fajar Nugraha (Divisi Acara)', 'acara', 'TAMBAH', 'Agenda Kegiatan', 'Menjadwalkan kegiatan baru: \'Kerja Bakti Akbar & Pengecatan Gapura RT 012\' (Status: Akan Datang)', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '2026-11-02 12:02:40', '2026-11-02 15:02:40');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('6', NULL, 'Siti Nur Aisyah (Sekertaris)', 'sekertaris', 'STATUS', 'Aspirasi Warga', 'Mengubah status aspirasi \'Bapak Joko Santoso\' dari \'Menunggu Ditinjau\' ke \'Diproses\'', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '2026-11-02 13:02:40', '2026-11-02 15:02:40');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('7', NULL, 'Bella Oktavia (Divisi Dokum)', 'dokum', 'TAMBAH', 'Galeri Foto', 'Mengunggah foto dokumentasi: \'Malam Puncak HUT RI Bertema Jumanji Pemuda RT 012\' (Kategori: Peringatan HUT RI)', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '2026-11-02 14:02:40', '2026-11-02 15:02:40');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('8', NULL, 'Muhammad Rizky Pratama (Ketua)', 'ketua', 'UPDATE', 'Berita & Informasi', 'Memperbarui artikel berita: \'Meriah dan Kompak! Semarak Peringatan Lingkungan RT 012 Bertema Petualangan Jumanji\'', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '2026-11-02 14:32:40', '2026-11-02 15:02:40');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('9', NULL, 'Administrator Sistem RT 012', 'admin', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '2026-11-02 14:52:40', '2026-11-02 15:02:40');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('10', '1', 'Administrator Sistem RT 012', 'admin', 'UPDATE', 'Akun Pengurus', 'Memperbarui profil akun pengurus: \'Bella Oktavia (Divisi Dokum)\' (dokum@katar012.id)', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-02 16:26:27', '2026-11-02 16:26:27');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('11', '16', 'Bella Oktavia (Divisi Dokum)', 'dokum', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-02 16:27:05', '2026-11-02 16:27:05');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('12', '1', 'Administrator Sistem RT 012', 'admin', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-02 16:45:47', '2026-11-02 16:45:47');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('13', '16', 'Bella Oktavia (Divisi Dokum)', 'dokum', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-02 16:50:11', '2026-11-02 16:50:11');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('14', '1', 'Administrator Sistem RT 012', 'admin', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-02 16:50:56', '2026-11-02 16:50:56');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('15', '16', 'Bella Oktavia (Divisi Dokum)', 'dokum', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-02 16:51:55', '2026-11-02 16:51:55');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('16', '1', 'Administrator Sistem RT 012', 'admin', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-04 17:37:21', '2026-11-04 17:37:21');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('17', '1', 'Administrator Sistem RT 012', 'admin', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-04 17:37:23', '2026-11-04 17:37:23');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('18', '1', 'Administrator Sistem RT 012', 'admin', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-04 17:37:57', '2026-11-04 17:37:57');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('19', '1', 'Administrator Sistem RT 012', 'admin', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '10.200.61.251', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Mobile Safari/537.36', '2026-11-04 18:53:52', '2026-11-04 18:53:52');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('20', '14', 'Fajar Nugraha (Divisi Acara)', 'acara', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '10.200.61.251', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Mobile Safari/537.36', '2026-11-04 18:55:07', '2026-11-04 18:55:07');
INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `user_role`, `action`, `module`, `description`, `details`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES ('21', '1', 'Administrator Sistem RT 012', 'admin', 'LOGIN', 'Autentikasi', 'Berhasil login ke Dashboard Pengurus.', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', '2026-11-05 15:05:16', '2026-11-05 15:05:16');

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
