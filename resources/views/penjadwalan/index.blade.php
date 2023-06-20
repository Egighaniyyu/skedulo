@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title' , 'Penjadwalan')

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
                                        <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
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
                                                <input type="text" class="form-control" name="jum_individu"
                                                    placeholder="Masukan jumlah individu">
                                            </div>
                                            <div class="form-group">
                                                <label>Maksimal Generasi</label>
                                                <input type="text" class="form-control" name="max_generasi"
                                                    placeholder="Masukan maksimal generasi">
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
                                                    <input type="text" class="form-control" name="crossover_rate"
                                                        placeholder="Masukan crossover rate">
                                                </div>
                                                <div class="form-group">
                                                    <label>Mutation Rate</label>
                                                    <input type="text" class="form-control" name="mutation_rate"
                                                        placeholder="Masukan Mutation Rate">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <h3 class="page-title mt-3">Tampilan Proses</h3>
                                    @if(isset($flattenpenugasan))
                                    <h3 class="page-title mt-3">Generasi 1</h3>
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
                                                @foreach ($flattenpenugasan as $penugasan)
                                                <tr>
                                                    <td>P{{ $loop->iteration }}</td>
                                                    <td>
                                                        @foreach($penugasan as $individu)
                                                        {{ $individu }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{ $fitness_value[($loop->iteration)-1] }}
                                                    </td>
                                                    <td>
                                                        {{ $probabilitas[($loop->iteration)-1] }}
                                                    </td>
                                                    <td>
                                                        {{ $kumulatif[($loop->iteration)-1] }}
                                                    </td>
                                                    <td>
                                                        {{ $random[($loop->iteration)-1] }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <h5 class="mt-4">Individu Hasil Proses Seleksi</h5>
                                    @foreach ($interval as $interval)
                                    <p>S{{$loop->iteration}} = <span>P{{$interval + 1}}</span></p>
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
                                                @foreach ($individu_seleksi as $individu_seleksi)
                                                <tr>
                                                    <td>P{{ $loop->iteration }}</td>
                                                    <td>
                                                        @foreach ($individu_seleksi as $individu_seleksi)
                                                        {{ $individu_seleksi }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{ $random_cr[($loop->iteration)-1] }}
                                                    </td>
                                                    <td>
                                                        {{ $interval_cr[($loop->iteration)-1] }}
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
                                                @foreach ($individu_crossover_parent as $individu_crossover_parent)
                                                <tr>
                                                    <td>P{{ $indexes[($loop->iteration)-1] + 1 }}</td>
                                                    <td>
                                                        @foreach ($individu_crossover_parent as $individu_crossover_parent)
                                                        {{ $individu_crossover_parent }}
                                                        @endforeach
                                                    </td>
                                                    <td>{{$titik_potong[($loop->iteration)-1]}}</td>
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
                                                @foreach ($child as $child)
                                                <tr>
                                                    <td>P{{ $indexes[($loop->iteration)-1] + 1 }}</td>
                                                    <td>
                                                        @foreach ($child as $child)
                                                        {{ $child }}
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif

                                </div>
                                <div class="tab-pane" id="bottom-tab2">
                                    Coming soon
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