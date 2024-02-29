<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TahapanController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Queue\Monitor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profile', [UserController::class, 'profile']);

    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::post('/pegawai/store-data', [PegawaiController::class, 'store']);
    Route::get('/pegawai/edit-data', [PegawaiController::class, 'edit']);
    Route::post('/pegawai/update-data', [PegawaiController::class, 'update']);
    Route::post('/pegawai/delete-data', [PegawaiController::class, 'delete']);

    Route::get('/tahapan', [TahapanController::class, 'index']);
    Route::get('/tahapan/edit-data', [TahapanController::class, 'edit']);
    Route::post('/tahapan/update-data', [TahapanController::class, 'update']);

    Route::get('/jenis-layanan', [JenisLayananController::class, 'index']);
    Route::post('/jenis-layanan/store-data', [JenisLayananController::class, 'store']);
    Route::get('/jenis-layanan/edit-data', [JenisLayananController::class, 'edit']);
    Route::post('/jenis-layanan/update-data', [JenisLayananController::class, 'update']);
    Route::post('/jenis-layanan/delete-data', [JenisLayananController::class, 'delete']);

    Route::get('/pasien', [PasienController::class, 'index']);
    Route::post('/pasien/store-data', [PasienController::class, 'store']);
    Route::get('/pasien/edit-data', [PasienController::class, 'edit']);
    Route::get('/pasien/edit-layanan', [PasienController::class, 'editLayanan']);
    Route::post('/pasien/update-data', [PasienController::class, 'update']);
    Route::post('/pasien/delete-data', [PasienController::class, 'delete']);
    Route::post('/pasien/update-status-layanan', [LayananController::class, 'updateLayanan']);

    Route::get('/monitor', [MonitorController::class, 'index']);
    Route::get('/monitor/load-data', [MonitorController::class, 'loadData']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-check', [AuthController::class, 'loginCheck']);
});
