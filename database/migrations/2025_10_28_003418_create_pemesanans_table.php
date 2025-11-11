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

            // ✅ UBAH INI: Hapus foreign key constraint sementara
            // Simpan produk_id sebagai integer biasa saja
            $table->unsignedBigInteger('produk_id');

            // ✅ Nama produk untuk backup
            $table->string('nama_produk');

            // Data pemesan
            $table->string('nama_pemesan');
            $table->string('email');
            $table->string('telepon', 20);
            $table->text('alamat_pengiriman');

            // Detail pesanan
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('total_harga', 12, 2);

            // Optional fields
            $table->text('catatan')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->date('tanggal_pengiriman')->nullable();

            // Status pesanan
            $table->enum('status', [
                'pending',
                'confirmed',
                'processing',
                'shipped',
                'delivered',
                'cancelled'
            ])->default('pending');

            // Timestamps
            $table->timestamps();

            // INDEX untuk mempercepat pencarian
            $table->index('nomor_pesanan');
            $table->index('produk_id');  // ✅ Index saja, tanpa foreign key
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
