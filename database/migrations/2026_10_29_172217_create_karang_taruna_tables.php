<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel Berita & Pengumuman
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Berita'); // Berita, Pengumuman, Kegiatan, Artikel
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->string('author')->default('Pengurus RT 012');
            $table->boolean('is_featured')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // Tabel Agenda / Event Kegiatan
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('location');
            $table->date('event_date');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('status')->default('Akan Datang'); // Akan Datang, Sedang Berlangsung, Selesai
            $table->string('organizer')->default('Karang Taruna RT 012');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Tabel Dokumentasi Galeri
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('Kegiatan');
            $table->string('image_url');
            $table->text('description')->nullable();
            $table->date('activity_date')->nullable();
            $table->timestamps();
        });

        // Tabel Aspirasi & Saran Warga
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('rt_rw')->default('RT 012 / RW 05');
            $table->string('category')->default('Saran'); // Saran, Keluhan, Ide Kegiatan, Bantuan/Donasi, Lainnya
            $table->text('message');
            $table->string('status')->default('Menunggu Ditinjau'); // Menunggu Ditinjau, Diproses, Selesai
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        // Tabel Database Pemuda RT 012
        Schema::create('youth_members', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->string('gender'); // Laki-laki, Perempuan
            $table->date('birth_date')->nullable();
            $table->string('phone');
            $table->string('address')->default('RT 012 / RW 05');
            $table->string('occupation')->nullable(); // Pelajar, Mahasiswa, Karyawan, Wirausaha, dll.
            $table->string('interest')->nullable(); // Olahraga, Seni & Budaya, Media & IT, Keagamaan, Sosial
            $table->string('status')->default('Aktif'); // Aktif, Pengurus, Alumni
            $table->timestamps();
        });

        // Tabel Struktur Kepengurusan
        Schema::create('organization_structures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position'); // Ketua, Wakil Ketua, Sekretaris, Bendahara, Koordinator Sie
            $table->string('division')->default('Pengurus Harian');
            $table->string('photo')->nullable();
            $table->integer('order')->default(0);
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_structures');
        Schema::dropIfExists('youth_members');
        Schema::dropIfExists('aspirations');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('events');
        Schema::dropIfExists('articles');
    }
};
