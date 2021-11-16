<?php

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


Route::get('/doa', [DoaController::class, 'doa'])->name('doa');

Route::get('/post-data', [DoaController::class, 'postData']);
Route::post('/posting', [DoaController::class, 'posting'])->name('posting');
Route::get('/kategori', [DoaController::class, 'kategori'])->name('kategori');
Route::post('/add-kategori', [DoaController::class, 'addKategori'])->name('addKategori');

Route::get('/wisata', [WisataController::class, 'wisata'])->name('wisata');

Route::get('/login', [LoginController::class, 'login'])->name('data');
Route::post('/datalogin', [LoginController::class, 'dataLogin'])->name('data');


