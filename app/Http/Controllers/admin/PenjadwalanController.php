<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Penjadwalan;
use App\Models\Penugasan;
use App\Models\JamBelajar;
use App\Models\Ruangan;
use App\Models\WaktuBelajar;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use function PHPSTORM_META\type;

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
        $result = array();

        do {

            if ($loop == 1) {
                for ($i = 0; $i < $jum_idv; $i++) {
                    // generate individu
                    $penugasan[$i] = Penugasan::all()->shuffle()->toArray(); //216
                }
            } else if ($loop > 1) {
                $arrayList = array();
                $penugasan = array();
                for ($i = 0; $i < $jum_idv; $i++) {
                    // generate individu
                    $arrayList[$i] = $individu_mutasi[$i]; //216
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
            for ($k = 0; $k < $jum_idv; $k++) {
                for ($l = 0; $l < (count($data_guru[0])); $l++) {
                    for ($m = 0; $m < (count($jum_kelas)); $m++) {
                        $col_guru[$m] = collect($array_guru);
                        $col_guru[$m]->push($fitness_guru[$k][$m][$l]); // Error pada $l
                    }
                    // dd($col_guru);
                    $col_kelas[$l] = collect($col_guru)->flatten()->toArray();

                    $counted_guru[$l] = collect($col_kelas[$l])->countBy();
                    $filtered_guru[$l] = $counted_guru[$l]->filter(function ($value) {
                        return $value > 1;
                    })->keys();
                }
                $collect_clash_guru[$k] = count($filtered_guru);
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
                $cr_rate = (int)$cr_rate / 100;
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

            // tampilkan individu crossover yang dengan interval_cr = 1
            $individu_crossover_parent = array();
            for ($i = 0; $i < $jum_idv; $i++) {
                if ($interval_cr[$i] == 1) {
                    $individu_crossover_parent[$i] = $individu_seleksi[$i];
                }
            }


            // membuat key baru untuk array individu_crossover_parent
            $parent = array_values($individu_crossover_parent);

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
                                    // Jika semua nilai 1-15 sudah ada dalam array
                                    // Anda dapat menambahkan penanganan khusus di sini
                                    // Misalnya, keluar dari perulangan atau menampilkan pesan error
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


            // menggabungkan individu crossover dengan individu yang tidak dijadikan parent crossover
            $arrayKeys = array_keys($individu_crossover);
            $individu_crossover_new = array();
            for ($i = 0; $i < count($arrayKeys); $i++) {
                $key = $arrayKeys[$i];
                if (array_key_exists($key, $children)) {
                    $individu_crossover[$key] = $children[$key];
                }
                $individu_crossover_new[$i] = $individu_crossover[$key];
            }
            //* end crossover

            //* mutasi

            // membuat urutan baru $penugasan berdasarkan $individu_crossover_new
            // $arrayList = array();
            // $penugasan = array();
            // for ($i = 0; $i < $jum_idv; $i++) {
            //     // generate individu
            //     $arrayList[$i] = $individu_crossover_new[$i]; //216
            // }

            // for ($i = 0; $i < $jum_idv; $i++) {
            //     // generate individu
            //     $arraySample[$i] = Penugasan::all()->toArray(); //216
            // }

            // for ($i = 0; $i < count($arraySample); $i++) {
            //     $array_id = $arrayList[$i];
            //     $array_urutan = array();

            //     foreach ($array_id as $id) {
            //         foreach ($arraySample[$i] as $obj) {
            //             if ($obj["id"] == $id) {
            //                 $array_urutan[] = $obj;
            //                 break;
            //             }
            //         }
            //     }

            //     $penugasan[$i] = $array_urutan;
            // }

            // // dd(collect($penugasan[0])->pluck('id_guru')->all());
            // for ($i = 0; $i < $jum_idv; $i++) {
            //     for ($j = 0; $j < count($jum_kelas); $j++) {
            //         $data_kelas[$j] = collect($penugasan[$i])->where('id_ruangan', $j + 1)->values()->all();
            //         // $data_guru[$j] = collect($data_kelas[$j])->pluck('id_guru')->all();
            //         $data_guru[$j] = collect($data_kelas[$j])->where('id_ruangan', $j + 1)->pluck('id_guru')->all();
            //     }
            //     $fitness_guru[$i] = $data_kelas;
            //     // $fitness_guru[$i] = $data_guru;
            // }

            // // dd($fitness_guru);

            // // dd($fitness_guru);
            // // return $fitness_guru;

            // // dd(count($data_guru[0]));
            // $total_clash_guru = 0;
            // $get_clash_guru = array();
            // $get_col_kelas = array();
            // $get_filtered_guru = array();
            // for ($k = 0; $k < $jum_idv; $k++) {
            //     for ($l = 0; $l < (count($data_guru[0])); $l++) {
            //         for ($m = 0; $m < (count($jum_kelas)); $m++) {
            //             $col_guru[$m] = collect($array_guru);
            //             $col_guru[$m]->push($fitness_guru[$k][$m][$l]);
            //         }
            //         // dd($col_guru);

            //         //? kalau ngambil data $data_guru
            //         // $col_kelas[$l] = collect($col_guru)->flatten()->toArray();

            //         //? kalau ngambil data $data_kelas
            //         $col_kelas[$l] = collect($col_guru)->pluck('id_guru')->toArray();
            //         // dd($col_kelas[1]);
            //         // dd($col_kelas[0]);
            //         // dd($fitness_guru[0], $col_kelas[$l]);
            //         $counted_guru[$l] = collect($col_kelas[$l])->countBy();

            //         // dd($counted_guru[$l])
            //         // // dd($col_kelas[$l], $counted_guru[$l]);
            //         $filtered_guru[$l] = $counted_guru[$l]->filter(function ($value) {
            //             return $value > 1;
            //         })->keys();

            //         $total_clash_guru += count(collect($filtered_guru[$l])->flatten());

            //         // dd(collect($counted_guru)->toArray());
            //     }
            //     // dd($ab, count($filtered_guru));
            //     $get_filtered_guru[$k] = collect($filtered_guru)->toArray();
            //     $get_col_kelas[$k] = $col_kelas;
            //     // dd($get_col_kelas[$k]);
            //     $collect_clash_guru[$k] = $total_clash_guru;
            //     $total_clash_guru = 0;
            //     // dd($collect_clash_guru[$k]);
            // }

            // // dd(collect($col_kelas)->toArray());
            // // dd($data_guru[0]);
            // // dd($fitness_guru, $get_col_kelas, $get_filtered_guru, $collect_clash_guru, floor($collect_clash_guru[0] * 0.25));

            // // dd($get_col_kelas[0][24]);
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

            $mutatedArray = $individu_crossover_new;
            // $length = count($individu_crossover_new[0]);
            $mutation_rate = $request->mutation_rate;

            $index1 = array();
            $index2 = array();

            if (empty($mutation_rate)) {
                $mutation_rate = 0.25;
            } else {
                $mutation_rate = $mutation_rate / 100;
            }

            for ($i = 0; $i < count($individu_crossover_new); $i++) {
                $random_mr[$i] = mt_rand() / mt_getrandmax();
                if ($random_mr[$i] < $mutation_rate) {
                    $index1[$i] = array_rand($individu_crossover_new[$i]);
                    $index2[$i] = array_rand($individu_crossover_new[$i]);

                    // Pastikan kedua indeks yang dipilih berbeda
                    while ($index2[$i] == $index1[$i]) {
                        $index2[$i] = array_rand($individu_crossover_new[$i]);
                    }

                    // Menukar nilai antara kedua indeks
                    $temp = $mutatedArray[$i][$index1[$i]];
                    $mutatedArray[$i][$index1[$i]] = $mutatedArray[$i][$index2[$i]];
                    $mutatedArray[$i][$index2[$i]] = $temp;
                } else {
                    $index1[$i] = 'Tidak dilakukan mutasi';
                    $index2[$i] = 'Tidak dilakukan mutasi';
                }
                $individu_mutasi[$i] = collect($mutatedArray[$i])->flatten()->toArray();
            }
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
                'index1' => $index1,
                'index2' => $index2,
                'total_clash_guru' => $collect_clash_guru,

            ];
            $loop++;
        } while ($loop <= $max_gen);

        //* get hasil genetika algoritma
        // mencari index dengan fitness value tertinggi
        $fitness_high = $result[$max_gen]['fitness_value'];
        $maxValue = max($fitness_high); // Mencari nilai tertinggi dalam array
        $maxIndex = array_search($maxValue, $fitness_high); // Mencari indeks dari nilai tertinggi

        // dd($fitness_high, $maxValue, $maxIndex);

        $arraySample = Penugasan::all()->toArray(); //216
        $array_id = $result[$max_gen]['individu_mutasi'][$maxIndex];
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

        $waktu_belajar = WaktuBelajar::all()->pluck('jam')->toArray();
        // dd($waktu_belajar);

        // dd($ganda_mapel[0][0]['id']);
        // dd($ganda_mapel);




        // dd($array_urutan);

        return view('admin.penjadwalan.index', compact('result', 'maxValue', 'ganda_mapel', 'jum_kelas', 'waktu_belajar'));
    }
}
