<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\HistoryPengeluaranController;
use App\Http\Controllers\HistoryPesanController;
use App\Http\Controllers\JenisKostController;
use App\Http\Controllers\KategoriPengeluaranController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PengelolaController;
use App\Http\Controllers\PengelolaPropertiController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\PeraturanController;
use App\Http\Controllers\PropertiController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::resource('bookings', BookingController::class);
Route::resource('history_pengeluarans', HistoryPengeluaranController::class);
Route::resource('history_pesans', HistoryPesanController::class);
Route::resource('jeniskosts', JenisKostController::class);
Route::resource('kategori_pengeluarans', KategoriPengeluaranController::class);
Route::resource('payments', PaymentController::class);
Route::resource('pengelolas', PengelolaController::class);
Route::resource('pengelola_properties', PengelolaPropertiController::class);
Route::resource('penyewas', PenyewaController::class);
Route::resource('properties', PropertiController::class);
Route::resource('rooms', RoomController::class);
Route::resource('fasilitas', FasilitasController::class);
Route::resource('peraturans', PeraturanController::class);
Route::resource('metode_pembayarans', MetodePembayaranController::class);
Route::resource('User', UserController::class);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
