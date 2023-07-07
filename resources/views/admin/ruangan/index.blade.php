@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title' , 'Kelas')

@push('page-css')
<link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
@endpush

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Kelas</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kelas</li>
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
                                    <h3 class="page-title">Informasi Kelas</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
                                    <a href="{{ route('ruangan.create') }}" class="btn btn-primary"><i
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
                                        <th>Kelas</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ruangan as $ruangan)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>{{$ruangan->id}}</td>
                                        <td>{{$ruangan->ruangan}}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('ruangan.edit', $ruangan->id) }}"
                                                    class="btn btn-sm bg-success-light me-2">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <form action="{{ route('ruangan.destroy', $ruangan->id) }}"
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