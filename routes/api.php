<?php

use App\Filament\Resources\UserResource\Api\UserApiService;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ContentApiController;
use App\Http\Controllers\Api\PemesananApiController;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\VirtualTourApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ==========================
// AUTH PELANGGAN (SANCTUM)
// ==========================

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthApiController::class, 'register']);
    Route::post('/login', [AuthApiController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthApiController::class, 'me']);
        Route::post('/logout', [AuthApiController::class, 'logout']);
    });
});

// ==========================
// ADMIN AUTHENTICATION & API
// ==========================
Route::prefix('admin')->group(function () {
    // Login admin (public)
    Route::post('/login', [\App\Http\Controllers\Api\AdminAuthController::class, 'login']);
    
    // Routes yang membutuhkan autentikasi admin
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        // Authentication
        Route::post('/logout', [\App\Http\Controllers\Api\AdminAuthController::class, 'logout']);
        Route::get('/me', [\App\Http\Controllers\Api\AdminAuthController::class, 'me']);
        
        // Manajemen User
        Route::apiResource('users', \App\Http\Controllers\Api\AdminApiController::class);
        
        // Manajemen Produk
        Route::apiResource('products', \App\Http\Controllers\Api\AdminProductApiController::class);
        Route::post('products/{id}/upload-image', [\App\Http\Controllers\Api\AdminProductApiController::class, 'uploadImage']);
        
        // Manajemen Pemesanan/Orders
        Route::get('orders', [\App\Http\Controllers\Api\AdminApiController::class, 'orders']);
        Route::get('orders/{id}', [\App\Http\Controllers\Api\AdminApiController::class, 'showOrder']);
        Route::put('orders/{id}/status', [\App\Http\Controllers\Api\AdminApiController::class, 'updateOrderStatus']);
        
        // Statistik Dashboard
        Route::get('statistics', [\App\Http\Controllers\Api\AdminApiController::class, 'statistics']);
        
        // Manajemen Virtual Tour
        Route::apiResource('virtual-tours', \App\Http\Controllers\Api\AdminVirtualTourApiController::class);
        Route::post('virtual-tours/{id}/toggle-active', [\App\Http\Controllers\Api\AdminVirtualTourApiController::class, 'toggleActive']);
        Route::post('virtual-tours/reorder', [\App\Http\Controllers\Api\AdminVirtualTourApiController::class, 'reorder']);
        
        // Manajemen Konten
        Route::get('contents', [\App\Http\Controllers\Api\AdminContentApiController::class, 'index']);
        
        // About
        Route::get('contents/about', [\App\Http\Controllers\Api\AdminContentApiController::class, 'getAbout']);
        Route::put('contents/about', [\App\Http\Controllers\Api\AdminContentApiController::class, 'updateAbout']);
        
        // Pengurus
        Route::get('contents/pengurus', [\App\Http\Controllers\Api\AdminContentApiController::class, 'getPengurus']);
        Route::post('contents/pengurus', [\App\Http\Controllers\Api\AdminContentApiController::class, 'storePengurus']);
        Route::put('contents/pengurus/{id}', [\App\Http\Controllers\Api\AdminContentApiController::class, 'updatePengurus']);
        Route::delete('contents/pengurus/{id}', [\App\Http\Controllers\Api\AdminContentApiController::class, 'destroyPengurus']);
        
        // Documents
        Route::get('contents/documents', [\App\Http\Controllers\Api\AdminContentApiController::class, 'getDocuments']);
        Route::post('contents/documents', [\App\Http\Controllers\Api\AdminContentApiController::class, 'storeDocument']);
        Route::put('contents/documents/{id}', [\App\Http\Controllers\Api\AdminContentApiController::class, 'updateDocument']);
        Route::delete('contents/documents/{id}', [\App\Http\Controllers\Api\AdminContentApiController::class, 'destroyDocument']);
        
        // Posts/Blog
        Route::get('contents/posts', [\App\Http\Controllers\Api\AdminContentApiController::class, 'getPosts']);
        Route::post('contents/posts', [\App\Http\Controllers\Api\AdminContentApiController::class, 'storePost']);
        Route::put('contents/posts/{id}', [\App\Http\Controllers\Api\AdminContentApiController::class, 'updatePost']);
        Route::delete('contents/posts/{id}', [\App\Http\Controllers\Api\AdminContentApiController::class, 'destroyPost']);
        
        // Backup & Export Data
        Route::post('export/orders', [\App\Http\Controllers\Api\AdminApiController::class, 'exportOrders']);
        Route::post('backup/database', [\App\Http\Controllers\Api\AdminApiController::class, 'backupDatabase']);
    });
});

// ==========================
// PRODUK GARAN / KULINER
// ==========================

Route::get('/produk', [ProdukApiController::class, 'index']);
Route::get('/produk/{id}', [ProdukApiController::class, 'show']);

// ==========================
// VIRTUAL TOUR & GALERI
// ==========================

Route::get('/virtual-tour', [VirtualTourApiController::class, 'index']);
Route::get('/virtual-tour/{id}', [VirtualTourApiController::class, 'show']);

// ==========================
// KONTEN STATIS
// ==========================

Route::get('/content/about', [ContentApiController::class, 'about']);
Route::get('/content/blue-economy', [ContentApiController::class, 'blueEconomy']);
Route::get('/content/gfk', [ContentApiController::class, 'gfk']);

// ==========================
// PEMESANAN (ORDER)
// ==========================

// Buat pesanan & list pesanan milik user (harus login)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pemesanan', [PemesananApiController::class, 'store']);
    Route::get('/pemesanan', [PemesananApiController::class, 'index']);
});

// Tracking pesanan berdasarkan nomor (public)
Route::get('/pemesanan/track/{nomor_pesanan}', [PemesananApiController::class, 'track']);

