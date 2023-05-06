@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title' , 'Dashboard')

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
                        <li class="breadcrumb-item active">Teachers</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Cari berdasarkan ID ...">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Cari berdasarkan Kelas ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
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
                                        <h3 class="page-title">Penjadwalan</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                            Download</a>
                                        <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                                    {{-- tampilan proses --}}

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