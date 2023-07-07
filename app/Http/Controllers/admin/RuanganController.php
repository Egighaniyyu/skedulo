<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('admin.ruangan.index', compact('ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Ruangan::create([
            'ruangan' => $request->ruangan,
        ]);

        return redirect()->route('ruangan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        $ruangan = Ruangan::find($ruangan->id);
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $ruangan->update([
            'ruangan' => $request->ruangan,
        ]);

        return redirect()->route('ruangan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan = Ruangan::find($ruangan->id);
        $ruangan->delete();
        return redirect()->route('ruangan.index');
    }
}
