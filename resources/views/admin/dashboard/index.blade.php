@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title', 'Dashboard')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Welcome {{ Auth::user()->nama }}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">{{ Auth::user()->role }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Guru</h6>
                                    <h3>{{ $data_guru }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Mata Pelajaran</h6>
                                    <h3>{{ $data_mapel }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('assets/img/icons/teacher-icon-02.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Kelas</h6>
                                    <h3>{{ $data_kelas }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('assets/img/icons/dash-icon-03.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Hari Belajar</h6>
                                    <h3>{{ $data_hari }}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{ asset('assets/img/icons/teacher-icon-03.svg') }}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
