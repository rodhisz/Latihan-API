<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RestoranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/registrasi', [AuthController::class, 'daftar']);
Route::post('login', [AuthController::class, 'login']);

//-->CRUD Resto dan Menu nya<--
Route::post('/add/resto-dan-menu', [RestoranController::class, 'createRestoMenu']);



