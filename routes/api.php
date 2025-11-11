<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerekController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\LaporanController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum', 'admin')->group(function () {
    Route::apiResource('merek', MerekController::class);
    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('alat', AlatController::class);
    Route::apiResource('sparepart', SparepartController::class);
    Route::apiResource('cabang', CabangController::class);
    Route::apiResource('operator', OperatorController::class);
    Route::apiResource('teknisi', TeknisiController::class);

    Route::get('/laporan/pemasukan', [LaporanController::class, 'getTotalPemasukan']);
    Route::get('/laporan/pengeluaran', [LaporanController::class, 'getTotalPengeluaran']);
    Route::get('/laporan/selisih', [LaporanController::class, 'getSelisih']);

    
});