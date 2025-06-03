<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\HistoryPengeluaranController;
use App\Http\Controllers\HistoryPesanController;
use App\Http\Controllers\JenisKostController;
use App\Http\Controllers\KategoriPengeluaranController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PengelolaController;
use App\Http\Controllers\PengelolaPropertiController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\PeraturanController;
use App\Http\Controllers\PropertiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\UserController;
use App\Models\Booking;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layouts.app');
// });
Route::get('/',[LandingController::class, "landing"])->name('landing');

Route::resource('bookings', BookingController::class);
Route::resource('fasilitas', FasilitasController::class);
Route::resource('history_pengeluarans', HistoryPengeluaranController::class);
Route::resource('history_pesans', HistoryPesanController::class);
Route::resource('jeniskosts', JenisKostController::class);
Route::resource('kategori_pengeluarans', KategoriPengeluaranController::class);
Route::resource('metode_pembayarans', MetodePembayaranController::class);
Route::resource('payments', PaymentController::class);
Route::resource('pengelolas', PengelolaController::class);
Route::resource('pengelola_properties', PengelolaPropertiController::class);
Route::resource('penyewas', PenyewaController::class);
Route::resource('peraturans', PeraturanController::class);
Route::resource('properties', PropertiController::class);
Route::resource('rooms', RoomController::class);
Route::resource('User', UserController::class);

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\Auth\AuthController::class, 'showprofile'])->name('profile');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('kamar-by-kost/{id}', [BookingController::class, 'kamar_by_id_kost'])->name('kamar_by_kost');

Route::get('booking-detail/{id}', [PaymentController::class, 'getBookingDetail']);
Route::get("chat_bot", function () {
    return view("chat_bot");
})->name('chat_bot');


Route::get('daftarkost', [PropertiController::class, 'daftarkost'])->name('daftarkost');
Route::get('daftarkamar', [RoomController::class, 'daftarkamar'])->name('daftarkamar');
Route::get('pemesanan', [BookingController::class, 'pemesanan'])->name('pemesanan');
Route::get('historybooking', [BookingController::class, 'historybooking'])->name('historybooking');
Route::get('/kost/{id_properti}', [PropertiController::class, 'detailKost'])->name('detailkost');
Route::get('/send-telegram', [TelegramController::class, 'send']);
// Route::get('/get-payment-details', [PaymentController::class, 'getDetails']);
// routes/web.php
Route::get('/get-payment-details', [BookingController::class, 'getPaymentDetails']);
Route::post('/booking/{booking}/payment', [BookingController::class, 'processPayment']);

Route::get('detailkamar', function () {return view('detailkamar');})->name('detailkamar');
// Route::get('pemesanan', function () {return view('pemesanan');});
Route::get('/send-message', [MessageController::class, 'send']);
Route::get('okupansi',function(){
    $data = DB::table('rooms')
    ->leftJoin('bookings', function($join) {
        $join->on('bookings.room_id', '=', 'rooms.id')
             ->whereNull('bookings.deleted_at')
             ->whereDate('bookings.start_date', '<=', now())
             ->whereDate('bookings.end_date', '>=', now());
    })
    ->leftJoin('penyewas', 'penyewas.id', '=', 'bookings.penyewa_id')
    ->leftJoin('payments', 'payments.booking_id', '=', 'bookings.id')
    ->select(
        'rooms.room_name as tipe_kamar',
        DB::raw("CASE 
                    WHEN rooms.is_available = '0' THEN 'Tidak tersedia'
                    WHEN bookings.id IS NULL THEN 'Kosong'
                    ELSE 'Terisi'
                END as status_kamar"),
        'penyewas.nama as penyewa_nama',
        'penyewas.nohp as penyewa_nohp',
        DB::raw("CASE 
                    WHEN CURDATE() BETWEEN bookings.start_date AND bookings.end_date THEN 'Sudah Check-in'
                    WHEN CURDATE() < bookings.start_date THEN 
                        CONCAT('H-', DATEDIFF(bookings.start_date, CURDATE()), ' Check-in')
                    WHEN CURDATE() = bookings.end_date THEN 'Hari H Check-out'
                    WHEN CURDATE() > bookings.end_date THEN 'Sudah Check-out'
                    ELSE NULL
                END as status_penyewa"),
        DB::raw("CONCAT(TIMESTAMPDIFF(MONTH, bookings.start_date, bookings.end_date), ' Bulan') as durasi_sewa"),
        'bookings.start_date as tanggal_checkin',
        'bookings.end_date as tanggal_checkout',
        'payments.jumlah as deposit'
    )
    ->whereNull('rooms.deleted_at')
    ->orderBy('rooms.room_name')
    ->get();

    return view('okupansi.index',compact('data'));
});