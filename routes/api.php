<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiBarangController;
use App\Http\Controllers\ApiPeminjamanController;
use App\Http\Controllers\ApiPengembalianController; // Tambahkan ini
use App\Http\Controllers\AuthController;

// API Login (tanpa auth)
Route::post('/login', [AuthController::class, 'apiLogin']);

// Group yang memerlukan Sanctum Auth
Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::delete('/logout', [AuthController::class, 'apiLogout']);

    // Cek info user login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // CRUD Users & Barangs
    Route::apiResource('users', ApiUserController::class);
    Route::apiResource('barangs', ApiBarangController::class);

    // Peminjaman routes
    Route::get('/peminjaman', [ApiPeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjamanStore', [ApiPeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{peminjaman}', [ApiPeminjamanController::class, 'show'])->name('peminjaman.show');
    Route::post('/peminjaman/{peminjaman}/approve', [ApiPeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::post('/peminjaman/{peminjaman}/reject', [ApiPeminjamanController::class, 'reject'])->name('peminjaman.reject');

    // ✅ Pengembalian routes (tambahkan ini)
    Route::get('/pengembalian', [ApiPengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian', [ApiPengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('/pengembalian/{id}', [ApiPengembalianController::class, 'show'])->name('pengembalian.show');
    Route::delete('/pengembalian/{id}', [ApiPengembalianController::class, 'destroy'])->name('pengembalian.destroy');
});
