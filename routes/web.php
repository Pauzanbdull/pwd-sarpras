<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiBarangController;
use App\Http\Controllers\ApiPeminjamanController;

// Redirect root ke login
Route::redirect('/', '/login');

// ============================
//        AUTHENTICATION
// ============================

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================
//        DASHBOARD
// ============================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// ============================
//      HALAMAN STATIS
// ============================

Route::get('/pendataan', fn() => view('pendataan'))->name('pendataan');
Route::get('/laporan', fn() => view('laporan'))->name('laporan');

// ============================
//     MANAJEMEN PENGGUNA
// ============================

Route::middleware('auth')->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
});

// ============================
//      KATEGORI BARANG
// ============================

Route::resource('kategori', KategoriBarangController::class)->middleware('auth');

// ============================
//         BARANG
// ============================

Route::resource('barang', BarangController::class)->middleware('auth');

// ============================
//   PENDAFTARAN USER BIASA
// ============================

Route::get('/register-user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register.user.store');

// ============================
//        PEMINJAMAN
// ============================

Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

// ============================
//       PENGEMBALIAN
// ============================

Route::resource('pengembalian', PengembalianController::class)->middleware('auth');

// ============================
//         LAPORAN
// ============================

Route::get('/laporan/stok', [LaporanController::class, 'stok'])->name('laporan.index');

// ============================
//        API ROUTES (WEB)
// ============================

Route::prefix('api')->group(function () {

    // USER
    Route::prefix('users')->group(function () {
        Route::get('/', [ApiUserController::class, 'index']);
        Route::get('/{id}', [ApiUserController::class, 'show']);
        Route::post('/', [ApiUserController::class, 'store']);
        Route::put('/{id}', [ApiUserController::class, 'update']);
        Route::delete('/{id}', [ApiUserController::class, 'destroy']);
    });

    // BARANG
    Route::prefix('barangs')->group(function () {
        Route::get('/', [ApiBarangController::class, 'index']);
        Route::get('/{id}', [ApiBarangController::class, 'show']);
        Route::post('/', [ApiBarangController::class, 'store']);
        Route::put('/{id}', [ApiBarangController::class, 'update']);
        Route::delete('/{id}', [ApiBarangController::class, 'destroy']);
    });

    // PEMINJAMAN
    Route::apiResource('peminjaman', ApiPeminjamanController::class);
    Route::get('/peminjaman', [ApiPeminjamanController::class, 'index']);
Route::get('/peminjaman/{id}', [ApiPeminjamanController::class, 'show']);
Route::post('/peminjaman/{id}/approve', [ApiPeminjamanController::class, 'approve']);
Route::post('/peminjaman/{id}/reject', [ApiPeminjamanController::class, 'reject']);
});
