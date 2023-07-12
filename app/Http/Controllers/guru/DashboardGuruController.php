<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use App\Models\DashboardGuru;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Penjadwalan::where('id_guru', auth()->user()->id)->get();
        return view('guru.dashboard-guru.index', compact('jadwal'));
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
    public function show(DashboardGuru $dashboardGuru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DashboardGuru $dashboardGuru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DashboardGuru $dashboardGuru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DashboardGuru $dashboardGuru)
    {
        //
    }
}
