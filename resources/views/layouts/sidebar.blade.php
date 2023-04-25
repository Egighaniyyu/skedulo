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
            </ul>
        </div>
    </div>
</div>