<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\guru\DashboardGuruController;
use App\Http\Controllers\admin\DataGuruController;
use App\Http\Controllers\admin\GuruListController;
use App\Http\Controllers\admin\GuruGridController;
use App\Http\Controllers\admin\MataPelajaranController;
use App\Http\Controllers\admin\RuanganController;
use App\Http\Controllers\admin\JamBelajarController;
use App\Http\Controllers\admin\PenugasanController;
use App\Http\Controllers\admin\PenjadwalanController;
use App\Http\Controllers\admin\WaktuBelajarController;
use App\Http\Controllers\auth\LoginController;
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

Route::resource('/penjadwalan', PenjadwalanController::class);
route::POST('/penjadwalan/getIndividu', [PenjadwalanController::class, 'randIndividu'])->name('penjadwalan.randIndividu');
route::GET('/penjadwalan/fitness', [PenjadwalanController::class, 'evaluateFitness'])->name('penjadwalan.evaluateFitness');
Route::resource('/waktu-belajar', WaktuBelajarController::class);

Route::resource('/login', LoginController::class);
// Route::get('/guru-list', 'DataGuruController@guruList')->name('guru.list');
// Route::get('/guru/guru-list', [DataGuruController::class, 'guruList'])->name('guru.list');
