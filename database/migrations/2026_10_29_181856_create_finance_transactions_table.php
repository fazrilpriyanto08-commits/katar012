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
        Schema::create('finance_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['income', 'expense']); // income = pemasukan, expense = pengeluaran
            $table->string('category'); // Iuran Warga, Donatur/Sponsor, Hadiah Lomba, Panggung & Sound, Konsumsi, Dekorasi Jumanji, Kas Rutin
            $table->bigInteger('amount'); // Nominal dalam Rupiah
            $table->date('transaction_date');
            $table->string('proof_image')->nullable(); // Foto nota / kuitansi
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_transactions');
    }
};
