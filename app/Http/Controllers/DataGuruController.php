<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = DataGuru::all();
        return view('data-guru.index', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate image file
        $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // upload image
            $imageName = time() . '.' . $request->foto->extension(); //membuat nama file gambar dengan timestamp
            $path = 'public/guru/'; //path direktori penyimpanan file gambar
            $request->foto->move(public_path($path), $imageName); //menyimpan file gambar ke direktori public/images
        } else {
            // jika tidak ada foto yang diunggah, gunakan foto default
            $imageName = 'user.jpg';
        }


        DataGuru::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'foto' => $imageName,
        ]);

        return redirect()->route('guru-list.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataGuru $dataGuru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataGuru $guru)
    {
        $guru = DataGuru::find($guru->id);
        return view('data-guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataGuru $guru)
    {
        // validate image file
        $this->validate($request, [
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // upload image
            $imageName = time() . '.' . $request->foto->extension(); //membuat nama file gambar dengan timestamp
            $path = 'public/guru/'; //path direktori penyimpanan file gambar
            $request->foto->move(public_path($path), $imageName); //menyimpan file gambar ke direktori public/images
        } else {
            // jika tidak ada foto yang diunggah, gunakan foto default
            $imageName = 'user.jpg';
        }

        $guru->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'foto' => $imageName,
        ]);

        return redirect()->route('guru-list.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataGuru $guru)
    {
        $guru = DataGuru::find($guru->id);
        $guru->delete();
        return redirect()->route('guru-list.index');
    }
}
