<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 100rem">
    <!-- Brand Logo -->
    <a href="{{ route('beranda') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile') }}" class="d-block">User</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Profil</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('data.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('data.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('data.student.index') }}" class="nav-link {{ request()->routeIs('data.student.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('data.teacher.index') }}" class="nav-link {{ request()->routeIs('data.teacher.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('data.school-year.index') }}" class="nav-link {{ request()->routeIs('data.school-year.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tahun Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('data.subjects.index') }}" class="nav-link {{ request()->routeIs('data.subjects.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('data.class.index') }}" class="nav-link {{ request()->routeIs('data.class.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kelas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('lesson-schedule.index') }}" class="nav-link {{ request()->routeIs('lesson-schedule.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-plus"></i>
                        <p>Jadwal Pelajaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('grade.index') }}" class="nav-link {{ request()->routeIs('grade.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-check-square"></i>
                        <p>Penilaian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('report.index') }}" class="nav-link {{ request()->routeIs('report.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>E-Raport</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
