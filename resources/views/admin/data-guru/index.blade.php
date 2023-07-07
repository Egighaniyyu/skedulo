@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title', 'Data Guru')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Data Guru</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Guru</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Informasi Guru</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="/guru-list"
                                            class="btn btn-outline-gray me-2 @if (Request::segment(1) == '' or Request::segment(1) == 'guru-list') active @endif"><i
                                                class="feather-list"></i></a>
                                        <a href="/guru-grid"
                                            class="btn btn-outline-gray me-2 @if (Request::segment(1) == 'guru-grid') active @endif"><i
                                                class="feather-grid"></i></a>
                                        <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i>
                                            Download</a>
                                        <a href="{{ route('guru.create') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            @yield('content-guru')
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
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
@endpush
