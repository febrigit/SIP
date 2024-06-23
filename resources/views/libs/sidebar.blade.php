
<ul class="navbar-nav bg-white sidebar sidebar-light accordion shadow" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-left" href="{{route('dashboard')}}">
        <div class="sidebar-brand-text mx-3">SIGOEDANG</div>
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
    <div class="sidebar-heading">
        MASTER
    </div>

    <li class="nav-item @yield('user')">
        <a class="nav-link" href="{{route('user.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>
                User
            </span>
        </a>
    </li>

    <li class="nav-item @yield('position')">
        <a class="nav-link" href="{{route('position.index')}}">
            <i class="fas fa-fw fa-location-dot"></i>
            <span>
                Position
            </span>
        </a>
    </li>

    <li class="nav-item @yield('unit')">
        <a class="nav-link" href="{{route('unit.index')}}">
            <i class="fas fa-fw fa-flag"></i>
            <span>
                Meta Unit
            </span>
        </a>
    </li>

    <li class="nav-item @yield('item')">
        <a class="nav-link" href="{{route('item.index')}}">
            <i class="fas fa-fw fa-inbox"></i>
            <span>
                Item
            </span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        TRANSACTION
    </div>

    <li class="nav-item @yield('item-receive')" >
        <a class="nav-link" href="{{route('item-receive.index')}}">
            <i class="fas fa-fw fa-truck"></i>
            <span>
                Item Receive
            </span>
        </a>
    </li>

    <li class="nav-item @yield('item-usage')" >
        <a class="nav-link" href="{{route('item-usage.index')}}">
            <i class="fas fa-fw fa-file-import"></i>
            <span>
                Item Usage
            </span>
        </a>
    </li>

    <li class="nav-item @yield('stock-adjustment')" >
        <a class="nav-link" href="{{route('stock-adjustment.index')}}">
            <i class="fas fa-fw fa-pencil"></i>
            <span>
                Stock Adjustment
            </span>
        </a>
    </li>

    <li class="nav-item @yield('stock-opname')" >
        <a class="nav-link" href="{{route('stock-opname.index')}}">
            <i class="fas fa-fw fa-clipboard"></i>
            <span>
                Stock Opnames
            </span>
        </a>
    </li>

    <li class="nav-item @yield('item-log')" >
        <a class="nav-link" href="{{route('item-log.index')}}">
            <i class="fas fa-fw fa-list"></i>
            <span>
                Item Logs
            </span>
        </a>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
