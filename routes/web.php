<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanStokController;
use App\Http\Controllers\LaporanPeminjamanController;
use App\Http\Controllers\LaporanPengembalianController;
use App\Exports\BarangExport;
use Maatwebsite\Excel\Facades\Excel;

// Redirect root ke dashboard atau login
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register user biasa
Route::get('/register-user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register.user.store');

// Dashboard
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {

    Route::view('/pendataan', 'pendataan')->name('pendataan');
    Route::view('/laporan', 'laporan')->name('laporan'); // gunakan hanya satu nama route

    // Pengguna
    Route::resource('pengguna', PenggunaController::class)->names([
        'index'   => 'pengguna.index',
        'create'  => 'pengguna.create',
        'store'   => 'pengguna.store',
        'show'    => 'pengguna.show',
        'edit'    => 'pengguna.edit',
        'update'  => 'pengguna.update',
        'destroy' => 'pengguna.destroy',
    ]);

    // Kategori dan Barang
    Route::resource('kategori', KategoriBarangController::class);
    Route::resource('barang', BarangController::class);

    // Laporan Stok
    Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');

Route::get('/laporan/stok', [LaporanStokController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/stok/export', [LaporanStokController::class, 'exportExcel'])->name('laporan.stok.export');

    // Laporan Peminjaman
    Route::get('/laporan/peminjaman', [LaporanPeminjamanController::class, 'index'])->name('laporan.peminjaman');
    Route::get('/laporan/peminjaman/export', [LaporanPeminjamanController::class, 'exportExcel'])->name('laporan.peminjaman.export');

    // Laporan Pengembalian
    Route::get('/laporan/pengembalian', [LaporanPengembalianController::class, 'index'])->name('laporan.pengembalian');
    Route::get('/laporan/pengembalian/export', [LaporanPengembalianController::class, 'exportExcel'])->name('laporan.pengembalian.export');

    // Peminjaman
    Route::resource('peminjaman', PeminjamanController::class);
    Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
});

// Pengembalian 
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('pengembalian', PengembalianController::class);
    Route::post('/pengembalian/{id}/approve', [PengembalianController::class, 'approve'])->name('pengembalian.approve');
    Route::post('/pengembalian/{id}/reject', [PengembalianController::class, 'reject'])->name('pengembalian.reject');
});
