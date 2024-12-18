<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <!-- Dashboard Item with Active Class -->
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('dashboard') }}">
                                    <span class="sub-item">Dashboard 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Components Section -->
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>

                <!-- Base Components Menu with Collapse -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Base</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">Avatars</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/typography.html">
                                    <span class="sub-item">Typography</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Markes Menu Item with Active Class Check -->
                <li class="nav-item {{ request()->routeIs('markes.index') ? 'active' : '' }}">
                    <a href="{{ route('markes.index') }}">
                        <i class="fas fa-tag"></i>
                        <p>Markes</p>
                    </a>
                </li>

                <!-- Model Cars Menu Item with Active Class Check -->
                <li class="nav-item {{ request()->routeIs('model_cars.index') ? 'active' : '' }}">
                    <a href="{{ route('model_cars.index') }}">
                        <i class="fas fa-car"></i>
                        <p>Model Cars</p>
                    </a>
                </li>

                      <!-- Model Cars Menu Item with Active Class Check -->
                      <li class="nav-item {{ request()->routeIs('cars.index') ? 'active' : '' }}">
                        <a href="{{ route('cars.index') }}">
                            <i class="fas fa-car-crash"></i>
                            <p>Manage Cars</p>
                        </a>
                    </li>
            </ul>
        </div>
    </div>
</div>
