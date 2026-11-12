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
        if (!Schema::hasTable('uploaded_media')) {
            Schema::create('uploaded_media', function (Blueprint $table) {
                $table->id();
                $table->string('uuid', 64)->unique();
                $table->string('mime_type', 100);
                $table->unsignedInteger('size')->default(0);
                $table->longText('data');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploaded_media');
    }
};
