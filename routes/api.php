<?php

use App\Http\Controllers\API\KelompokController;
use App\Http\Controllers\API\PlotingController;
use App\Http\Controllers\API\ProdiController;
use App\Http\Controllers\API\TempatMagangController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\CounselingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::get('/get-tempat-magang', [TempatMagangController::class, 'get']);
Route::get('/get-tempat-available', [TempatMagangController::class, 'getTempatMagangAvailable']);



Route::middleware('auth:sanctum')
    ->group(function () {
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
        // Post laporan magang
        Route::post('/post-laporan/{id}', [CounselingController::class, 'postLaporan']);
        Route::get('/jadwal-bimbingan/{id}', [CounselingController::class, 'getBimbingan']);
    });

//firebase
// Route::middleware('auth:sanctum')->post('/save-fcm-token', function (Request $request) {
//     $user = auth()->user();
//     $user->fcm_token = $request->fcm_token;
//     $user->save();

//     return response()->json(['message' => 'Token FCM disimpan']);
// });

Route::middleware('auth:sanctum')->post('/save-fcm-token', function (Request $request) {
    $user = auth()->user();

    if (!$user instanceof User) {
        return response()->json(['message' => 'User tidak valid'], 401);
    }

    $user->fcm_token = $request->fcm_token;
    $user->save();

    return response()->json(['message' => 'Token FCM disimpan']);
});