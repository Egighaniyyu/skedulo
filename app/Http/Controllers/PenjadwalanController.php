<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use App\Models\Penugasan;
use App\Models\JamBelajar;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('penjadwalan.index');
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
    public function show(Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjadwalan $penjadwalan)
    {
        //
    }

    public function randIndividu(Request $request)
    {
        // generate individu
        $jum_idv = (int)$request->jum_individu;
        $penugasan = array();

        // slice individu
        $jum_jam = JamBelajar::all()->pluck('jumlah_jam')->toArray();
        $jum_kelas = Ruangan::all()->pluck('ruangan')->toArray();


        $data_mingguan = array();
        $data_kelas = array();
        $collect_data_kelas = array();
        $collect_data_individu = array();

        for ($i = 0; $i < $jum_idv; $i++) {
            // generate individu
            $penugasan[$i] = Penugasan::all()->shuffle()->toArray(); //216

            for ($j = 0; $j < count($jum_kelas); $j++) {
                // filter individu berdasarkan kelas
                $data_kelas[$j] = collect($penugasan[$i])->where('id_ruangan', $j + 1)->values()->all(); //24
                $gandakan[$j] = collect($data_kelas[$j])->flatMap(function ($item) {
                    return [$item, $item];
                })->all();

                // memasukan data mapel ke dalam mingguan
                for ($k = 0; $k < count($jum_jam); $k++) {
                    if ($k <= 0) {
                        $data_mingguan[$k] = array_slice($gandakan[$j], 0, $jum_jam[$k]);
                    } else {
                        $data_mingguan[$k] = array_slice($gandakan[$j], $jum_jam[$k] - 1, $jum_jam[$k]);
                    }
                }
                $collect_data_kelas[$j] = $data_mingguan;
            }
            $collect_data_individu[$i] = $collect_data_kelas;
        }
        dd($collect_data_individu);
    }
}
