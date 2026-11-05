# Panduan Website Resmi Unit Penghubung Warga RT 12 RW 05 (Tema Jumanji)

Website ini dibangun menggunakan **Laravel 11 / 13** dengan antarmuka bertema **Petualangan Jumanji (Jungle & Safari)** yang modern, responsif (mobile-friendly), serta dilengkapi modul **Transparansi Kas & Donasi 17-an**.

---

## 🚀 Cara Menjalankan Website di Komputer Anda

1. Buka terminal (CMD / PowerShell / Laragon Terminal) di folder proyek ini (`katar012project`).
2. Jalankan perintah server Laravel:
   ```bash
   php artisan serve
   ```
3. Buka browser dan akses alamat:
   ```
   http://127.0.0.1:8000
   ```

---

## 🔐 Akses Akun Pengurus & Wewenang Tiap Divisi

Sistem dilengkapi dengan **Pembatasan Hak Akses Otomatis** sesuai wewenang dan jobdesk masing-masing divisi:

| Peran / Divisi | Email Login | Password Default | Wewenang & Hak Akses di Dashboard |
| :--- | :--- | :--- | :--- |
| **⚡ Admin (Super)** | `admin@katar012.id` | `password123` | **Bisa SEMUANYA** (Semua menu konten + Kas Keuangan + Registrasi Akun + Log Aktivitas) |
| **👑 Ketua** | `ketua@katar012.id` | `password123` | **Bisa edit semua konten** (Berita, Agenda, Galeri, Aspirasi, Pemuda, Struktur, Inventaris, Hall of Fame), **TIDAK BISA** edit Kas Keuangan, Kelola Akun, & Log Aktivitas |
| **⭐ Wakil Ketua** | `wakil@katar012.id` | `password123` | **Sama seperti Ketua** (Bisa edit semua konten, **TIDAK BISA** edit Kas Keuangan, Kelola Akun, & Log Aktivitas) |
| **📝 Sekertaris** | `sekertaris@katar012.id` | `password123` | **Cuma bisa edit:** Berita/Informasi, Aspirasi Warga, & Database Pemuda |
| **💰 Bendahara** | `bendahara@katar012.id` | `password123` | **Cuma bisa edit:** Kas & Anggaran Keuangan 17-an (Pemasukan, Pengeluaran, Nota Bukti) |
| **🎯 Divisi Acara** | `acara@katar012.id` | `password123` | **Cuma bisa edit:** Informasi/Berita & Agenda Kegiatan |
| **📦 Divisi Perlap** | `perlap@katar012.id` | `password123` | **Cuma bisa edit:** Barang-Barang Inventaris Perlengkapan RT |
| **📸 Divisi Dokum** | `dokum@katar012.id` | `password123` | **Cuma bisa edit:** Galeri Dokumentasi Foto & Hall of Fame |

> 💡 **Pengelolaan Akun Pengurus:** Hanya **Admin** yang memiliki wewenang untuk membuka menu **Panel Pengurus -> Akun Pengurus** (`/admin/users`) guna mendaftarkan akun baru atau mereset kata sandi pengurus.

---

## 🌟 Fitur-Fitur Utama yang Tersedia

### 1. Halaman Publik (Untuk Warga & Pemuda):
* **Beranda (`/`):**
  * Desain bertema rimba Jumanji dengan logo resmi melingkar RT 12 RW 05.
  * Kartu utama dengan foto asli kebersamaan pemuda Karang Taruna berbusana penjelajah Jumanji.
  * Kartu statistik terisi lengkap (Pemuda terdata, agenda, berita, aspirasi).
* **Profil & Struktur (`/profil`):**
  * Visi dan 5 Misi utama organisasi pemuda RT 12 RW 05.
  * Susunan pengurus lengkap beserta kontak dan foto.
* **Transparansi Kas & Anggaran 17-an (`/keuangan-17an`):**
  * **3 Kartu Ringkasan:** Total Pemasukan (+), Total Pengeluaran (-), dan Sisa Saldo Kas Terkini.
  * Rekening donasi resmi bendahara & tombol konfirmasi iuran via WhatsApp.
  * Tabel rincian arus kas (iuran warga, sponsor, konsumsi, panggung, hadiah lomba).
  * Fitur lihat bukti kuitansi / nota belanja.
* **Agenda Kegiatan (`/agenda`):**
  * Jadwal kerja bakti, turnamen HUT RI, dan rapat pemuda.
* **Berita & Pengumuman (`/berita`):**
  * Dokumentasi acara 17-an tema Jumanji dan kabar warga.
* **Galeri Dokumentasi (`/galeri`):**
  * Foto kegiatan dengan fitur *lightbox modal zoom*.
* **Hall of Fame (`/hall-of-fame`):**
  * Panggung penghargaan emas bagi para juara lomba 17-an, pemuda berprestasi, dan tokoh inspiratif warga.
  * Dilengkapi filter tahun angkatan, kategori kejuaraan, lencana medali/piala, serta formulir ajuan nominasi warga.
* **Kotak Aspirasi & Layanan Warga (`/aspirasi-warga`):**
  * Formulir kirim aspirasi, ide, atau keluhan lingkungan.
* **Sensus & Pendaftaran Pemuda (`/gabung-pemuda`):**
  * Formulir pendataan pemuda/i RT 012.

### 2. Panel Admin Pengurus (`/admin`):
* **Log Aktivitas Pengurus Khusus Admin (`/admin/activity-logs`):** Rekam jejak audit trail lengkap untuk melihat aktivitas setiap divisi secara real-time (siapa yang menambah, mengedit, mengubah status, atau menghapus data kas, inventaris, berita, aspirasi, dsb., lengkap dengan waktu dan IP Address).
* **Registrasi & Kelola Akun Pengurus (`/admin/users`):** Daftarkan akun baru untuk pengurus per divisi, atur status keaktifan, reset kata sandi, dan filter daftar akun berdasarkan peran.
* **Kas & Anggaran 17-an Khusus Dashboard (`/admin/finances`):** Catat dan pantau seluruh uang masuk (iuran/sponsor) dan uang keluar (belanja hadiah/sewa alat), lengkap dengan upload foto nota bukti.
* **Inventaris Barang Khusus Dashboard (`/admin/inventory`):** Catat dan pantau stok perlengkapan RT 012, kondisi fisik, lokasi simpan, serta foto barang.
* **Upload Foto dari HP:** Semua form (Galeri, Berita, Agenda, Pengurus, Kas, Inventaris, dan Hall of Fame) mendukung upload foto langsung dari kamera/galeri HP!
* **Kelola Hall of Fame (`/admin/hall-of-fame`):** Abadikan data juara lomba 17-an, penghargaan pemuda, gelar teladan, serta foto momen penerimaan piala.
* **Kelola Berita & Pengumuman** (Tambah, Edit, Hapus).
* **Kelola Agenda Kegiatan** (Jadwalkan acara baru, update status).
* **Kelola Galeri Foto** (Unggah foto dari HP/komputer).
* **Tindak Lanjut Aspirasi Warga** (Ubah status dan hubungi WhatsApp warga langsung).
* **Database Pemuda** (Melihat daftar anggota terdaftar).
