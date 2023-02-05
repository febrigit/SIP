<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
        <div class="sidebar-brand-text mx-3">EAUDIT PMLI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pengaturan
    </div>

    <li class="nav-item @yield('pengguna')">
        <a class="nav-link" href="{{route('pengguna.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna</span>
        </a>
    </li>

    <li class="nav-item @yield('division')">
        <a class="nav-link" href="{{route('division.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Divisi</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
