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
        Schema::create('kuliners', function (Blueprint $table) {
            $table->id();
            $table->string('image', 2048);
            $table->string('title', 2048);
            $table->string('alamat', 2048);
            $table->decimal('price', 10, 2);
            $table->text('text');
            $table->datetime('published_at');
            $table->string('nomor_hp', 15);
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuliner');
    }
};
