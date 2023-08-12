<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JamBelajar;
use App\Models\Penjadwalan;
use App\Models\Penugasan;
use App\Models\Ruangan;
use App\Models\WaktuBelajar;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.penjadwalan.index');
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
        if ($request->jum_individu == null && $request->max_generasi == null) {
            toastr()->error('Jumlah individu dan generasi tidak boleh kosong!');
            return redirect()->route('penjadwalan.index');
        } elseif ($request->max_generasi == null) {
            toastr()->error('Jumlah generasi tidak boleh kosong!');
            return redirect()->route('penjadwalan.index');
        } elseif ($request->jum_individu == null) {
            toastr()->error('Jumlah individu tidak boleh kosong!');
            return redirect()->route('penjadwalan.index');
        }

        //* generate individu
        $jum_idv = $request->jum_individu;
        $max_gen = $request->max_generasi;
        $penugasan = array();
        $loop = 1;

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
        $individu_mutasi = array();
        $parent_cr = array();
        $result = array();

        do {

            if ($loop == 1) {
                for ($i = 0; $i < $jum_idv; $i++) {
                    // generate individu
                    // $penugasan[$i] = Penugasan::all()->shuffle()->toArray(); //216
                    $penugasan[$i] = collect(Penugasan::all())->pluck('id')->toArray(); //216
                    // dd($penugasan[$i]);

//                     $array = [1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6];

// // Mengelompokkan nilai-nilai ganda
//                     $groupedValues = [];
//                     foreach ($array as $value) {
//                         if (!isset($groupedValues[$value])) {
//                             $groupedValues[$value] = [];
//                         }
//                         $groupedValues[$value][] = $value;
//                     }

// // Nilai yang posisinya telah ditentukan
//                     $specifiedValues = [
//                         ['value' => 4, 'indexes' => [2, 3]],
//                         ['value' => 5, 'indexes' => [6, 7]],
//                     ];

// // Mengacak posisi nilai yang belum ditentukan
//                     $remainingValues = array_diff($array, array_column($specifiedValues, 'value'));
//                     shuffle($remainingValues);

// // Menggabungkan nilai yang telah ditentukan dan nilai yang diacak
//                     $result = [];
//                     foreach ($specifiedValues as $specified) {
//                         $value = $specified['value'];
//                         foreach ($specified['indexes'] as $index) {
//                             $result[$index] = array_shift($groupedValues[$value]);
//                         }
//                     }
//                     $remainingIndex = 0;
//                     for ($i = 0; $i < count($array); $i++) {
//                         if (!isset($result[$i])) {
//                             $result[$i] = $remainingValues[$remainingIndex];
//                             $remainingIndex++;
//                         }
//                     }

//                     ksort($result);

// // Hasil akhir
//                     $finalArray = array_values($result);

//                     dd($finalArray);

                    // $array_ummi = [205, 205, 206, 206, 207, 207, 208, 208, 209, 209, 210, 210, 211, 211, 212, 212, 213, 213, 214, 214, 215, 215, 216, 216, 133, 133, 134, 134, 135, 135, 136, 136, 137, 137, 138, 138, 139, 139, 140, 140, 141, 141, 142, 142, 143, 143, 144, 144, 61, 61, 62, 62, 63, 63, 64, 64, 65, 65, 66, 66, 67, 67, 68, 68, 69, 69, 70, 70, 71, 71, 72, 72];

                    // $array_index_ummi = [4, 5, 12, 13, 21, 22, 37, 38, 52, 53, 60, 61, 69, 70, 85, 86, 100, 101, 108, 109, 117, 118, 133, 134, 154, 155, 169, 170, 179, 180, 186, 187, 202, 203, 217, 218, 227, 228, 234, 235, 250, 251, 265, 266, 275, 276, 282, 283, 302, 303, 311, 312, 319, 320, 332, 333, 350, 351, 359, 360, 367, 368, 380, 381, 398, 399, 407, 408, 415, 416, 428, 429];

                    // $gandakan_penugasan = collect($penugasan[$i])->flatMap(function ($item) {
                    //     return [$item, $item];
                    // })->all();

                    // dd($gandakan_penugasan);

                    $array_ummi = [
                        205, 206, 207, 208, 209, 210, 211, 212, 213, 214, 215, 216, 133, 134, 135, 136, 137, 138, 139, 140, 141, 142, 143, 144, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72,
                    ];

                    // $array_index_ummi = [
                    //     4, 12, 21, 37, 52, 60, 69, 85, 100, 108,
                    //     117, 133, 154, 169, 179, 186, 202, 217, 227, 234,
                    //     250, 265, 275, 282, 302, 311, 319, 332, 350, 359,
                    //     367, 380, 398, 407, 415, 428,
                    // ];

                    $array_index_ummi = [
                        2, 6, 11, 19, 26, 30, 35, 43, 50, 54, 59, 67, 77, 85, 90, 93, 101, 109, 114, 117, 125, 133, 138, 141, 151, 156, 160, 166, 175, 180, 184, 190, 199, 204, 208, 214,
                    ];

                    // dd(count($array_index_ummi));

                    // Nilai yang posisinya ingin ditentukan
                    $specifiedValues = [];

                    for ($j = 0; $j < count($array_index_ummi); $j++) {
                        $specifiedValues[$array_index_ummi[$j]] = $array_ummi[$j];
                    }

                    // dd($specifiedValues);

                    // Array awal
                    // $array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// Nilai yang posisinya ingin ditentukan
                    // $specifiedValues = [
                    //     2 => 4,
                    //     5 => 7,
                    //     9 => 6,
                    // ];

// Pisahkan nilai yang sudah ditentukan posisinya dari array asli
                    $specifiedItems = array_values(array_intersect_key($penugasan[$i], $specifiedValues));
                    // dd($specifiedItems);

// Hapus nilai yang sudah ditentukan posisinya dari array asli
                    $penugasan[$i] = array_diff($penugasan[$i], $specifiedItems);
                    // dd($gandakan_penugasan);

// Mengacak posisi nilai yang tersisa
                    shuffle($penugasan[$i]);

// Masukkan kembali nilai yang sudah ditentukan posisinya ke dalam array pada posisi yang diinginkan
                    foreach ($specifiedValues as $index => $value) {
                        array_splice($penugasan[$i], $index, 0, $value);
                    }

// Memastikan array hasil memiliki panjang yang sama dengan array awal
                    while (count($penugasan[$i]) < count($penugasan[$i]) + count($specifiedValues) - count($specifiedItems)) {
                        $penugasan[$i][] = end($penugasan[$i]) + 1;
                    }
                    // dd($penugasan[$i]);

                    // $penugasan = [2, 9, 4, 1, 4, 7, 10, 6, 3, 6];
                    $length = count($penugasan[$i]);

                    // $exceptions = [];

                    // for ($i = 0; $i < count($array_index_ummi); $i++) {
                    //     $exceptions[$array_ummi[$i]] = $array_index_ummi[$i];
                    // }

                    // dd($exceptions);

                    // $exceptions = [
                    //     2 => 4,
                    //     9 => 6,
                    //     5 => 7,
                    // ];

                    $usedValues = array_values($specifiedValues);

                    $newValues = [];

                    for ($i = 1; $i <= $length; $i++) {
                        if (!in_array($i, $penugasan) && !in_array($i, $usedValues)) {
                            $newValues[] = $i;
                        }
                    }

                    $replacementIndex = 0;

                    foreach ($penugasan as $index => &$value) {
                        if (array_key_exists($index, $specifiedValues)) {
                            if ($value == $specifiedValues[$index]) {
                                continue;
                            }
                        }

                        if (in_array($value, $usedValues)) {
                            $value = $newValues[$replacementIndex];
                            $replacementIndex++;
                        }
                    }
                    $penugasan[$i] = collect($penugasan)->flatten()->toArray();

                    // return $array;
                }
                dd($penugasan);
            } else if ($loop > 1) {
                $arrayList = array();
                $penugasan = array();
                for ($i = 0; $i < $jum_idv; $i++) {
                    // generate individu
                    $arrayList[$i] = $parent_cr[$i]; //216
                }

                for ($i = 0; $i < $jum_idv; $i++) {
                    // generate individu
                    $arraySample[$i] = Penugasan::all()->toArray(); //216
                }

                for ($i = 0; $i < count($arraySample); $i++) {
                    $array_id = $arrayList[$i];
                    $array_urutan = array();

                    foreach ($array_id as $id) {
                        foreach ($arraySample[$i] as $obj) {
                            if ($obj["id"] == $id) {
                                $array_urutan[] = $obj;
                                break;
                            }
                        }
                    }

                    $penugasan[$i] = $array_urutan;
                }
            }

            //* generate individu
            for ($i = 0; $i < $jum_idv; $i++) {
                // $penugasan[$i] = Penugasan::all()->shuffle()->toArray(); //216

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
                                return $value > 2;
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
                                return $value > 2;
                            });

                            if (!empty($filtered_mapel[$k])) {
                                $double_mapel += 1;
                                // $duplicate_mapel[$k] = [$double_mapel];
                            }
                        }
                    }
                    $collect_data_mapel[$j] = $data_mingguan_mapel;
                    $collect_data_guru[$j] = $data_mingguan_guru;
                    $collection_guru[$j] = $data_guru[$j];
                    $duplicate_mapel[$j] = $double_mapel;
                }
                $collect_data_individu[$i] = $collect_data_guru;
                $collect_double_mapel[$i] = $double_mapel;
                $fitness_guru[$i] = $collection_guru;
                $double_mapel = 0;
            }
            // dd($fitness_guru);
            // dd($fitness_guru);
            // dd(count($data_guru[0]));
            //* end generate individu

            //* hitung fitness
            // if ($loop == 2) {
            //     dd($flattenpenugasan);
            // }
            $total_clash_guru = 0;
            for ($k = 0; $k < $jum_idv; $k++) {
                for ($l = 0; $l < (count($data_guru[0])); $l++) {
                    for ($m = 0; $m < (count($jum_kelas)); $m++) {
                        $col_guru[$m] = collect($array_guru);
                        $col_guru[$m]->push($fitness_guru[$k][$m][$l]); // Error pada $l
                    }
                    // dd($col_guru);
                    $col_kelas[$l] = collect($col_guru)->flatten()->toArray();

                    $counted_guru[$l] = collect($col_kelas[$l])->countBy();
                    // dd($counted_guru[$l]);
                    $filtered_guru[$l] = $counted_guru[$l]->filter(function ($value) {
                        return $value > 1;
                    })->keys();

                    $total_clash_guru += count(collect($filtered_guru[$l])->flatten());
                }
                // $collect_clash_guru[$k] = count($filtered_guru);
                $collect_clash_guru[$k] = $total_clash_guru;
                $total_clash_guru = 0;
            }
            // dd($m, $l, $k);

            for ($i = 0; $i < $jum_idv; $i++) {
                $fitness_value[$i] = 1 / (1 + $collect_double_mapel[$i] + $collect_clash_guru[$i]);
            }
            //* end hitung fitness

            //*seleksi
            // mencari nilai probabilitas
            $total_fitness = array_sum($fitness_value);
            $probabilitas = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                $probabilitas[$i] = $fitness_value[$i] / $total_fitness;
            }

            // mencari nilai kumulatif
            $kumulatif = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                if ($i <= 0) {
                    $kumulatif[$i] = $probabilitas[$i];
                } else {
                    $kumulatif[$i] = $kumulatif[$i - 1] + $probabilitas[$i];
                }
            }

            // mencari nilai random
            $random = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                $random[$i] = mt_rand() / mt_getrandmax();
            }

            // pengecekan terhadap nilai interval
            $interval = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                for ($j = 0; $j < $jum_idv; $j++) {
                    if ($j <= 0) {
                        if ($random[$i] <= $kumulatif[$j]) {
                            $interval[$i] = $j;
                            break;
                        }
                    } else {
                        if ($random[$i] > $kumulatif[$j - 1] && $random[$i] <= $kumulatif[$j]) {
                            $interval[$i] = $j;
                            break;
                        }
                    }
                }
            }

            // individu baru hasil seleksi
            $individu_seleksi = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                $individu_seleksi[$i] = $flattenpenugasan[$interval[$i]];
            }
            //* end seleksi

            //* crossover
            $cr_rate = $request->crossover_rate;
            if (empty($cr_rate)) {
                $cr_rate = 0.75;
            } else {
                $cr_rate = (int) $cr_rate / 100;
            }

            // mencari nilai random
            $random_cr = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                $random_cr[$i] = mt_rand() / mt_getrandmax();
            }

            // set parent crossover
            $interval_cr = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                if ($random_cr[$i] <= $cr_rate) {
                    $interval_cr[$i] = 1;
                } else {
                    $interval_cr[$i] = 0;
                }
            }

            // individu yang akan dijadikan parent crossover
            $individu_crossover = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                if ($interval_cr[$i] == 1) {
                    $individu_crossover[$i] = $individu_seleksi[$i];
                } else {
                    $individu_crossover[$i] = $individu_seleksi[$i];
                }
            }

            // mendapatkan index array yang bernilai 1
            $indexes = array();
            $indexes = array_keys($interval_cr, 1);
            // dd($indexes);

            // tampilkan individu crossover yang dengan interval_cr = 1
            $individu_crossover_parent = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                if ($interval_cr[$i] == 1) {
                    $individu_crossover_parent[$i] = $individu_seleksi[$i];
                }
            }

            // membuat key baru untuk array individu_crossover_parent
            $parent = array_values($individu_crossover_parent);
            // dd($indexes,$parent);
            // menentukan titik potong crossover secara random
            $titik_potong = array();
            $numParents = count($parent);
            $children = array();
            $parent1 = array();
            $parent2 = array();
            $counts = array();
            $array = array();
            $key = 0;
            if ($numParents == 0) {
                // echo "<script>alert('Tidak ada individu yang dijadikan parent crossover!')</script>";
                $children = $parent;
                $titik_potong[0] = 0;
            } else if ($numParents == 1) {
                $children = $parent;
                $titik_potong[0] = 0;
            } else if ($numParents >= 2) {

                // $children = array();
                $childTemp = array();

                for ($i = 0; $i < $numParents; $i++) {
                    $parent1 = $parent[$i];
                    $parent2 = $parent[($i + 1) % $numParents]; // Mengambil orangtua berikutnya secara siklikal

                    $titik_potong[$i] = rand(1, count($parent1) - 1);

                    // crossover
                    $parentLeft = array_slice($parent1, 0, $titik_potong[0]);
                    $parentRight = array_slice($parent2, $titik_potong[0]);
                    $childTemp = array_merge($parentLeft, $parentRight);

                    $array = $childTemp;

                    // cek nilai yang sama
                    $counts = array_count_values($array);

                    // mengambil nilai yang sama
                    $repeatedValues = [];
                    foreach ($counts as $value => $count) {
                        if ($count > 1) {
                            $repeatedValues[] = $value;
                        }
                    }

                    if (count($repeatedValues) >= 1) {
                        $newValue = 1;
                        foreach ($repeatedValues as $repeatedValue) {
                            while (in_array($newValue, $array)) {
                                $newValue++;
                                if ($newValue > count($array) + count($repeatedValues)) {
                                    break;
                                }
                            }
                            if ($newValue > count($array) + count($repeatedValues)) {
                                break;
                            }
                            $key = array_search($repeatedValue, $array);

                            $array[$key] = $newValue;
                            $children[$i] = $array;
                        }
                    } else {
                        $children[$i] = $array;
                    }
                }
            } else {
                // echo "<script>alert('Tidak ada individu yang dijadikan parent crossover!')</script>";
                $children = $parent;
                $titik_potong[0] = 0;
            }

            // dd($interval_cr);

            // menggabungkan individu terpilih crossover dengan individu yang tidak dijadikan parent crossover
            $individu_crossover_new = array();
            $a = 0;
            for ($i = 0; $i < $jum_idv; $i++) {
                if ($interval_cr[$i] == 1) {
                    $individu_crossover_new[$i] = $children[$a];
                    $a++;
                } else {
                    $individu_crossover_new[$i] = $individu_seleksi[$i];
                }
            }
            // $arrayKeys = array_keys($individu_crossover);
            // // dd($arrayKeys);
            // $individu_crossover_new = array();
            // for ($i = 0; $i < count($arrayKeys); $i++) {
            //     $key = $arrayKeys[$i];
            //     if (array_key_exists($key, $children)) {
            //         $individu_crossover[$key] = $children[$key];
            //     }
            //     $individu_crossover_new[$i] = $individu_crossover[$key];
            // }
            //* end crossover

            //* mutasi

            // membuat urutan baru $penugasan berdasarkan $individu_crossover_new
            $arrayList = array();
            $penugasan = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                // generate individu
                $arrayList[$i] = $individu_crossover_new[$i]; //216
            }

            for ($i = 0; $i < $jum_idv; $i++) {
                // generate individu
                $arraySample[$i] = Penugasan::all()->toArray(); //216
            }

            for ($i = 0; $i < count($arraySample); $i++) {
                $array_id = $arrayList[$i];
                $array_urutan = array();

                foreach ($array_id as $id) {
                    foreach ($arraySample[$i] as $obj) {
                        if ($obj["id"] == $id) {
                            $array_urutan[] = $obj;
                            break;
                        }
                    }
                }

                $penugasan[$i] = $array_urutan;
            }

            // dd(collect($penugasan[0])->pluck('id_guru')->all());

            // filter individu berdasarkan kelas
            for ($i = 0; $i < $jum_idv; $i++) {
                for ($j = 0; $j < count($jum_kelas); $j++) {
                    // $data_kelas[$j] = collect($penugasan[$i])->where('id_ruangan', $j + 1)->values()->all();
                    // $data_guru[$j] = collect($data_kelas[$j])->pluck('id_guru')->all();
                    $data_guru[$j] = collect($data_kelas[$j])->where('id_ruangan', $j + 1)->pluck('id_guru')->all();
                }
                $fitness_guru[$i] = $data_guru;
                // $fitness_guru[$i] = $data_guru;
            }

            // dd($fitness_guru[0][0][0]['id_guru']);

            // dd($fitness_guru);
            // return $fitness_guru;

            // dd(count($data_guru[0]));
            $total_clash_guru = 0;
            $get_clash_guru = array();
            $get_col_kelas = array();
            $get_filtered_guru = array();
            for ($k = 0; $k < $jum_idv; $k++) {
                for ($l = 0; $l < (count($data_guru[0])); $l++) {
                    for ($m = 0; $m < (count($jum_kelas)); $m++) {
                        $col_guru[$m] = collect($array_guru);
                        $col_guru[$m]->push($fitness_guru[$k][$m][$l]);
                    }
                    // dd(collect($col_guru)->toArray());

                    //? kalau ngambil data $data_guru
                    $col_kelas[$l] = collect($col_guru)->flatten()->toArray();

                    //? kalau ngambil data $data_kelas
                    // $col_kelas[$l] = collect($col_guru)->pluck('id_guru')->toArray();
                    // dd($col_kelas);
                    // dd($col_kelas[1]);
                    // dd($col_kelas[0]);
                    // dd($fitness_guru[0], $col_kelas[$l]);
                    $counted_guru[$l] = collect($col_kelas[$l])->countBy();
                    // dd($counted_guru);

                    // dd($counted_guru[$l])
                    // // dd($col_kelas[$l], $counted_guru[$l]);
                    $filtered_guru[$l] = $counted_guru[$l]->filter(function ($value) {
                        return $value > 1;
                    })->keys();

                    $total_clash_guru += count(collect($filtered_guru[$l])->flatten());

                    // dd(collect($counted_guru)->toArray());
                }
                // dd($ab, count($filtered_guru));
                $get_filtered_guru[$k] = collect($filtered_guru)->toArray();
                $get_col_kelas[$k] = $col_kelas;
                // dd($get_col_kelas[$k]);
                $collect_clash_guru[$k] = $total_clash_guru;
                $total_clash_guru = 0;
                // dd($collect_clash_guru[$k]);
            }
            // dd($collect_clash_guru[0]);
            // sum value collect_clash_guru
            // dd($collect_clash_guru);

            // get index yang duplicate
            // for ($i = 0; $i < $jum_idv; $i++) {
            //     for ($j = 0; $j < count($data_guru[0]) - 1; $j++) {
            //         $parent_duplicate[$i][$j] = $get_col_kelas[$i][$j];
            //         $index_duplicate[$i][$j] = $get_filtered_guru[$i][$j];
            //         $get_indexes = array();

            //         foreach ($parent_duplicate[$i][$j] as $index => $value) {
            //             if (in_array($value, $index_duplicate[$i][$j])) {
            //                 $get_indexes[] = $index;
            //             }
            //         }
            //         // dd($parent_duplicate[$i][$j], $index_duplicate[$i][$j], $get_indexes);
            //         $get[$i][$j] = $get_indexes;
            //     }
            //     $value_duplicate[$i] = $get;
            // }

            // dd($get_col_kelas, $get_filtered_guru, $value_duplicate);
            $mutatedArray = array();
            $mutatedArray = $individu_crossover_new;
            // dd($mutatedArray[0][1]);
            $mutation_rate = $request->mutation_rate;

            $index1 = array();
            $index2 = array();

            if (empty($mutation_rate)) {
                $mutation_rate = 0.25;
            } else {
                $mutation_rate = $mutation_rate / 100;
            }

            $loop_mutation = intval(array_sum($collect_clash_guru) * $mutation_rate);
            $parent_cr = $individu_crossover_new;
            $individu_mutasi = array();
            $random_index_mr = array();

            for ($i = 0; $i < $loop_mutation; $i++) {
                $random_index_mr[$i] = rand(0, count($mutatedArray) - 1);
                $index1[$i] = array_rand($mutatedArray[$random_index_mr[$i]]);
                $index2[$i] = array_rand($mutatedArray[$random_index_mr[$i]]);
                // dd($mutatedArray[$random_index_mr[$i]]);

                // Pastikan kedua indeks yang dipilih berbeda
                while ($index2[$i] == $index1[$i]) {
                    $index2[$i] = array_rand($mutatedArray[$random_index_mr[$i]]);
                }

                // Menukar nilai antara kedua indeks
                $temp = $mutatedArray[$random_index_mr[$i]][$index1[$i]];
                $mutatedArray[$random_index_mr[$i]][$index1[$i]] = $mutatedArray[$random_index_mr[$i]][$index2[$i]];
                $mutatedArray[$random_index_mr[$i]][$index2[$i]] = $temp;
                $individu_mutasi[$i] = collect($mutatedArray[$random_index_mr[$i]])->flatten()->toArray();
                $parent_cr[$random_index_mr[$i]] = $mutatedArray[$random_index_mr[$i]];
            }

            // dd($index1, $index2, count($individu_mutasi));
            // dd($individu_mutasi);
            //* end mutasi

            $result[$loop] = [
                'iterasi' => $loop,
                'individu' => $flattenpenugasan,
                'fitness_value' => $fitness_value,
                'probabilitas' => $probabilitas,
                'kumulatif' => $kumulatif,
                'random' => $random,
                'interval' => $interval,
                'individu_seleksi' => $individu_seleksi,
                'random_cr' => $random_cr,
                'interval_cr' => $interval_cr,
                'individu_crossover_parent' => $individu_crossover_parent,
                'indexes' => $indexes,
                'titik_potong' => $titik_potong,
                'children' => $children,
                'individu_crossover_new' => $individu_crossover_new,
                'individu_mutasi' => $individu_mutasi,
                'parent_cr' => $parent_cr,
                'random_index_mr' => $random_index_mr,
                'loop_mutation' => $loop_mutation,
                'index1' => $index1,
                'index2' => $index2,
                'total_clash_guru' => $collect_clash_guru,

            ];
            $loop++;
        } while ($loop <= $max_gen);
        // dd($result[$max_gen]['random_index_mr']);
        // dd($result[2]['random_index_mr'],$result[2]['individu_mutasi']);
        // return $result;
        // dd($result);

        //* get hasil genetika algoritma
        // mencari index dengan fitness value tertinggi
        $fitness_high = $result[$max_gen]['fitness_value'];
        $maxValue = max($fitness_high); // Mencari nilai tertinggi dalam array
        $maxIndex = array_search($maxValue, $fitness_high); // Mencari indeks dari nilai tertinggi

        // dd($fitness_high, $maxValue, $maxIndex);

        $arraySample = Penugasan::all()->toArray(); //216
        $array_id = $result[$max_gen]['parent_cr'][$maxIndex];
        $array_ga = array();
        // dd($array_id, $arraySample);

        foreach ($array_id as $id) {
            foreach ($arraySample as $obj) {
                if ($obj["id"] == $id) {
                    $array_ga[] = $obj;
                    break;
                }
            }
        }

        for ($j = 0; $j < count($jum_kelas); $j++) {
            // filter individu berdasarkan kelas
            $ga_kelas[$j] = collect($array_ga)->where('id_ruangan', $j + 1)->values()->all(); //24
            $ganda_mapel[$j] = collect($ga_kelas[$j])->flatMap(function ($item) {
                return [$item, $item];
            })->all();
        }

        $data_jadwal = collect($ganda_mapel)->flatten(1)->toArray();

        // dd($data_jadwal);

        $waktu_belajar = WaktuBelajar::all();

        // truncate table penjadwalan
        Penjadwalan::truncate();

        $idx = 0;
        // insert data penjadwalan
        foreach ($data_jadwal as $key => $value) {
            Penjadwalan::create([
                'id_penugasan' => $value['id'],
                'id_guru' => $value['id_guru'],
                'id_mapel' => $value['id_mapel'],
                'id_ruangan' => $value['id_ruangan'],
                'id_hari' => $waktu_belajar[$idx]['id'],
            ]);
            if ($idx < 47) {
                $idx++;
            } else {
                $idx = 0;
            }
        }

        $jadwal = Penjadwalan::all();

        // dd($waktu_belajar[1]['id']);

        // dd($waktu_belajar);

        // dd($ganda_mapel[0][0]['id']);
        // dd(($ganda_mapel)->toArray());

        // dd($array_urutan);

        return view('admin.penjadwalan.index', compact('result', 'maxValue', 'jum_kelas', 'waktu_belajar', 'jadwal'));
    }
}
