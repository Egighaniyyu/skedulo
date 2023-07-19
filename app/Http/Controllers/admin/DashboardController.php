<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\DataGuru;
use App\Models\Penjadwalan;
use App\Models\Penugasan;
use App\Models\JamBelajar;
use App\Models\MataPelajaran;
use App\Models\Ruangan;
use App\Models\WaktuBelajar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_guru = DataGuru::count();
        $data_kelas = Ruangan::count();
        $data_mapel = MataPelajaran::count();
        $data_hari = JamBelajar::count();
        return view('admin.dashboard.index', compact('data_guru', 'data_kelas', 'data_mapel', 'data_hari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
