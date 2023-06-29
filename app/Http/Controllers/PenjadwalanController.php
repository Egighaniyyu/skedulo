<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use App\Models\Penugasan;
use App\Models\JamBelajar;
use App\Models\Ruangan;
use Illuminate\Console\View\Components\Alert;
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

        //* generate individu
        for ($i = 0; $i < $jum_idv; $i++) {
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
        $numChildren = $numParents;
        $child = array();
        $children = array();
        if ($numParents == 0) {
            echo "<script>alert('Tidak ada individu yang dijadikan parent crossover!')</script>";
            $titik_potong[0] = 0;
        } else if ($numParents == 1) {
            $children = $parent;
            $titik_potong[0] = 0;
        } else if ($numParents >= 2) {

            $children = array();
            $childTemp = array();

            for ($i = 0; $i < $numParents; $i++) {
                $parent1 = $parent[$i];
                $parent2 = $parent[($i + 1) % $numParents]; // Mengambil orangtua berikutnya secara siklikal

                $titik_potong[$i] = rand(1, count($parent1) - 1);

                // crossover
                $parentLeft = array_slice($parent1, 0, $titik_potong[0]);
                $parentRight = array_slice($parent2, $titik_potong[0]);
                $childTemp = array_merge($parentLeft, $parentRight);

                // $parentLeft = array_slice($parent1, $titik_potong[0]);
                // $parentRight = array_slice($parent2, 0, $titik_potong[0]);
                // $children = array_merge($parentRight, $parentLeft);
                $array = $childTemp;
                // dd($parent1, $parent2, $titik_potong, $array);

                // cek nilai yang sama
                $counts = array_count_values($array);

                // mengambil nilai yang sama
                $repeatedValues = [];
                foreach ($counts as $value => $count) {
                    if ($count > 1) {
                        $repeatedValues[] = $value;
                    }
                }

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
                // dd($children);

                // $arrayLeft = array_slice($array, $titik_potong[0]);
                // $arrayRight = array_slice($array, 0, $titik_potong[0]);
                // $childrenNew = array_merge($arrayRight, $arrayLeft);
                // dd($parent1, $parent2, $titik_potong, $childrenNew);

            }
        } else {
            echo "<script>alert('Tidak ada individu yang dijadikan parent crossover!')</script>";
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
        $mutatedArray = $individu_crossover_new;
        // $length = count($individu_crossover_new[0]);
        $mutation_rate = $request->mutation_rate;

        $index1 = array();
        $index2 = array();

        if (empty($mutation_rate)) {
            $mutation_rate = 0.25;
        } else {
            $mutation_rate = (int)$mutation_rate / 100;
        }

        for ($i = 0; $i < count($individu_crossover_new); $i++) {

            if (mt_rand() / mt_getrandmax() < $mutation_rate) {
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

        // dd($individu_mutasi);



        // dd(collect($individu_mutasi)->flatten()->toArray());
        // dd($penugasan);
        // return $result;
        // return $penugasan;
        // dd($penugasan);
        // dd($index1);
        // return $penugasan;

        // dd($individu_crossover);

        return view('penjadwalan.index', compact('flattenpenugasan', 'fitness_value', 'probabilitas', 'kumulatif', 'random', 'interval', 'individu_seleksi', 'random_cr', 'interval_cr', 'individu_crossover_parent', 'indexes', 'titik_potong', 'children', 'individu_crossover_new', 'individu_mutasi', 'index1', 'index2', 'result'));
    }
}
