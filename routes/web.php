<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\KulinerController;
use Illuminate\Support\Facades\Route;
use App\Helpers\HTMLPurifierHelper;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SchoolProfileController;
use App\Models\Kuliner;
use Illuminate\Support\Facades\Log;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/sekolah', [SchoolProfileController::class, 'index'])->name('school.profile');
Route::get('/buku', [DocumentController::class, 'index'])->name('documents.index');

Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/category/{category}', [BlogController::class, 'category'])->name('category.blogs');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [App\Http\Controllers\AboutController::class, 'index']);

Route::get('/kuliner', [KulinerController::class, 'index']);
Route::get('/kuliner/{id}', [KulinerController::class, 'show'])->name('kuliner.show');

Route::get('/blog', [BlogController::class, 'index']);

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

Route::get('reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');
