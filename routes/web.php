<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemesananController;
use App\Models\Pemesanan;  // ✅ Model SUDAH ADA
use App\Models\Produk;     // ✅ Model SUDAH ADA

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
// PRODUK GARAM ROUTES
// ===========================

Route::prefix('produk')->name('produk.')->group(function () {
    // List produk
    Route::get('/', function () {
        try {
            $produks = Produk::where('status', 'active')
                ->latest()
                ->paginate(12);
            $categories = \App\Models\Category::where('status', 'active')->get();
        } catch (\Exception $e) {
            // Jika database kosong, buat dummy data
            $produks = collect([
                (object)[
                    'id' => 1,
                    'name' => 'Garam Konsumsi Premium',
                    'description' => 'Garam murni berkualitas tinggi untuk kebutuhan dapur sehari-hari',
                    'price' => 15000,
                    'image' => 'https://images.unsplash.com/photo-1560717845-968905ba5ebf?w=500',
                    'status' => 'active'
                ],
                (object)[
                    'id' => 2,
                    'name' => 'Garam Fortifikasi Kelor (GFK)',
                    'description' => 'Garam bergizi dengan tambahan nutrisi daun kelor untuk kesehatan keluarga',
                    'price' => 25000,
                    'image' => 'https://images.unsplash.com/photo-1505253758473-96b7015fcd40?w=500',
                    'status' => 'active'
                ],
                (object)[
                    'id' => 3,
                    'name' => 'Garam Industri',
                    'description' => 'Garam untuk kebutuhan industri dan pengolahan skala besar',
                    'price' => 8000,
                    'image' => 'https://images.unsplash.com/photo-1582106245687-d04a8e16a2e8?w=500',
                    'status' => 'active'
                ],
            ]);
            $categories = collect();
        }

        return view('produk.index', compact('produks', 'categories'));
    })->name('index');

    // Detail produk
    Route::get('/{id}', function ($id) {
        try {
            $produk = Produk::findOrFail($id);
            $relatedProducts = Produk::where('id', '!=', $id)
                ->where('status', 'active')
                ->take(4)
                ->get();
        } catch (\Exception $e) {
            abort(404, 'Produk tidak ditemukan');
        }
        return view('produk.show', compact('produk', 'relatedProducts'));
    })->name('show');

    // Produk by kategori
    Route::get('/kategori/{slug}', function ($slug) {
        try {
            $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
            $produks = Produk::where('category_id', $category->id)
                ->where('status', 'active')
                ->paginate(12);
        } catch (\Exception $e) {
            abort(404, 'Kategori tidak ditemukan');
        }
        return view('produk.category', compact('category', 'produks'));
    })->name('category');
});

// ===========================
// PEMESANAN ROUTES (e-Commerce)
// ===========================

Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
    // Form pemesanan baru
    Route::get('/buat', [PemesananController::class, 'create'])->name('create');
    Route::post('/', [PemesananController::class, 'store'])->name('store');

    // Track pesanan - Form
    Route::get('/lacak', function () {
        return view('pemesanan.track');
    })->name('track.form');

    // Track pesanan - Submit
    Route::post('/lacak', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'nomor_pesanan' => 'required|string'
        ], [
            'nomor_pesanan.required' => 'Nomor pesanan harus diisi'
        ]);

        try {
            // ✅ Pakai Model Pemesanan yang SUDAH ADA
            $pemesanan = Pemesanan::where('nomor_pesanan', $request->nomor_pesanan)->first();

            if (!$pemesanan) {
                return back()->with('error', 'Nomor pesanan tidak ditemukan. Periksa kembali nomor pesanan Anda.');
            }

            return view('pemesanan.track-result', compact('pemesanan'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    })->name('track');

    // Detail pesanan by nomor
    Route::get('/{nomor_pesanan}', [PemesananController::class, 'show'])->name('show');
});

// ===========================
// ADMIN ROUTES - Management
// ===========================

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        try {
            // ✅ Pakai Model yang SUDAH ADA
            $stats = [
                'total_pemesanan' => Pemesanan::count(),
                'pemesanan_pending' => Pemesanan::where('status', 'pending')->count(),
                'pemesanan_proses' => Pemesanan::where('status', 'processing')->count(),
                'pemesanan_selesai' => Pemesanan::where('status', 'delivered')->count(),
                'total_produk' => Produk::count(),
                'produk_active' => Produk::where('status', 'active')->count(),
                'revenue_bulan_ini' => Pemesanan::whereMonth('created_at', now()->month)
                    ->where('status', 'delivered')
                    ->sum('total_harga'),
                'revenue_hari_ini' => Pemesanan::whereDate('created_at', now())
                    ->where('status', 'delivered')
                    ->sum('total_harga'),
                // Data Program Kosabangsa
                'total_petambak' => 45,
                'area_tambak' => '45 Hektar',
                'produksi_target' => '500 Ton/Tahun'
            ];

            // Recent orders
            $recentOrders = Pemesanan::latest()->take(10)->get();
        } catch (\Exception $e) {
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
        Route::get('/{id}/edit', [PemesananController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PemesananController::class, 'update'])->name('update');
        Route::delete('/{id}', [PemesananController::class, 'destroy'])->name('destroy');

        // Quick Status Actions
        Route::post('/{id}/konfirmasi', [PemesananController::class, 'confirm'])->name('confirm');
        Route::post('/{id}/proses', [PemesananController::class, 'process'])->name('process');
        Route::post('/{id}/kirim', [PemesananController::class, 'ship'])->name('ship');
        Route::post('/{id}/selesai', [PemesananController::class, 'deliver'])->name('deliver');
        Route::post('/{id}/batal', [PemesananController::class, 'cancel'])->name('cancel');

        // AJAX Update Status
        Route::patch('/{id}/status', [PemesananController::class, 'updateStatus'])->name('update.status');

        // Export
        Route::get('/export/{format}', [PemesananController::class, 'export'])->name('export');
    });

    // ===========================
    // PRODUK MANAGEMENT
    // ===========================
    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', function () {
            try {
                $produks = Produk::with('category')->latest()->paginate(15);
            } catch (\Exception $e) {
                $produks = collect();
            }
            return view('admin.produk.index', compact('produks'));
        })->name('index');

        Route::get('/create', function () {
            try {
                $categories = \App\Models\Category::all();
            } catch (\Exception $e) {
                $categories = collect();
            }
            return view('admin.produk.create', compact('categories'));
        })->name('create');

        Route::get('/{id}/edit', function ($id) {
            try {
                $produk = Produk::findOrFail($id);
                $categories = \App\Models\Category::all();
            } catch (\Exception $e) {
                abort(404);
            }
            return view('admin.produk.edit', compact('produk', 'categories'));
        })->name('edit');
    });
});

// ===========================
// VIRTUAL TOUR PETAMBAK
// ===========================

Route::prefix('virtual-tour')->name('virtual.')->group(function () {
    Route::get('/', function () {
        try {
            $virtualTours = \App\Models\Virtual::orderBy('created_at', 'desc')->paginate(12);
        } catch (\Exception $e) {
            $virtualTours = collect();
        }
        return view('virtual.index', compact('virtualTours'));
    })->name('index');

    Route::get('/{id}', function ($id) {
        try {
            $virtualTour = \App\Models\Virtual::findOrFail($id);
            $relatedTours = \App\Models\Virtual::where('id', '!=', $id)->take(3)->get();
        } catch (\Exception $e) {
            abort(404, 'Virtual tour tidak ditemukan');
        }
        return view('virtual.show', compact('virtualTour', 'relatedTours'));
    })->name('show');
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

            // ✅ Count menggunakan Model yang SUDAH ADA
            $checks['data'] = [
                'pemesanan' => Pemesanan::count(),
                'produk' => Produk::count(),
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
// FALLBACK ROUTE (404)
// ===========================

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
