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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Nama barang
            $table->string('category');                      // Kategori: Tenda/Terpal, Sound System, Dekorasi, dll
            $table->integer('quantity')->default(1);          // Jumlah
            $table->string('unit')->default('Buah');          // Satuan: Buah, Set, Lembar, Unit, Paket, Roll, Meter
            $table->string('condition')->default('Baik');     // Kondisi: Baik, Cukup Baik, Rusak Ringan, Rusak Berat
            $table->string('storage_location')->nullable();   // Lokasi penyimpanan
            $table->string('photo')->nullable();              // Foto barang
            $table->date('acquired_date')->nullable();        // Tanggal perolehan
            $table->text('notes')->nullable();                // Catatan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
