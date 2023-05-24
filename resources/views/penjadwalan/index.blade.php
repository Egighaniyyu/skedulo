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
                                    <div class="table-responsive">
                                        <table
                                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                            <thead class="student-thread">
                                                <tr>
                                                    <th>Generasi</th>
                                                    <th>Individu</th>
                                                    <th>Fitness</th>
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
                                                    <td></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                    {{-- @if(isset($flattenpenugasan))
                                    <ul>
                                        @foreach($flattenpenugasan as $item)
                                        generasi ke-{{ $loop->iteration }}
                                        @foreach($item as $item2)
                                        {{ $item2 }}
                                        @endforeach
                                        <br>
                                        @endforeach
                                    </ul>
                                    @endif --}}

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