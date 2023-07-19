<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\guru\{
    DashboardGuruController as GuruDashboardGuruController,
};

use App\Http\Controllers\admin\{
    DashboardController as AdminDashboardController,
    DataGuruController as AdminDataGuruController,
    GuruListController as AdminGuruListController,
    GuruGridController as AdminGuruGridController,
    MataPelajaranController as AdminMataPelajaranController,
    RuanganController as AdminRuanganController,
    JamBelajarController as AdminJamBelajarController,
    PenugasanController as AdminPenugasanController,
    PenjadwalanController as AdminPenjadwalanController,
    WaktuBelajarController as AdminWaktuBelajarController,
    HasilJadwalController as AdminHasilJadwalController
};
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth']], function () {
    Route::resource('/dashboards', AdminDashboardController::class);
    Route::resource('/guru', AdminDataGuruController::class);
    Route::resource('/guru-list', AdminGuruListController::class);
    Route::resource('/guru-grid', AdminGuruGridController::class);
    Route::resource('/mapel', AdminMataPelajaranController::class);
    Route::resource('/ruangan', AdminRuanganController::class);
    Route::resource('/kegiatan/jam-belajar', AdminJamBelajarController::class);
    Route::resource('/penugasan', AdminPenugasanController::class);

    Route::resource('/penjadwalan', AdminPenjadwalanController::class);
    route::POST('/penjadwalan/getIndividu', [AdminPenjadwalanController::class, 'randIndividu'])->name('penjadwalan.randIndividu');
    route::GET('/penjadwalan/fitness', [AdminPenjadwalanController::class, 'evaluateFitness'])->name('penjadwalan.evaluateFitness');
    Route::resource('/kegiatan/waktu-belajar', AdminWaktuBelajarController::class);
    route::GET('/export', [AdminHasilJadwalController::class, 'export'])->name('export');
    Route::resource('/hasil-jadwal', AdminHasilJadwalController::class);
});

Route::group(['prefix' => 'guru', 'middleware' => ['isGuru', 'auth']], function () {
    Route::resource('/dashboard', GuruDashboardGuruController::class);
});
