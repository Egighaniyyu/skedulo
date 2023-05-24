<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use App\Models\Penugasan;
use App\Models\JamBelajar;
use App\Models\Ruangan;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

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
        //* generate individu
        $jum_idv = (int)$request->jum_individu;
        $penugasan = array();

        // slice individu
        $jum_jam = JamBelajar::all()->pluck('jumlah_jam')->toArray();
        $jum_kelas = Ruangan::all()->pluck('ruangan')->toArray();

        $data_kelas = array();
        $collect_data_mapel = array();
        $collect_data_guru = array();
        $collect_data_individu = array();
        $counted_mapel = array();
        $filtered_mapel = array();
        $duplicate_mapel = array();
        $double_mapel = 0;
        $collect_double_mapel = array();

        $data_guru = array();
        $collection_guru = array();
        $array_guru = array();
        $col_guru = array();
        $col_kelas = array();
        $fitness_guru = array();
        $counted_guru = array();
        $filtered_guru = array();
        $collect_clash_guru = array();
        $clash_guru = 0;

        for ($i = 0; $i < $jum_idv; $i++) {
            // generate individu
            $penugasan[$i] = Penugasan::all()->shuffle()->toArray(); //216
            $flattenpenugasan[$i] = collect($penugasan[$i])->pluck('id')->flatten(1)->toArray();

            for ($j = 0; $j < count($jum_kelas); $j++) {
                // filter individu berdasarkan kelas
                $data_kelas[$j] = collect($penugasan[$i])->where('id_ruangan', $j + 1)->values()->all(); //24
                $gandakan_guru[$j] = collect($data_kelas[$j])->pluck('id_guru')->flatMap(function ($item) {
                    return [$item, $item];
                })->all();
                $gandakan_mapel[$j] = collect($data_kelas[$j])->pluck('id_mapel')->flatMap(function ($item) {
                    return [$item, $item];
                })->all();
                $data_guru[$j] = collect($data_kelas[$j])->pluck('id_guru')->all();

                // memasukan data mapel ke dalam mingguan
                for ($k = 0; $k < count($jum_jam); $k++) {
                    if ($k <= 0) {
                        $data_mingguan_mapel[$k] = array_slice($gandakan_mapel[$j], 0, $jum_jam[$k]);
                        $data_mingguan_guru[$k] = array_slice($gandakan_guru[$j], 0, $jum_jam[$k]);

                        // filter data mapel yang sama dalam 1 hari
                        $counted_mapel[$k] = array_count_values($data_mingguan_mapel[$k]);
                        $filtered_mapel[$k] = array_filter($counted_mapel[$k], function ($value) {
                            return $value > 3;
                        });

                        if (!empty($filtered_mapel[$k])) {
                            $double_mapel += 1;
                            // $duplicate_mapel[$k] = [$double_mapel];
                        }
                    } else {
                        $data_mingguan_mapel[$k] = array_slice($gandakan_mapel[$j], $jum_jam[$k], $jum_jam[$k]);
                        $data_mingguan_guru[$k] = array_slice($gandakan_guru[$j], $jum_jam[$k], $jum_jam[$k]);

                        // filter data mapel yang sama dalam 1 hari
                        $counted_mapel[$k] = array_count_values($data_mingguan_mapel[$k]);
                        $filtered_mapel[$k] = array_filter($counted_mapel[$k], function ($value) {
                            return $value > 3;
                        });

                        if (!empty($filtered_mapel[$k])) {
                            $double_mapel += 1;
                            // $duplicate_mapel[$k] = [$double_mapel];
                        }
                    }
                    // $double_mapel = 0;
                }
                $collect_data_mapel[$j] = $data_mingguan_mapel;
                $collect_data_guru[$j] = $data_mingguan_guru;
                $collection_guru[$j] = collect($data_guru[$j])->flatten()->toArray();
                $duplicate_mapel[$j] = $double_mapel;
            }
            $collect_data_individu[$i] = $collect_data_guru;
            $collect_double_mapel[$i] = $double_mapel;
            $fitness_guru[$i] = $collection_guru;
        }
        //* end generate individu

        //* hitung fitness
        for ($k = 0; $k < $jum_idv; $k++) {
            for ($l = 0; $l <= (count($data_guru[$k]) - 1); $l++) {
                for ($m = 0; $m <= (count($jum_kelas) - 1); $m++) {
                    $col_guru[$m] = collect($array_guru);
                    $col_guru[$m]->push($fitness_guru[$k][$m][$l]);
                }
                $col_kelas[$l] = collect($col_guru)->flatten()->toArray();

                // filter data mapel yang sama dalam 1 hari
                $counted_guru[$l] = array_count_values($col_kelas[$l]);
                $filtered_guru[$l] = array_filter($counted_guru[$l], function ($value) {
                    return $value > 2;
                });

                if (!empty($filtered_guru[$l])) {
                    $clash_guru += 1;
                    // $duplicate_guru[$l] = [$clash_guru];
                }
            }
            // $fitness_idv[$k] = $col_kelas; // buat dapet data guru mengajar per jam belajar
            $collect_clash_guru[$k] = $clash_guru;
            $clash_guru = 0;
        }
        //* end hitung fitness

        // dd($fitness_idv);
        return $collect_clash_guru;
    }
}
