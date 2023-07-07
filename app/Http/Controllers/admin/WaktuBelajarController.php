<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WaktuBelajar;
use App\Models\JamBelajar;
use Illuminate\Http\Request;

class WaktuBelajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waktuBelajar = WaktuBelajar::all();
        $jamBelajar = JamBelajar::all();
        return view('admin.waktu-belajar.index', compact('waktuBelajar', 'jamBelajar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $waktuBelajar = WaktuBelajar::all();
        $jamBelajar = JamBelajar::all();
        return view('admin.waktu-belajar.create', compact('jamBelajar', 'waktuBelajar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        WaktuBelajar::create([
            'id_hari' => $request->id_hari,
            'jam' => $request->waktu_belajar,
        ]);
        return redirect()->route('waktu-belajar.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(WaktuBelajar $waktuBelajar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaktuBelajar $waktuBelajar)
    {
        $waktuBelajar = WaktuBelajar::find($waktuBelajar->id);
        $jamBelajar = JamBelajar::all();
        return view('admin.waktu-belajar.edit', compact('waktuBelajar', 'jamBelajar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaktuBelajar $waktuBelajar)
    {
        $waktuBelajar->update([
            'id_hari' => $request->id_hari,
            'jam' => $request->waktu_belajar,
        ]);
        return redirect()->route('waktu-belajar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaktuBelajar $waktuBelajar)
    {
        $waktuBelajar = WaktuBelajar::find($waktuBelajar->id);
        $waktuBelajar->delete();
        return redirect()->route('waktu-belajar.index');
    }
}
