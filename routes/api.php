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

    Route::get('/sparepart/request/admin/{id_admin}', [RequestSparepartController::class, 'getRequestSparepartFromOperator']);
    Route::post('/sparepart/request/{id_request}/approve', [RequestSparepartController::class, 'approveRequestSparepart']);
    Route::post('/sparepart/request/{id_request}/reject', [RequestSparepartController::class, 'rejectRequestSparepart']);
});

Route::middleware('auth:sanctum', 'operator')->group(function () {
    Route::get('/sparepart/request/operator/{id_operator}', [RequestSparepartController::class, 'getRequestSparepartFromTechnician']);
    Route::post('/sparepart/request/operator-to-admin', [RequestSparepartController::class, 'setRequestSparepartToAdmin']);
    Route::get('/sparepart/request/operator/{id_operator}', [RequestSparepartController::class, 'getRequestByOperator']);
});

Route::middleware('auth:sanctum', 'teknisi')->group(function () {
    Route::post('/sparepart/request/technician', [RequestSparepartController::class, 'setRequestSparepartForOperator']);
    Route::get('/sparepart/request/technician/{id_teknisi}', [RequestSparepartController::class, 'getRequestByTechnician']);
});