<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JamBelajar;
use Illuminate\Http\Request;

class JamBelajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jambelajar = JamBelajar::all();
        return view('admin.jam-belajar.index', compact('jambelajar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jam-belajar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JamBelajar::create([
            'hari' => $request->hari,
            'jumlah_jam' => $request->jumlah_jam,
        ]);
        return redirect()->route('jam-belajar.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(JamBelajar $jamBelajar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JamBelajar $jamBelajar)
    {
        $jamBelajar = JamBelajar::find($jamBelajar->id);
        // dd($jamBelajar);
        return view('admin.jam-belajar.edit', compact('jamBelajar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JamBelajar $jamBelajar)
    {
        $jamBelajar->update([
            'hari' => $request->hari,
            'jumlah_jam' => $request->jumlah_jam,
        ]);
        return redirect()->route('jam-belajar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JamBelajar $jamBelajar)
    {
        $jamBelajar = JamBelajar::find($jamBelajar->id);
        $jamBelajar->delete();
        return redirect()->route('jam-belajar.index');
    }
}
