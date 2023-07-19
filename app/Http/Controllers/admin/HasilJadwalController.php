<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Penjadwalan;
use App\Models\WaktuBelajar;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Files\LocalTemporaryFile;

class HasilJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjadwalan = Penjadwalan::all();
        $waktu_belajar = WaktuBelajar::all();
        return view('admin.penjadwalan.hasil', compact('penjadwalan', 'waktu_belajar'));
    }

    public function export()
    {
        return Excel::download(new PenjadwalanExport, 'data_penjadwalan.xlsx');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

class PenjadwalanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // return Penjadwalan::select('id', 'id_penugasan', 'id_guru', 'id_mapel', 'id_ruangan', 'id_hari')->get();
        return Penjadwalan::with(['guru', 'mapel', 'ruangan', 'waktu'])->get()->map(function ($penjadwalan) {
            return [
                'id' => $penjadwalan->id,
                'nama_guru' => $penjadwalan->guru->nama,
                'nama_mapel' => $penjadwalan->mapel->mapel,
                'nama_kelas' => $penjadwalan->ruangan->ruangan,
                'hari' => $penjadwalan->waktu->hari->hari,
                'jam' => $penjadwalan->waktu->jam,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Nama Guru', 'Mata Pelajaran', 'Kelas', 'Hari', 'Waktu'];
    }
}






