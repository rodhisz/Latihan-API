<?php

use App\Http\Controllers\Web\ApiController;
use App\Http\Controllers\Web\DoaController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\WisataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/myapi', function () {
    return view('Api.myApi');
});

Route::get('/ictapi', function () {
    return view('ICT.ICT-Api');
});

Route::get('/publicapi', function () {
    return view('Public.Public-Api');
});

Route::get('/doa', [DoaController::class, 'doa'])->name('doa');

Route::get('/post-data', [LoginController::class, 'postData']);
Route::post('/posting', [LoginController::class, 'posting'])->name('posting');
Route::get('/kategori', [LoginController::class, 'kategori'])->name('kategori');
Route::post('/add-kategori', [LoginController::class, 'addKategori'])->name('addKategori');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/datalogin', [LoginController::class, 'dataLogin'])->name('logindata');

Route::get('/wisata', [WisataController::class, 'wisata'])->name('wisata');

Route::get('/registerapi', [ApiController::class, 'registerApi'])->name('registerapi');
Route::post('/daftarapi', [ApiController::class, 'daftarApi'])->name('daftarapi');
Route::get('/loginapi', [ApiController::class, 'loginApi'])->name('loginapi');
Route::post('/masukapi', [ApiController::class, 'masukApi'])->name('masukapi');
Route::get('/editapi/{user_id}', [ApiController::class, 'editApi'])->name('editapi');
Route::put('/edituserapi/{user_id}', [ApiController::class, 'editUserApi'])->name('edituserapi');


