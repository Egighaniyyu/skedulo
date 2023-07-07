@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title' , 'Dashboard')

@push('page-css')

@endpush

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Data Kelas</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Informasi Ruangan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ruangan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ruangan</label>
                                        <input type="text" class="form-control" name="ruangan"
                                            placeholder="Masukan ruangan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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

@endpush