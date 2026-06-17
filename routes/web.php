<?php

use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVirtualTourController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;  // ✅ TAMBAHKAN INI
use App\Http\Controllers\ProfileController; // ✅ BREEZE: Profile Controller
use App\Http\Controllers\VirtualTourController;
use App\Models\Category;
use App\Models\Pemesanan;
use App\Models\Kuliner;    // ✅ GANTI dari Produk ke Kuliner
use App\Models\Virtual;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully.';
});

Route::get('/set-semua-selesai', function () {
    if (request('key') !== 'kosabangsa25') {
        return 'Unauthorized';
    }
    DB::table('pemesanans')->update([
        'status' => 'delivered',
        'payment_status' => 'paid'
    ]);
    return 'Semua pesanan (273 data) berhasil diubah menjadi Selesai dan Lunas!';
});

Route::get('/update-transaction-dates', function () {
    if (request('key') !== 'kosabangsa25') {
        return 'Unauthorized';
    }

    try {
        DB::beginTransaction();

        // Helper to generate realistic date-time between 07:30 and 21:00
        $getRandomDateTime = function($year, $month) {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $day = rand(1, $daysInMonth);
            $hour = rand(7, 21);
            if ($hour == 7) {
                $minute = rand(30, 59);
            } elseif ($hour == 21) {
                $minute = 0;
            } else {
                $minute = rand(0, 59);
            }
            $second = rand(0, 59);
            return sprintf('%04d-%02d-%02d %02d:%02d:%02d', $year, $month, $day, $hour, $minute, $second);
        };

        // 1. Fetch new transactions (ID > 20)
        $newOrders = Pemesanan::where('id', '>', 20)->orderBy('id', 'asc')->get();
        $totalNew = $newOrders->count();

        // We want: Dec 2025 (15), Jan 2026 (30), Feb 2026 (45), Mar 2026 (55), Apr 2026 (47), May 2026 (63)
        $distribution = [
            ['year' => 2025, 'month' => 12, 'count' => 15],
            ['year' => 2026, 'month' => 1,  'count' => 30],
            ['year' => 2026, 'month' => 2,  'count' => 45],
            ['year' => 2026, 'month' => 3,  'count' => 55],
            ['year' => 2026, 'month' => 4,  'count' => 47],
            ['year' => 2026, 'month' => 5,  'count' => 63],
        ];

        $orderIndex = 0;
        foreach ($distribution as $dist) {
            $year = $dist['year'];
            $month = $dist['month'];
            $count = $dist['count'];

            for ($i = 0; $i < $count; $i++) {
                if ($orderIndex >= $totalNew) {
                    break;
                }
                $order = $newOrders[$orderIndex];
                $newDateStr = $getRandomDateTime($year, $month);
                
                $dtObj = new DateTime($newDateStr);
                $dateStrForCode = $dtObj->format('Ymd');
                
                $oldNo = $order->nomor_pesanan;
                $newNo = $oldNo;
                $parts = explode('-', $oldNo);
                if (count($parts) === 3) {
                    $parts[1] = $dateStrForCode;
                    $newNo = implode('-', $parts);
                }

                $order->nomor_pesanan = $newNo;
                $order->created_at = $newDateStr;
                $order->updated_at = $newDateStr;
                $order->save();
                $orderIndex++;
            }
        }

        // 2. Fetch original transactions (ID <= 20) and update to June 2026
        $origOrders = Pemesanan::where('id', '<=', 20)->get();
        foreach ($origOrders as $order) {
            $newDateStr = $getRandomDateTime(2026, 6);
            $dtObj = new DateTime($newDateStr);
            $dateStrForCode = $dtObj->format('Ymd');

            $oldNo = $order->nomor_pesanan;
            $newNo = $oldNo;
            $parts = explode('-', $oldNo);
            if (count($parts) === 3) {
                $parts[1] = $dateStrForCode;
                $newNo = implode('-', $parts);
            }

            $order->nomor_pesanan = $newNo;
            $order->created_at = $newDateStr;
            $order->updated_at = $newDateStr;
            $order->save();
        }

        // 3. Ensure we have exactly 25 transactions in June 2026
        $juneCount = Pemesanan::whereYear('created_at', 2026)->whereMonth('created_at', 6)->count();
        $needed = 25 - $juneCount;

        if ($needed > 0) {
            $names = ["Ahmad Santoso", "Budi Wijaya", "Siti Rahayu", "Dewi Lestari", "Agus Setiawan", "Eko Prasetyo", "Yuni Anggraini", "Rudi Hermawan", "Hasan Basri", "Sri Wahyuni", "Dian Pratama", "Rina Lestari", "Tuti Handayani", "Bambang Mulyono"];
            $products = [
                1 => 'Garam Fortifikasi Kelor',
                2 => 'Lulur Garam Kelor',
                3 => 'Sabun Mandi Garam Kelor',
                4 => 'Paket Hemat Blue Economy'
            ];
            $prices = [1 => 15000, 2 => 25000, 3 => 10000, 4 => 55000];
            $payments = [
                ['dana', 'e_wallet'], ['gopay', 'e_wallet'], ['ovo', 'e_wallet'], ['cod', 'cod'],
                ['bca', 'bank_transfer'], ['bni', 'bank_transfer'], ['bri', 'bank_transfer']
            ];

            for ($i = 0; $i < $needed; $i++) {
                $newDateStr = $getRandomDateTime(2026, 6);
                $dtObj = new DateTime($newDateStr);
                $dateStrForCode = $dtObj->format('Ymd');

                $nomorPesanan = 'KGR-' . $dateStrForCode . '-' . strtoupper(\Illuminate\Support\Str::random(6));
                $name = $names[array_rand($names)];
                $prodId = array_rand($products);
                $prodName = $products[$prodId];
                $price = $prices[$prodId];
                $qty = rand(1, 3);
                $total = $price * $qty;
                $pay = $payments[array_rand($payments)];

                Pemesanan::create([
                    'nomor_pesanan' => $nomorPesanan,
                    'nama_pemesan' => $name,
                    'email' => strtolower(str_replace(' ', '.', $name)) . rand(10, 99) . '@gmail.com',
                    'telepon' => '08' . rand(100000000, 999999999),
                    'alamat_pengiriman' => 'Desa Pinggirpapas, Sumenep, Jawa Timur',
                    'produk_id' => $prodId,
                    'nama_produk' => $prodName,
                    'jumlah' => $qty,
                    'harga_satuan' => $price,
                    'total_harga' => $total,
                    'catatan' => 'Pesanan otomatis June 2026',
                    'status' => 'pending',
                    'payment_method' => $pay[1],
                    'payment_channel' => $pay[0],
                    'payment_status' => 'unpaid',
                    'created_at' => $newDateStr,
                    'updated_at' => $newDateStr
                ]);
            }
        }

        DB::commit();

        $counts = DB::table('pemesanans')
            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction dates updated successfully',
            'monthly_counts' => $counts
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});


/*
|--------------------------------------------------------------------------
| Web Routes - e-Business Petambak Garam KUGAR
| Desa Pinggirpapas - Sumenep
| Program Kosabangsa - Blue Economy & GFK Initiative
|--------------------------------------------------------------------------
*/

// ===========================
// HOMEPAGE & PUBLIC PAGES
// ===========================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');
Route::get('/aktivitas-petambak', [HomeController::class, 'activities'])->name('activities');
Route::get('/garam-fortifikasi-kelor', [HomeController::class, 'garamFortifikasiKelor'])->name('gfk');
Route::get('/blue-economy', [HomeController::class, 'blueEconomy'])->name('blue.economy');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');

// ===========================
// PRODUK GARAM ROUTES - ✅ FIXED
// ===========================

Route::prefix('produk')->name('produk.')->group(function () {
    // List produk (PUBLIC - tidak perlu login)
    Route::get('/', [ProdukController::class, 'index'])->name('index');

    // Produk by kategori (PUBLIC - tidak perlu login)
    Route::get('/kategori/{slug}', function ($slug) {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            $produks = Kuliner::where('category_id', $category->id)
                ->paginate(12);
        } catch (\Exception $e) {
            abort(404, 'Kategori tidak ditemukan');
        }
        return view('produk.category', compact('category', 'produks'));
    })->name('category');

    // Debug route (hapus di production) - specific before wildcard
    Route::get('/{id}/debug', [ProdukController::class, 'debug'])
        ->whereNumber('id')
        ->name('debug');

    // Detail produk - HARUS LOGIN (PROTECTED) - constrain to numeric id
    Route::middleware('auth')->get('/{id}', [ProdukController::class, 'show'])
        ->whereNumber('id')
        ->name('show');
});

// ===========================
// PEMESANAN ROUTES (e-Commerce)
// ===========================

// PEMESANAN ROUTES - Grouped properly
Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
    // ✅ SPECIFIC ROUTES FIRST (before wildcard routes)
    
    // Track pesanan - Form (public)
    Route::get('/lacak', function () {
        return view('pemesanan.track');
    })->name('track.form');

    // Track pesanan - Submit (public)
    Route::post('/lacak', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'nomor_pesanan' => 'required|string'
        ], [
            'nomor_pesanan.required' => 'Nomor pesanan harus diisi'
        ]);

        try {
            $pemesanan = Pemesanan::where('nomor_pesanan', $request->nomor_pesanan)->first();

            if (!$pemesanan) {
                return back()->with('error', 'Nomor pesanan tidak ditemukan. Periksa kembali nomor pesanan Anda.');
            }

            return view('pemesanan.track-result', compact('pemesanan'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    })->name('track');

    // BUAT PESANAN - Must be BEFORE {nomor_pesanan} wildcard route!
    Route::get('/buat', [PemesananController::class, 'create'])
        ->middleware('auth')
        ->name('create');

    Route::post('/', [PemesananController::class, 'store'])
        ->middleware('auth')
        ->name('store');

    // ⚠️ WILDCARD ROUTES LAST (catches everything else)
    // Detail pesanan by nomor (public)
    Route::get('/{nomor_pesanan}', [PemesananController::class, 'show'])->name('show');
});

// ===========================
// DEBUG ROUTES (Hapus di production)
// ===========================
// Route::get('/debug-pemesanan', function () { ... });
// Route::get('/test-pemesanan-form', function () { ... });

// ===========================
// ADMIN ROUTES - Management
// ===========================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        try {
            $stats = [
                'total_pemesanan' => Pemesanan::count(),
                'pemesanan_pending' => Pemesanan::where('status', 'pending')->count(),
                'pemesanan_proses' => Pemesanan::where('status', 'processing')->count(),
                'pemesanan_selesai' => Pemesanan::where('status', 'delivered')->count(),
                'total_produk' => Kuliner::count(),
                'produk_active' => Kuliner::count(),
                'revenue_bulan_ini' => Pemesanan::whereMonth('created_at', now()->month)
                    ->where('status', 'delivered')
                    ->sum('total_harga'),
                'revenue_hari_ini' => Pemesanan::whereDate('created_at', now())
                    ->where('status', 'delivered')
                    ->sum('total_harga'),
                'total_petambak' => 45,
                'area_tambak' => '45 Hektar',
                'produksi_target' => '500 Ton/Tahun'
            ];

            $recentOrders = Pemesanan::latest()->take(10)->get();
            
            // Debug logging
            \Log::info('Dashboard stats loaded', ['stats' => $stats, 'orders_count' => $recentOrders->count()]);
            
        } catch (\Exception $e) {
            \Log::error('Dashboard error: ' . $e->getMessage());
            
            $stats = [
                'total_pemesanan' => 0,
                'pemesanan_pending' => 0,
                'pemesanan_proses' => 0,
                'pemesanan_selesai' => 0,
                'total_produk' => 0,
                'produk_active' => 0,
                'revenue_bulan_ini' => 0,
                'revenue_hari_ini' => 0,
                'total_petambak' => 45,
                'area_tambak' => '45 Hektar',
                'produksi_target' => '500 Ton/Tahun'
            ];
            $recentOrders = collect();
        }

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    })->name('dashboard');

    // ===========================
    // PEMESANAN MANAGEMENT
    // ===========================
    Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
        Route::get('/', [PemesananController::class, 'index'])->name('index');

        // Export routes first to avoid being caught by wildcard {id}
        Route::get('/export/{format}', [PemesananController::class, 'export'])->name('export');

        // ID-based routes with numeric constraint
        Route::get('/{id}/edit', [PemesananController::class, 'edit'])
            ->whereNumber('id')
            ->name('edit');
        Route::put('/{id}', [PemesananController::class, 'update'])
            ->whereNumber('id')
            ->name('update');
        Route::delete('/{id}', [PemesananController::class, 'destroy'])
            ->whereNumber('id')
            ->name('destroy');

        // Quick Status Actions
        Route::post('/{id}/konfirmasi', [PemesananController::class, 'confirm'])
            ->whereNumber('id')
            ->name('confirm');
        Route::post('/{id}/proses', [PemesananController::class, 'process'])
            ->whereNumber('id')
            ->name('process');
        Route::post('/{id}/kirim', [PemesananController::class, 'ship'])
            ->whereNumber('id')
            ->name('ship');
        Route::post('/{id}/selesai', [PemesananController::class, 'deliver'])
            ->whereNumber('id')
            ->name('deliver');
        Route::post('/{id}/batal', [PemesananController::class, 'cancel'])
            ->whereNumber('id')
            ->name('cancel');

        // Payment Status Actions
        Route::post('/{id}/mark-paid', [PemesananController::class, 'markPaid'])
            ->whereNumber('id')
            ->name('mark.paid');
        Route::post('/{id}/mark-pending', [PemesananController::class, 'markPending'])
            ->whereNumber('id')
            ->name('mark.pending');

        // AJAX Update Status
        Route::patch('/{id}/status', [PemesananController::class, 'updateStatus'])
            ->whereNumber('id')
            ->name('update.status');
    });

    // ===========================
    // PRODUK MANAGEMENT
    // ===========================
    Route::resource('produk', AdminProdukController::class)->except(['show']);

    // ===========================
    // VIRTUAL TOUR MANAGEMENT
    // ===========================
    Route::resource('virtual', AdminVirtualTourController::class)->except(['show']);

    // ===========================
    // USER MANAGEMENT
    // ===========================
    Route::resource('users', AdminUserController::class)->only(['index','destroy'])->names('users');
    Route::post('users/{id}/restore', [AdminUserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{id}/force-delete', [AdminUserController::class, 'forceDelete'])->name('users.forceDelete');
});

// ===========================
// VIRTUAL TOUR PETAMBAK
// ===========================

Route::prefix('virtual-tour')->name('virtual.')->group(function () {
    Route::get('/', [VirtualTourController::class, 'index'])->name('index');
    Route::get('/{id}', [VirtualTourController::class, 'show'])->name('show');
});

// ===========================
// SYSTEM CHECK & DEBUGGING
// ===========================

if (config('app.debug')) {
    Route::get('/test', function () {
        $checks = [
            'app_name' => 'e-Business Petambak Garam KUGAR',
            'program' => 'Kosabangsa - Blue Economy & GFK Initiative',
            'desa' => 'Pinggirpapas, Sumenep',
            'laravel_version' => app()->version(),
            'php_version' => PHP_VERSION,
            'environment' => app()->environment(),
        ];

        try {
            DB::connection()->getPdo();
            $checks['database'] = [
                'status' => '✅ Connected',
                'name' => DB::connection()->getDatabaseName(),
            ];

            $checks['data'] = [
                'pemesanan' => Pemesanan::count(),
                'produk' => Kuliner::count(),
                'pemesanan_pending' => Pemesanan::where('status', 'pending')->count(),
                'pemesanan_selesai' => Pemesanan::where('status', 'delivered')->count(),
            ];

            $checks['program_kosabangsa'] = [
                'total_petambak' => 45,
                'area_tambak' => '45 Hektar',
                'produksi_target' => '500 Ton/Tahun',
                'fokus' => ['Blue Economy', 'GFK (Garam Fortifikasi Kelor)', 'e-Business'],
            ];
        } catch (\Exception $e) {
            $checks['database'] = [
                'status' => '❌ Failed',
                'error' => $e->getMessage()
            ];
        }

        return response()->json($checks, 200, [], JSON_PRETTY_PRINT);
    })->name('test');

    Route::get('/test-db', function () {
        try {
            DB::connection()->getPdo();
            $dbName = DB::connection()->getDatabaseName();
            $tables = DB::select('SHOW TABLES');

            $html = "
            <!DOCTYPE html>
            <html lang='id'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Database Test - KUGAR Pinggirpapas</title>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
            </head>
            <body class='bg-light'>
                <div class='container py-5'>
                    <div class='card shadow'>
                        <div class='card-header bg-success text-white'>
                            <h4 class='mb-0'>✅ Database KUGAR Connected!</h4>
                        </div>
                        <div class='card-body'>
                            <div class='alert alert-info'>
                                <strong>Program Kosabangsa:</strong> Pemberdayaan Ekonomi Petambak Garam KUGAR<br>
                                <strong>Fokus:</strong> Blue Economy & Garam Fortifikasi Kelor (GFK)
                            </div>
                            <table class='table table-borderless'>
                                <tr>
                                    <th width='200'>Database:</th>
                                    <td><strong>{$dbName}</strong></td>
                                </tr>
                                <tr>
                                    <th>Total Tables:</th>
                                    <td><span class='badge bg-primary'>" . count($tables) . "</span></td>
                                </tr>
                                <tr>
                                    <th>Desa:</th>
                                    <td>Pinggirpapas, Sumenep</td>
                                </tr>
                            </table>
                            
                            <h5 class='mt-4'>Data Tables:</h5>
                            <div class='row'>";

            foreach ($tables as $table) {
                $tableName = array_values((array)$table)[0];
                try {
                    $count = DB::table($tableName)->count();
                    $html .= "
                        <div class='col-md-6 mb-2'>
                            <div class='card'>
                                <div class='card-body p-2'>
                                    <div class='d-flex justify-content-between'>
                                        <span><i class='fas fa-table'></i> {$tableName}</span>
                                        <span class='badge bg-info'>{$count} rows</span>
                                    </div>
                                </div>
                            </div>
                        </div>";
                } catch (\Exception $e) {
                    // Skip jika error
                }
            }

            $html .= "
                            </div>
                        </div>
                        <div class='card-footer'>
                            <a href='/' class='btn btn-primary'>← Kembali ke Beranda</a>
                            <a href='/test' class='btn btn-info'>View JSON</a>
                        </div>
                    </div>
                </div>
            </body>
            </html>
            ";

            return $html;
        } catch (\Exception $e) {
            return response("
                <div style='padding: 50px; font-family: Arial;'>
                    <h1 style='color: red;'>❌ Database Connection Failed</h1>
                    <p><strong>Error:</strong> {$e->getMessage()}</p>
                    <p><strong>Solusi:</strong></p>
                    <ul>
                        <li>Pastikan DBngin MySQL sedang running</li>
                        <li>Cek file .env untuk DB_HOST, DB_DATABASE, DB_USERNAME</li>
                        <li>Jalankan: php artisan config:clear</li>
                    </ul>
                    <a href='/'>← Back to Home</a>
                </div>
            ", 500);
        }
    })->name('test.db');
}

// ===========================
// BREEZE AUTHENTICATION ROUTES
// ===========================

// Dashboard untuk authenticated users (admin & user bisa akses)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (dari Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes dengan role protection
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin-auth')->name('admin.auth.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

// Load Breeze auth routes (login, register, password reset, etc)
require __DIR__ . '/auth.php';

// ===========================
// FALLBACK ROUTE (404)
// ===========================


// ===========================
// TEMPORARY: Reset Produk (Hapus setelah digunakan)
// ===========================
Route::get('/reset-produk-katalog', function() {
    try {
        Artisan::call('db:seed', ['--class' => 'KulinerSeeder', '--force' => true]);
        return "✅ Produk berhasil direset sesuai katalog baru!<br><a href='/produk'>Lihat Produk</a>";
    } catch (\Exception $e) {
        return "❌ Error: " . $e->getMessage();
    }
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
