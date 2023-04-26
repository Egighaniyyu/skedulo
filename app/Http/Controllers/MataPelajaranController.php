<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = MataPelajaran::all();
        return view('mata-pelajaran.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mata-pelajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        MataPelajaran::create([
            'mapel' => $request->mapel,
        ]);

        return redirect()->route('mapel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataPelajaran $mapel)
    {
        $mapel = MataPelajaran::find($mapel->id);
        return view('mata-pelajaran.edit', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataPelajaran $mapel)
    {
        $mapel->update([
            'mapel' => $request->mapel,
        ]);

        return redirect()->route('mapel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataPelajaran $mapel)
    {
        $mapel = MataPelajaran::find($mapel->id);
        $mapel->delete();
        return redirect()->route('mapel.index');
    }
}
