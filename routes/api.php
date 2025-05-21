<?php

use App\Http\Controllers\API\KelompokController;
use App\Http\Controllers\API\PlotingController;
use App\Http\Controllers\API\ProdiController;
use App\Http\Controllers\API\TempatMagangController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\CounselingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [UsersController::class, 'register']);
Route::get('/get-prodi', [ProdiController::class, 'get']);
Route::post('/lupa-password', [UsersController::class, 'lupaPassword']);
Route::post('/cek-otp', [UsersController::class, 'cekOTP']);
Route::post('/reset-password', [UsersController::class, 'resetPassword']);

Route::get('/jadwal-bimbingan', [CounselingController::class, 'getBimbingan']);
// Post laporan magang
Route::post('/laporan/{id}', [CounselingController::class, 'postLaporan']);

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/get-tempat-magang', [TempatMagangController::class, 'get']);
        Route::get('/get-area', [PlotingController::class, 'getArea']);
        Route::get('/get-list-dospem', [PlotingController::class, 'getDosenByArea']);
        Route::post('/get-kelompok', [KelompokController::class, 'getKelompokById']);
        Route::get('/get-dosen', [PlotingController::class, 'getDosen']);
        Route::get('/get-alur-magang', [KelompokController::class, 'cekStatus']);
        Route::post('/get-user', [UsersController::class, 'dataUserById']);
        Route::post('/update-user', [UsersController::class, 'updateUser']);
        Route::post('/create-kelompok', [KelompokController::class, 'createKelompok']);
        Route::post('/update-kelompok', [KelompokController::class, 'updateKelompok']);
        Route::post('/insert-tempat-magang/{id}', [KelompokController::class, 'insertTempatMagang']);
        Route::post('/upload-proposal/{id}', [KelompokController::class, 'uploadProposal']);
        Route::post('/upload-surat-balasan/{id}', [KelompokController::class, 'uploadSuratBalasan']);
        Route::post('/insert-dospem/{id}', [KelompokController::class, 'insertDospem']);
        Route::post('/insert-tempat-magang-by-id/{id}', [KelompokController::class, 'insertTempatMagangById']);
        Route::post('/download-surat-pengantar', [KelompokController::class, 'downloadSuratPengantar']);
    });