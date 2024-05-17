<?php

use App\Http\Controllers\API\KelompokController;
use App\Http\Controllers\API\PlotingController;
use App\Http\Controllers\API\ProdiController;
use App\Http\Controllers\API\UsersController;
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

Route::middleware('auth:sanctum')
    ->group(function (){
        Route::get('/get-area', [PlotingController::class, 'getArea']);
        Route::get('/get-list-dospem', [PlotingController::class, 'getDosenByArea']);
        Route::post('/create-kelompok', [KelompokController::class, 'createKelompok']);
    });