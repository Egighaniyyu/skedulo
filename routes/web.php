<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\GuruListController;
use App\Http\Controllers\GuruGridController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\JamBelajarController;
use App\Http\Controllers\PenugasanController;
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

// Route::get('/', function () {
//     return view('layouts/master');
// });

Route::resource('/', DashboardController::class);
Route::resource('/guru', DataGuruController::class);
Route::resource('/guru-list', GuruListController::class);
Route::resource('/guru-grid', GuruGridController::class);
Route::resource('/mapel', MataPelajaranController::class);
Route::resource('/ruangan', RuanganController::class);
Route::resource('/jam-belajar', JamBelajarController::class);
Route::resource('/penugasan', PenugasanController::class);
// Route::get('/guru-list', 'DataGuruController@guruList')->name('guru.list');
// Route::get('/guru/guru-list', [DataGuruController::class, 'guruList'])->name('guru.list');
