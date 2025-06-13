<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiBarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiPeminjamanController;

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

    // Peminjaman
    Route::get('/peminjaman', [ApiPeminjamanController::class, 'index']);
    Route::post('/peminjaman', [ApiPeminjamanController::class, 'store']);
    Route::post('/peminjaman/{id}/approve', [ApiPeminjamanController::class, 'approve']);
    Route::post('/peminjaman/{id}/reject', [ApiPeminjamanController::class, 'reject']);
});
