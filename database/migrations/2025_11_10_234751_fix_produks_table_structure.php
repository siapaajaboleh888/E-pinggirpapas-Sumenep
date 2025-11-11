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
        // Drop table jika ada dan buat ulang dengan struktur lengkap
        Schema::dropIfExists('produks');

        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('slug')->unique();
            $table->string('kategori')->nullable();
            $table->decimal('harga', 15, 2);
            $table->string('satuan')->default('kg');
            $table->string('gambar')->nullable();
            $table->enum('status', ['tersedia', 'kosong'])->default('tersedia');
            $table->integer('stok')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
