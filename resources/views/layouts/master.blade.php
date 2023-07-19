<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    @stack('page-css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .actions a .btn-del:hover {
            background-color: red !important;
            color: white !important;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        {{-- header --}}
        <div class="header">

            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                </a>
                <a href="index.html" class="logo logo-small">
                    <img src="{{ asset('assets/img/logo-small.png') }}" alt="Logo" width="30" height="30">
                </a>
            </div>
            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>


            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list win-maximize">
                        <img src="{{ asset('assets/img/icons/header-icon-04.svg') }}" alt="">
                    </a>
                </li>

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="{{ asset('public/guru/' . Auth::user()->foto) }}"
                                width="31" alt="Soeng Souy">
                            <div class="user-text">
                                <h6>{{ Auth::user()->nama }}</h6>
                                <p class="text-muted mb-0">{{ Auth::user()->role }}</p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="{{ asset('public/guru/' . Auth::user()->foto) }}" alt="User Image"
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>{{ Auth::user()->nama }}</h6>
                                <p class="text-muted mb-0">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                        <form class="d-flex" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </div>
                </li>

            </ul>

        </div>
        {{-- end header --}}

        {{-- sidebar --}}
        @include('layouts.sidebar')
        {{-- end sidebar --}}

        {{-- body --}}
        @yield('content')
        {{-- end body --}}

        {{-- js assets --}}
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/feather.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>
        @stack('page-scripts')
        <script src="{{ asset('assets/js/script.js') }}"></script>
        {{-- end js assets --}}
    </div>
</body>
