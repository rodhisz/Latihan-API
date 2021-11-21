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

//Auth
Route::post('/registrasi', [AuthController::class, 'registrasi']);
Route::post('/daftar', [AuthController::class, 'daftar']);
Route::post('/login', [AuthController::class, 'login']);
Route::put('/edit/{user_id}', [AuthController::class, 'editProfile']);
Route::put('/editpassword/{id}', [AuthController::class, 'editPassword']);
Route::get('/getuser/{user_id}', [AuthController::class, 'getUser']);
Route::get('/alluser', [AuthController::class, 'getAllUser']);


//CRUD Resto dan Menu nya
Route::post('/add/resto-dan-menu', [RestoranController::class, 'createRestoMenu']);
Route::get('/resto/{id}', [RestoranController::class, 'getRestoMenu']);

//Get semua menu
Route::get('/allmenu', [RestoranController::class, 'getAllMenu']);

//Edit Resto
Route::put('/editresto/{id}', [RestoranController::class, 'editResto']);

//Searching Menu
Route::get('/search', [RestoranController::class, 'searchMenu']);

//Delete Menu
Route::delete('/delete/menu/{resto_id}/{menu_id}', [RestoranController::class, 'deleteMenu']);

//Bikin 1 Menu ke resto
Route::post('/add/menu/{resto_id}', [RestoranController::class, 'createMenu']);

//Edit 1 menu di resto
Route::put('/edit/menu/{resto_id}/{menu_id}', [RestoranController::class, 'editMenu']);

//edit banyak menu di resto
Route::put('/update/restomenu/{resto_id}', [RestoranController::class, 'updateRestoMenu']);

//Get semua menu
Route::get('/allresto', [RestoranController::class, 'getAllResto']);


