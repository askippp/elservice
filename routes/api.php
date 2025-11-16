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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestSparepartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('merek', MerekController::class);
    Route::apiResource('kategori', KategoriController::class);
    Route::apiResource('alat', AlatController::class);
    Route::apiResource('sparepart', SparepartController::class);
    Route::apiResource('cabang', CabangController::class);
    Route::apiResource('operator', OperatorController::class);
    Route::apiResource('teknisi', TeknisiController::class);

    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::patch('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    Route::get('/laporan/pemasukan', [LaporanController::class, 'getTotalPemasukan']);
    Route::get('/laporan/pengeluaran', [LaporanController::class, 'getTotalPengeluaran']);
    Route::get('/laporan/selisih', [LaporanController::class, 'getSelisih']);

    Route::get('/sparepart/request/admin/{id_admin}', [RequestSparepartController::class, 'getRequestSparepartFromOperator']);
    Route::patch('/sparepart/request/{id_request}/approve', [RequestSparepartController::class, 'approveRequestSparepart']);
    Route::patch('/sparepart/request/{id_request}/reject', [RequestSparepartController::class, 'rejectRequestSparepart']);

    Route::get('/admin/dashboard/service-summary', [DashboardController::class, 'serviceSummary']);
});

Route::middleware(['auth:sanctum', 'role:operator'])->group(function () {
    Route::get('/sparepart/request/incoming/{id_operator}', [RequestSparepartController::class, 'getRequestSparepartFromTechnician']);
    Route::patch('/sparepart/request/{id_request}/operator', [RequestSparepartController::class, 'setRequestSparepartToAdmin']);
    Route::get('/sparepart/request/operator/{id_operator}', [RequestSparepartController::class, 'getRequestByOperator']);

    Route::get('/operator/dashboard/service-summary', [DashboardController::class, 'serviceSummary']);

    Route::get('/service/operator/list', [ServiceController::class, 'operatorList']);
    Route::patch('/service/{id_service}/decision', [ServiceController::class, 'operatorDecision']);
    Route::patch('/service/{id_service}/total', [ServiceController::class, 'operatorCalculateTotal']);
});

Route::middleware(['auth:sanctum', 'role:teknisi'])->group(function () {
    Route::post('/sparepart/request/technician', [RequestSparepartController::class, 'setRequestSparepartToOperator']);
    Route::get('/sparepart/request/technician/{id_teknisi}', [RequestSparepartController::class, 'getRequestByTechnician']);

    Route::get('/service/technician/list', [ServiceController::class, 'technicianList']);
    Route::patch('/service/{id_service}/diagnose', [ServiceController::class, 'technicianDiagnose']);
});

Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    Route::post('/service/customer/request', [ServiceController::class, 'customerRequest']);
    Route::post('/service/{id_service}/pay', [ServiceController::class, 'customerPay']);
});