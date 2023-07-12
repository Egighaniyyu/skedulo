<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Penugasan;
use App\Models\DataGuru;
use App\Models\MataPelajaran;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penugasan = Penugasan::all();
        $guru = DataGuru::all();
        $mapel = MataPelajaran::all();
        $ruangan = Ruangan::all();
        return view('admin.penugasan.index', compact('guru', 'mapel', 'ruangan', 'penugasan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = DataGuru::all();
        $mapel = MataPelajaran::all();
        $ruangan = Ruangan::all();
        return view('admin.penugasan.create', compact('guru', 'mapel', 'ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Penugasan::create([
            'id_guru' => $request->id_guru,
            'id_mapel' => $request->id_mapel,
            'id_ruangan' => $request->id_ruangan,
            'porsi_jam' => $request->porsi_jam,
        ]);

        return redirect()->route('penugasan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penugasan $penugasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penugasan $penugasan)
    {
        $penugasan = Penugasan::find($penugasan->id);
        $guru = DataGuru::all();
        $mapel = MataPelajaran::all();
        $ruangan = Ruangan::all();
        return view('admin.penugasan.edit', compact('penugasan', 'guru', 'mapel', 'ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penugasan $penugasan)
    {
        $penugasan->update([
            'id_guru' => $request->id_guru,
            'id_mapel' => $request->id_mapel,
            'id_ruangan' => $request->id_ruangan,
            'porsi_jam' => $request->porsi_jam,
        ]);

        return redirect()->route('penugasan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penugasan $penugasan)
    {
        $penugasan = Penugasan::find($penugasan->id);
        $penugasan->delete();
        return redirect()->route('penugasan.index');
    }
}
