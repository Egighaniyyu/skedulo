<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            @if (Auth::user()->role == 'admin')
                <ul>
                    <li class="menu-title">
                        <span>Main Menu</span>
                    </li>
                    <li class="@if (request()->routeIs('dashboards.index')) active @endif">
                        <a href="{{ route('dashboards.index') }}"><i class="feather-grid"></i> <span> Dashboard</span></a>
                    </li>
                    <li class="@if (request()->routeIs('guru-list.index') or request()->routeIs('guru-grid.index')) active @endif">
                        <a href="{{ route('guru-list.index') }}"><i class="fas fa-chalkboard-teacher"></i> <span> Data
                                Guru</span></a>
                    </li>
                    <li class="@if (request()->routeIs('mapel.index')) active @endif">
                        <a href="{{ route('mapel.index') }}"><i class="fas fa-book-reader"></i> <span> Mata
                                Pelajaran</span></a>
                    </li>
                    <li class="@if (request()->routeIs('ruangan.index')) active @endif">
                        <a href="{{ route('ruangan.index') }}"><i class="fas fa-building"></i> <span> Kelas</span></a>
                    </li>
                    <li class="submenu @if (request()->routeIs('jam-belajar.index') or request()->routeIs('waktu-belajar.index')) active @endif">
                        <a href="#" class="active subdrop"><i class="fas fa-calendar"></i> <span>Kegiatan
                                Belajar</span> <span class="menu-arrow"></span></a>
                        <ul style="display: block;">
                            <li><a href="{{ route('jam-belajar.index') }}"
                                    class="@if (request()->routeIs('jam-belajar.index')) active @endif">Hari Belajar</a></li>
                            <li><a href="{{ route('waktu-belajar.index') }}"
                                    class="@if (request()->routeIs('waktu-belajar.index')) active @endif">Waktu Belajar</a></li>
                        </ul>
                    </li>
                    <li class="@if (request()->routeIs('penugasan.index')) active @endif">
                        <a href="{{ route('penugasan.index') }}"><i class="fas fa-suitcase"></i> <span> Penugasan
                                Guru</span></a>
                    </li>
                    <li class="@if (request()->routeIs('penjadwalan.index')) active @endif">
                        <a href="{{ route('penjadwalan.index') }}"><i class="fas fa-table"></i> <span>
                                Penjadwalan</span></a>
                    </li>
                </ul>
            @else
                <ul>
                    <li class="menu-title">
                        <span>Main Menu</span>
                    </li>
                    <li class="@if (request()->routeIs('dashboard.index')) active @endif">
                        <a href="{{ route('dashboard.index') }}"><i class="feather-grid"></i> <span>
                                Dashboard</span></a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>
