<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>
                <li class="@if (Request::segment(1) == '' or Request::segment(1) == '/') active @endif">
                    <a href="/"><i class="feather-grid"></i> <span> Dashboard</span></a>
                </li>
                <li
                    class="@if (Request::segment(1) == 'guru-list' or Request::segment(1) == 'guru-grid') active @endif">
                    <a href="/guru-list"><i class="fas fa-chalkboard-teacher"></i> <span> Data Guru</span></a>
                </li>
                <li class="@if (Request::segment(1) == 'mapel') active @endif">
                    <a href="/mapel"><i class="fas fa-book-reader"></i> <span> Mata Pelajaran</span></a>
                </li>
                <li class="@if (Request::segment(1) == 'ruangan') active @endif">
                    <a href="/ruangan"><i class="fas fa-building"></i> <span> Kelas</span></a>
                </li>
                <li class="@if (Request::segment(1) == 'jam-belajar') active @endif">
                    <a href="/jam-belajar"><i class="fas fa-calendar"></i> <span> Jam Belajar</span></a>
                </li>
                <li class="@if (Request::segment(1) == 'penugasan') active @endif">
                    <a href="/penugasan"><i class="fas fa-suitcase"></i> <span> Penugasan Guru</span></a>
                </li>
                <li class="@if (Request::segment(1) == 'penjadwalan') active @endif">
                    <a href="/penjadwalan"><i class="fas fa-table"></i> <span> Penjadwalan</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>