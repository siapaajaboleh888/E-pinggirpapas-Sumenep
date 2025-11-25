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

// (Opsional) route login/logout untuk admin Filament via API lama tetap dipertahankan
Route::post('/admin/login', [UserApiService::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/logout', [UserApiService::class, 'logout']);
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
