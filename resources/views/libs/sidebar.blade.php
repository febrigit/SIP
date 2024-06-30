
<ul class="navbar-nav bg-white sidebar sidebar-light accordion shadow" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-left" href="{{route('dashboard')}}">
        <div class="sidebar-brand-text mx-3">SIP</div>
    </a>
    <hr class="sidebar-divider my-0">

    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        MASTER
    </div>

    @if(\App\Helpers::checkPermission('menu-permission'))
        <li class="nav-item @yield('permission')">
            <a class="nav-link" href="{{route('permission.index')}}">
                <i class="fas fa-fw fa-key"></i>
                <span>
                    Permission
                </span>
            </a>
        </li>
    @endif

    @if(\App\Helpers::checkPermission('menu-role'))
        <li class="nav-item @yield('role')">
            <a class="nav-link" href="{{route('role.index')}}">
                <i class="fa-solid fa-users-rectangle"></i>
                <span>
                    Role
                </span>
            </a>
        </li>
    @endif

    @if(\App\Helpers::checkPermission('menu-user'))
        <li class="nav-item @yield('user')">
            <a class="nav-link" href="{{route('user.index')}}">
                <i class="fas fa-fw fa-users"></i>
                <span>
                    User
                </span>
            </a>
        </li>
    @endif

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Article
        </div>

    @if(\App\Helpers::checkPermission('menu-category'))
        <li class="nav-item @yield('category')">
            <a class="nav-link" href="{{route('category.index')}}">
                <i class="fas fa-fw fa-flag"></i>
                <span>
                    Category
                </span>
            </a>
        </li>
    @endif

    @if(\App\Helpers::checkPermission('menu-article'))
        <li class="nav-item @yield('article')">
            <a class="nav-link" href="{{route('article.index')}}">
                <i class="fa-regular fa-newspaper"></i>
                <span>
                    Article
                </span>
            </a>
        </li>
    @endif

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
