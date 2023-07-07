@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title' , 'Dashboard')

@push('page-css')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }} ">
@endpush

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Penugasan Guru</h3>
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
                        <h5 class="card-title">Informasi Penugasan Guru</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('penugasan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Guru</label>
                                        <select class="select w-100" name="id_guru" required>
                                            <option disabled selected>-- Pilih guru --</option>
                                            @foreach ($guru as $guru)
                                            <option value="{{$guru->id}}">{{$guru->nama}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="d-block">Mata Pelajaran</label>
                                        <select class="select w-100" name="id_mapel" required>
                                            <option disabled selected>-- Pilih mapel --</option>
                                            @foreach ($mapel as $mapel)
                                            <option value="{{$mapel->id}}">{{$mapel->mapel}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="d-block">Kelas</label>
                                        <select class="select w-100" name="id_ruangan" required>
                                            <option disabled selected>-- Pilih kelas --</option>
                                            @foreach ($ruangan as $ruangan)
                                            <option value="{{$ruangan->id}}">{{$ruangan->ruangan}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Porsi Jam</label>
                                        <input type="text" class="form-control" name="porsi_jam"
                                            placeholder="Masukan porsi jam" required>
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
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }} "></script>
<script>
    $(document).ready(function() {
        $('.select').select2();
    });
</script>
@endpush