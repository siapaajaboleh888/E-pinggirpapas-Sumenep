<?php

/**
 * ✅ FIX PUBLISHED_AT UNTUK SEMUA PRODUK
 * Script untuk set published_at ke semua produk yang belum memiliki nilai
 * 
 * Cara menjalankan:
 * php fix-published.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Kuliner;
use Carbon\Carbon;

echo "╔══════════════════════════════════════════════════════╗\n";
echo "║   FIX PUBLISHED_AT - PRODUK GARAM KUGAR             ║\n";
echo "╚══════════════════════════════════════════════════════╝\n\n";

try {
    // Hitung total produk
    $totalProduk = Kuliner::count();
    $unpublished = Kuliner::whereNull('published_at')->count();
    $published = Kuliner::whereNotNull('published_at')->count();

    echo "📊 STATUS DATABASE:\n";
    echo "   Total Produk        : {$totalProduk}\n";
    echo "   Sudah Published     : {$published}\n";
    echo "   Belum Published     : {$unpublished}\n\n";

    if ($unpublished == 0) {
        echo "✅ Semua produk sudah memiliki published_at!\n";
        echo "   Tidak ada yang perlu diperbaiki.\n\n";
        exit(0);
    }

    echo "🔧 MEMULAI PERBAIKAN...\n\n";

    // Update semua produk yang belum published
    $updated = Kuliner::whereNull('published_at')
        ->update([
            'published_at' => Carbon::now()
        ]);

    echo "✅ BERHASIL!\n";
    echo "   {$updated} produk berhasil di-publish\n\n";

    // Tampilkan sample data
    echo "📦 SAMPLE DATA SETELAH UPDATE:\n";
    $samples = Kuliner::latest()->take(5)->get(['id', 'title', 'published_at']);

    foreach ($samples as $sample) {
        $date = $sample->published_at ? $sample->published_at->format('d M Y H:i') : 'NULL';
        echo "   ID {$sample->id}: {$sample->title}\n";
        echo "           Published: {$date}\n\n";
    }

    echo "╔══════════════════════════════════════════════════════╗\n";
    echo "║              PERBAIKAN SELESAI! ✅                  ║\n";
    echo "║   Silakan refresh halaman /produk di browser        ║\n";
    echo "╚══════════════════════════════════════════════════════╝\n";
} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . "\n";
    echo "   Line: " . $e->getLine() . "\n";
    exit(1);
}
