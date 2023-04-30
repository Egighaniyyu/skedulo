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
                    <h3 class="page-title">Teachers</h3>
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
                        <input type="text" class="form-control" placeholder="Cari berdasarkan Mata Pelajaran ...">
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

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Jam Belajar</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
                                    <a href="{{ route('jam-belajar.create') }}" class="btn btn-primary"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Hari</th>
                                        <th>Jumlah Jam</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jambelajar as $jambelajar)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>{{$jambelajar->id}}</td>
                                        <td>{{$jambelajar->hari}}</td>
                                        <td>{{$jambelajar->jumlah_jam}}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('jam-belajar.edit', $jambelajar->id) }}"
                                                    class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <form action="{{ route('jam-belajar.destroy', $jambelajar->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm bg-danger-light" type="submit">
                                                        <i class="feather-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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