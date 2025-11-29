<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Test database connection
    $stats = [
        'total_pemesanan' => \App\Models\Pemesanan::count(),
        'pemesanan_pending' => \App\Models\Pemesanan::where('status', 'pending')->count(),
        'pemesanan_proses' => \App\Models\Pemesanan::where('status', 'processing')->count(),
        'pemesanan_selesai' => \App\Models\Pemesanan::where('status', 'delivered')->count(),
    ];
    
    echo "STATISTICS:\n";
    print_r($stats);
    
    $recentOrders = \App\Models\Pemesanan::latest()->take(5)->get();
    echo "\nRECENT ORDERS COUNT: " . $recentOrders->count() . "\n";
    
    if ($recentOrders->count() > 0) {
        echo "FIRST ORDER:\n";
        $firstOrder = $recentOrders->first();
        echo "Nomor: " . $firstOrder->nomor_pesanan . "\n";
        echo "Status: " . $firstOrder->status . "\n";
        echo "Total: " . $firstOrder->total_harga . "\n";
    }
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "TRACE: " . $e->getTraceAsString() . "\n";
}
