<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\DataGuruController;
use App\Http\Controllers\GuruListController;
use App\Http\Controllers\GuruGridController;
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
// Route::get('/guru-list', 'DataGuruController@guruList')->name('guru.list');
// Route::get('/guru/guru-list', [DataGuruController::class, 'guruList'])->name('guru.list');
