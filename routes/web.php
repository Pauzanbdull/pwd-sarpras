<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;


// Auth Routes
Route::redirect('/', '/login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Lain-lain Pages
Route::get('/pendataan', function () {
    return view('pendataan');
})->name('pendataan');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');

// CRUD Pengguna
Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');

// CRUD Kategori Barang
Route::resource('kategori', KategoriBarangController::class);

// CRUD Barang
Route::resource('barang', BarangController::class);

// Tambah User Biasa
Route::get('/register-user', [AuthController::class, 'showUserRegistrationForm'])->name('register.user');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register.user.store');

// CRUD Peminjaman
Route::get  ('/peminjaman',            [PeminjamanController::class, 'index' ])->name('peminjaman.index');
Route::get  ('/peminjaman/create',     [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post ('/peminjaman',            [PeminjamanController::class, 'store' ])->name('peminjaman.store');
Route::post ('/peminjaman/{id}/approve',[PeminjamanController::class, 'approve'])->name('peminjaman.approve');
Route::post ('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject' ])->name('peminjaman.reject');

//CRUD Pengembalian 
Route::resource('pengembalian', PengembalianController::class);

//CRUD Laporan 
Route::get('/laporan/stok', [LaporanController::class, 'stok'])->name('laporan.index');


