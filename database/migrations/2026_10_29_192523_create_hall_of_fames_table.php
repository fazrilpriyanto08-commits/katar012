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
        Schema::create('hall_of_fames', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Nama tokoh / peraih / tim
            $table->string('title');                         // Judul prestasi / gelar kehormatan
            $table->string('category');                      // Kategori prestasi
            $table->integer('year');                         // Tahun perolehan (misal: 2026)
            $table->string('award_badge')->default('Juara 1'); // Label badge: Juara 1, Medali Emas, Tokoh Teladan, dll
            $table->string('photo')->nullable();              // Foto dokumentasi / piala
            $table->text('description')->nullable();          // Deskripsi / cerita kebanggaan
            $table->integer('order')->default(0);             // Urutan prioritas tampil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_of_fames');
    }
};
