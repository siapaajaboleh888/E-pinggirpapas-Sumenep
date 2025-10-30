<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Fungsi ini MEMBUAT tabel
     */
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            // ID auto increment
            $table->id();

            // Nomor pesanan (unik, tidak boleh sama)
            $table->string('nomor_pesanan')->unique();

            // Foreign key ke tabel produks
            // Jika produk dihapus, pesanan ikut terhapus
            $table->foreignId('produk_id')
                ->constrained('produks')
                ->onDelete('cascade');

            // Data pemesan
            $table->string('nama_pemesan');
            $table->string('email');
            $table->string('telepon', 20);
            $table->text('alamat_pengiriman');

            // Detail pesanan
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 12, 2);  // Maksimal 12 digit, 2 desimal
            $table->decimal('total_harga', 12, 2);

            // Optional fields
            $table->text('catatan')->nullable();  // Boleh kosong
            $table->date('tanggal_pengiriman')->nullable();

            // Status pesanan
            $table->enum('status', [
                'pending',      // Baru masuk
                'confirmed',    // Sudah dikonfirmasi
                'processing',   // Sedang diproses
                'shipped',      // Sudah dikirim
                'delivered',    // Sudah sampai
                'cancelled'     // Dibatalkan
            ])->default('pending');

            // Timestamps (created_at & updated_at) otomatis
            $table->timestamps();

            // INDEX untuk mempercepat pencarian
            $table->index('nomor_pesanan');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Fungsi ini MENGHAPUS tabel (jika rollback)
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
