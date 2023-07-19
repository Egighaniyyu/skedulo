@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title', 'Penjadwalan')

@push('page-css')
    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Penjadwalan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Penjadwalan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <form action="{{ route('penjadwalan.randIndividu') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="page-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="page-title">Informasi Penjadwalan</h3>
                                        </div>
                                        <div class="col-auto text-end float-end ms-auto download-grp">
                                            <a href="{{ route('export') }}" class="btn btn-outline-primary me-2"><i
                                                    class="fas fa-download"></i>
                                                Download</a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs nav-tabs-bottom">
                                    <li class="nav-item"><a class="nav-link active" href="#bottom-tab1"
                                            data-bs-toggle="tab">Proses Algoritma Genetika</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-bs-toggle="tab">Hasil
                                            Penjadwalan</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="bottom-tab1">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jumlah Individu</label>
                                                    <input type="number" class="form-control" name="jum_individu"
                                                        placeholder="Masukan jumlah individu">
                                                    <span class="form-text text-muted">Contoh : 1 s/d 10</span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Maksimal Generasi</label>
                                                    <input type="number" class="form-control" name="max_generasi"
                                                        placeholder="Masukan maksimal generasi">
                                                    <span class="form-text text-muted">Contoh : 1 s/d 50</span>
                                                </div>
                                            </div>
                                            <p>
                                                <button class="btn btn-primary collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                                    aria-expanded="true" aria-controls="collapseExample">
                                                    Opsional
                                                </button>
                                                <button type="submit" class="btn btn-primary">Generate Jadwal</button>

                                            </p>
                                            <div class="collapse" id="collapseExample">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Crossover Rate</label>
                                                        <input type="number" class="form-control" name="crossover_rate"
                                                            placeholder="Masukan crossover rate">
                                                        <span class="form-text text-muted">Contoh : 10 s/d 100</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mutation Rate</label>
                                                        <input type="number" class="form-control" name="mutation_rate"
                                                            placeholder="Masukan Mutation Rate">
                                                        <span class="form-text text-muted">Contoh : 10 s/d 100</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <h3 class="page-title mt-3">Tampilan Proses</h3>
                                        @if (@isset($result))
                                            @foreach ($result as $data)
                                                <h3 class="page-title mt-5">Generasi {{ $data['iterasi'] }}</h3>
                                                <div class="table-responsive">
                                                    <table
                                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                                        <thead class="student-thread">
                                                            <tr>
                                                                <th>Individu Ke-</th>
                                                                <th>Kromosom</th>
                                                                <th>Fitness</th>
                                                                <th>Probabilitas</th>
                                                                <th>Kumulatif</th>
                                                                <th>Random</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['individu'] as $penugasan)
                                                                <tr>
                                                                    <td>P{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        @foreach ($penugasan as $individu)
                                                                            {{ $individu }}
                                                                        @endforeach
                                                                    </td>
                                                                    <td>
                                                                        {{ $data['fitness_value'][$loop->iteration - 1] }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $data['probabilitas'][$loop->iteration - 1] }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $data['kumulatif'][$loop->iteration - 1] }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $data['random'][$loop->iteration - 1] }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <h5 class="mt-4">Individu Hasil Proses Seleksi</h5>
                                                @foreach ($data['interval'] as $interval)
                                                    <p>S{{ $loop->iteration }} = <span>P{{ $interval + 1 }}</span></p>
                                                @endforeach

                                                <div class="table-responsive">
                                                    <table
                                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                                        <thead class="student-thread">
                                                            <tr>
                                                                <th>Individu Ke-</th>
                                                                <th>Kromosom</th>
                                                                <th>Random</th>
                                                                <th>Interval</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['individu_seleksi'] as $individu_seleksi)
                                                                <tr>
                                                                    <td>P{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        @foreach ($individu_seleksi as $individu_seleksi)
                                                                            {{ $individu_seleksi }}
                                                                        @endforeach
                                                                    </td>
                                                                    <td>
                                                                        {{ $data['random_cr'][$loop->iteration - 1] }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $data['interval_cr'][$loop->iteration - 1] }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <h5 class="mt-4">Parent Proses Crossover</h5>
                                                <div class="table-responsive">
                                                    <table
                                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                                        <thead class="student-thread">
                                                            <tr>
                                                                <th>Individu Ke-</th>
                                                                <th>Kromosom</th>
                                                                <th>Titik Potong</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['individu_crossover_parent'] as $individu_crossover_parent)
                                                                <tr>
                                                                    <td>P{{ $data['indexes'][$loop->iteration - 1] + 1 }}
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($individu_crossover_parent as $individu_crossover_parent)
                                                                            {{ $individu_crossover_parent }}
                                                                        @endforeach
                                                                    </td>
                                                                    <td>{{ $data['titik_potong'][$loop->iteration - 1] }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <h5 class="mt-4">Individu Hasil Proses Crossover</h5>
                                                <div class="table-responsive">
                                                    <table
                                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                                        <thead class="student-thread">
                                                            <tr>
                                                                <th>Individu Ke-</th>
                                                                <th>Kromosom</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['children'] as $children)
                                                                <tr>
                                                                    <td>P{{ $data['indexes'][$loop->iteration - 1] + 1 }}
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($children as $children)
                                                                            {{ $children }}
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <h5 class="mt-4">Individu Baru Hasil Crossover</h5>
                                                <div class="table-responsive">
                                                    <table
                                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                                        <thead class="student-thread">
                                                            <tr>
                                                                <th>Individu Ke-</th>
                                                                <th>Kromosom</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['individu_crossover_new'] as $individu_crossover_new)
                                                                <tr>
                                                                    <td>P{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        @foreach ($individu_crossover_new as $individu_crossover_new)
                                                                            {{ $individu_crossover_new }}
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <h5 class="mt-4">Individu Hasil Mutasi</h5>
                                                <div class="table-responsive">
                                                    <table
                                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                                        <thead class="student-thread">
                                                            <tr>
                                                                <th>Individu Ke-</th>
                                                                <th>Index mutasi 1</th>
                                                                <th>Index mutasi 2</th>
                                                                <th>Kromosom</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['individu_mutasi'] as $individu_mutasi)
                                                                <tr>
                                                                    <td>P{{ $data['random_index_mr'][$loop->iteration - 1] + 1 }}
                                                                    </td>
                                                                    <td>{{ $data['index1'][$loop->iteration - 1] }}</td>
                                                                    <td>{{ $data['index2'][$loop->iteration - 1] }}</td>
                                                                    <td>
                                                                        @foreach ($individu_mutasi as $individu_mutasi)
                                                                            {{ $individu_mutasi }}
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        @endif


                                    </div>
                                    <div class="tab-pane" id="bottom-tab2">
                                        @if (@isset($result))
                                            <h3 class="page-title">Hasil Jadwal</h3>
                                            <p>Fitness Terbaik : {{ $maxValue }}</p>
                                            <div class="table-responsive">
                                                <table
                                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                                    <thead class="student-thread">
                                                        <tr>
                                                            <th scope="col">Jam/Hari</th>
                                                            <th scope="col">7A</th>
                                                            <th scope="col">7B</th>
                                                            <th scope="col">7C</th>
                                                            <th scope="col">8A</th>
                                                            <th scope="col">8B</th>
                                                            <th scope="col">8C</th>
                                                            <th scope="col">9A</th>
                                                            <th scope="col">9B</th>
                                                            <th scope="col">9C</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <td>
                                                            @foreach ($waktu_belajar as $waktu_belajar)
                                                                <div>
                                                                    {{ $waktu_belajar->hari->hari }},
                                                                    {{ $waktu_belajar->jam }}
                                                                </div><br>
                                                            @endforeach
                                                        </td>
                                                        @for ($idRuangan = 1; $idRuangan <= 9; $idRuangan++)
                                                            <td>
                                                                @foreach ($jadwal as $kelas)
                                                                    @if ($kelas['id_ruangan'] == $idRuangan)
                                                                        <div>
                                                                            guru:
                                                                            {{ $kelas->guru->nama }},<br>
                                                                            mapel: {{ $kelas->mapel->mapel }},
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer>
            <p>Copyright © 2022 Dreamguys.</p>
        </footer>

    </div>
@endsection

@push('page-scripts')
    <script src="assets/plugins/datatables/datatables.min.js"></script>
@endpush
