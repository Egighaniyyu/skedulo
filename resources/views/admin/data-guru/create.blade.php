@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title', 'Dashboard')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }} ">
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
                            <li class="breadcrumb-item active">Teachers</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Informasi Guru</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Guru</label>
                                            <input type="text" class="form-control" name="nama"
                                                placeholder="Masukan nama guru" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Masukan email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control" name="password"
                                                placeholder="Masukan password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="select" name="role" required>
                                                <option disabled selected>-- Pilih role --</option>
                                                <option value="administrator">Administrator</option>
                                                <option value="guru">Guru</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Foto</label>
                                        <input class="form-control" type="file" name="foto" id="inputImage">
                                        <p class="text-muted mt-1">Allowed JPG, JPEG, GIF or PNG. Max size of 2MB</p>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{ asset('assets\img\library\user.jpg') }}" alt="Image" class="d-block"
                                            height="120px" width="auto" id="uploadedAvatar" style="border-radius: 50%" />
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            <script>
                                inputImage.onchange = evt => {
                                    const [file] = inputImage.files
                                    if (file) {
                                        uploadedAvatar.src = URL.createObjectURL(file)
                                    }
                                }
                            </script>
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
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }} "></script>
@endpush
