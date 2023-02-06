<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-left" href="{{route('dashboard')}}">
        <div class="sidebar-brand-text mx-3">PROJECT MANAGEMENT PLAN</div>
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

    <li class="nav-item @yield('user')">
        <a class="nav-link" href="{{route('user.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengguna</span>
        </a>
    </li>

    <li class="nav-item @yield('coa')">
        <a class="nav-link" href="{{route('coa.index')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Chart Of Account</span>
        </a>
    </li>

    <li class="nav-item @yield('bank-account')">
        <a class="nav-link" href="{{route('bank-account.index')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Akun Bank</span>
        </a>
    </li>

    <li class="nav-item @yield('funding')">
        <a class="nav-link" href="{{route('funding.index')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Donatur</span>
        </a>
    </li>

    <li class="nav-item @yield('program')">
        <a class="nav-link" href="{{route('program.index')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>Program</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
