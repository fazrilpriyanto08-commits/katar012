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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner_name');
            $table->string('category')->default('Kuliner');
            $table->text('description')->nullable();
            $table->string('price_range')->nullable();
            $table->string('address')->default('RT 012 RW 05 Lenteng Agung');
            $table->string('whatsapp');
            $table->string('image')->nullable();
            $table->string('opening_hours')->nullable();
            $table->boolean('is_verified')->default(true);
            $table->string('status')->default('active'); // active, pending, inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
