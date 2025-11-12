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
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('status'); // bank_transfer, e_wallet, cod
            $table->string('payment_channel')->nullable()->after('payment_method'); // bca, bni, mandiri, dana, gopay, ovo, cod
            $table->string('payment_status')->default('unpaid')->after('payment_channel'); // unpaid, pending, paid
            $table->text('payment_proof')->nullable()->after('payment_status'); // path to payment proof image
            $table->timestamp('paid_at')->nullable()->after('payment_proof');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_channel', 'payment_status', 'payment_proof', 'paid_at']);
        });
    }
};
