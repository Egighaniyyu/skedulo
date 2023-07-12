@extends('layouts.master')

{{-- apabila 1 baris --}}
@section('title', 'Dashboard')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/simple-calendar/simple-calendar.css') }}">
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Welcome {{ Auth::user()->nama }}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active">{{ Auth::user()->role }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-lg-8 col-xl-8">
                    <div class="row">
                        <div class="col-12 col-lg-12 col-xl-12 d-flex">
                            <div class="card flex-fill comman-shadow">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <h5 class="card-title">Jadwal Mengajar</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-3 pb-3">
                                    <div class="table-responsive lesson">
                                        <table class="table table-center">
                                            <tbody>
                                                @foreach ($jadwal->sortBy(function ($item) {
            return $item->waktu->id_hari . $item->waktu->jam;
        }) as $jadwal)
                                                    <tr>
                                                        <td>
                                                            <div class="date">
                                                                <b>Kelas {{ $jadwal->ruangan->ruangan }}</b>
                                                                <p>{{ $jadwal->mapel->mapel }}</p>
                                                                <ul class="teacher-date-list">
                                                                    <li>
                                                                        <i class="fas fa-calendar-alt me-2"></i>
                                                                        @if ($jadwal->waktu->id_hari == '1')
                                                                            Senin
                                                                        @elseif ($jadwal->waktu->id_hari == '2')
                                                                            Selasa
                                                                        @elseif ($jadwal->waktu->id_hari == '3')
                                                                            Rabu
                                                                        @elseif ($jadwal->waktu->id_hari == '4')
                                                                            Kamis
                                                                        @elseif ($jadwal->waktu->id_hari == '5')
                                                                            Jumat
                                                                        @endif
                                                                    </li>
                                                                    <li>|</li>
                                                                    <li>
                                                                        <i class="fas fa-clock me-2"></i>
                                                                        {{ $jadwal->waktu->jam }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>


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
                <div class="col-12 col-lg-12 col-xl-4 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-body">
                            <div id="calendar-doctor" class="calendar-container"></div>
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
    <script src="{{ asset('assets/plugins/simple-calendar/jquery.simple-calendar.js') }}"></script>
    <script src="{{ asset('assets/js/calander.js') }}"></script>
    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
@endpush
