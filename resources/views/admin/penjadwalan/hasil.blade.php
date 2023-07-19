@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title', 'Hasil Jadwal')

@push('page-css')
    <link rel="stylesheet" href="assets/plugins/datatables/datatables.min.css">
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Hasil Jadwal Belajar</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Hasil Jadwal Belajar</li>
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
                                        <h3 class="page-title">Informasi Jadwal Belajar</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('export') }}" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i>
                                            Download</a>
                                    </div>
                                </div>
                            </div>

                            @if (@isset($penjadwalan))
                                <div class="table-responsive">
                                    <table
                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                <th scope="col">Jam/Hari</th>
                                                <th scope="col">7A</th>
                                                <th scope="col">7B</th>
                                                <th scope="col">7C</th>
                                                <th scope="col">8A</th>
                                                <th scope="col">8B</th>
                                                <th scope="col">8C</th>
                                                <th scope="col">9A</th>
                                                <th scope="col">9B</th>
                                                <th scope="col">9C</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>
                                                @foreach ($waktu_belajar as $waktu_belajar)
                                                    <div>
                                                        {{ $waktu_belajar->hari->hari }},
                                                        {{ $waktu_belajar->jam }}
                                                    </div><br>
                                                @endforeach
                                            </td>
                                            @for ($idRuangan = 1; $idRuangan <= 9; $idRuangan++)
                                                <td>
                                                    @foreach ($penjadwalan as $kelas)
                                                        @if ($kelas['id_ruangan'] == $idRuangan)
                                                            <div>
                                                                guru:
                                                                {{ $kelas->guru->nama }},<br>
                                                                mapel: {{ $kelas->mapel->mapel }},
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @endfor
                                        </tbody>
                                        {{-- <tbody>
                                            @foreach ($data as $row)
                                                <tr>
                                                    <td>{{ $row[0] }}</td>
                                                    <td>{{ $row[1] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody> --}}
                                    </table>
                                </div>
                            @endif
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
