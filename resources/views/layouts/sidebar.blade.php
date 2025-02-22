<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()?->hasMedia('avatar'))
                    <img src="{{ auth()->user()->getFirstMediaUrl('avatar') }}" class="img-circle elevation-2"
                        alt="User Image">
                @else
                    <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth()?->user()?->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('barangays.index') }}"
                        class="nav-link {{ request()->routeIs('barangays.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marker-alt"></i>
                        <p>
                            Barangays
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('devices.index') }}"
                        class="nav-link {{ request()->routeIs('devices.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-mobile-alt"></i>
                        <p>
                            Devices
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('drivers.index') }}"
                        class="nav-link {{ request()->routeIs('drivers.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Drivers
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('incidents.index') }}"
                        class="nav-link {{ request()->routeIs('incidents.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exclamation-triangle"></i>
                        <p>
                            Incident Reports
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('settings.index') }}"
                        class="nav-link {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
