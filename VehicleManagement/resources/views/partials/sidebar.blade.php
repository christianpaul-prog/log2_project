<aside id="sidebar">
    <div class="h-100">
        <div class="sidebar-logo border-bottom border-dark py-2">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="30" height="30" class="me-2">
            <a href="#">Logistic Dept</a>
            <span class="text-lowercase fs-6">@auth{{ auth()->user()->email }}@endauth
            </span>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Admin Elements</li>

            <li class="sidebar-item">
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <i class="fa-solid fa-list"></i> Dashboard
                </a>
            </li>

            <!-- Fleet Vehicle -->
            <li class="sidebar-item">
                <a href="#fleetVehicleMenu"
                    class="sidebar-link {{ request()->routeIs('vehicles.*', 'maintenance.*') ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('vehicles.*', 'maintenance.*') ? 'true' : 'false' }}"
                    aria-controls="fleetVehicleMenu">
                    <i class="fa-solid fa-file pe-2"></i> Fleet Vehicle
                </a>
                <ul id="fleetVehicleMenu"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('vehicles.*', 'maintenance.*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('vehicles.index') }}"
                            class="sidebar-link {{ request()->routeIs('vehicles.index') ? 'active' : '' }}">
                            Vehicles Registration
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('maintenance.index') }}"
                            class="sidebar-link {{ request()->routeIs('maintenance.index') ? 'active' : '' }}">
                            Vehicle Maintenance
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('maintenance.create') }}"
                            class="sidebar-link {{ request()->routeIs('maintenance.create') ? 'active' : '' }}">
                            Add Maintenance
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('maintenance.completed') }}"
                            class="sidebar-link {{ request()->routeIs('maintenance.completed') ? 'active' : '' }}">
                            Completed Maintenance
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Dispatch -->
            <li class="sidebar-item">
                <a href="#dispatchMenu" class="sidebar-link {{ request()->routeIs('dispatch.*') ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('dispatch.*') ? 'true' : 'false' }}"
                    aria-controls="dispatchMenu">
                    <i class="fa-solid fa-file pe-2"></i> Dispatch
                </a>
                <ul id="dispatchMenu"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('dispatch.*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="{{ route('dispatch.vehicles_drivers') }}"
                            class="sidebar-link {{ request()->routeIs('dispatch.vehicles_drivers') ? 'active' : '' }}">
                            Vehicles & Drivers
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('dispatch.index') }}"
                            class="sidebar-link {{ request()->routeIs('dispatch.index') ? 'active' : '' }}">
                            Dispatch Order List
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('dispatch.create') }}"
                            class="sidebar-link {{ request()->routeIs('dispatch.create') ? 'active' : '' }}">
                            Create Dispatch
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Analysis -->
            <li class="sidebar-item">
                <a href="#analyticMenu" class="sidebar-link {{ request()->routeIs('analysis.*') ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('analysis.*') ? 'true' : 'false' }}"
                    aria-controls="analyticMenu">
                    <i class="fa-solid fa-chart-simple pe-2"></i> Drivers Performance
                </a>
                <ul id="analyticMenu"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('analysis.*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a href="{{ route('driver.prpfile') }}"
                            class="sidebar-link {{ request()->routeIs('analysis.page1') ? 'active' : '' }}">On Dispatch</a>
                    </li>
                    <li class="sidebar-item"><a href="{{ route('driver.report')}}"
                            class="sidebar-link {{ request()->routeIs('analysis.page2') ? 'active' : '' }}">Reports</a>
                    </li>
                </ul>
            </li>

             <li class="sidebar-item">
                <a href="#analyticMenu" class="sidebar-link {{ request()->routeIs('analysis.*') ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('analysis.*') ? 'true' : 'false' }}"
                    aria-controls="analyticMenu">
                    <i class="fa-solid fa-chart-simple pe-2"></i> Cost optimization
                </a>
                <ul id="analyticMenu"
                    class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('analysis.*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a href="{{ route('costs.analytics') }}"
                            class="sidebar-link {{ request()->routeIs('analysis.page1') ? 'active' : '' }}">Analytics</a>
                    </li>
                </ul>
            </li>


            <!-- Multi Level -->
            <li class="sidebar-item">
                <a href="#multi" class="sidebar-link collapsed" data-bs-toggle="collapse" aria-expanded="false"
                    aria-controls="multi">
                    <i class="fa-solid fa-file pe-2"></i> Multi Dropdown
                </a>
                <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#level1" class="sidebar-link collapsed" data-bs-toggle="collapse" aria-expanded="false"
                            aria-controls="level1">Page 1</a>
                        <ul id="level1" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#multi">
                            <li class="sidebar-item"><a href="#" class="sidebar-link">Page 1</a></li>
                            <li class="sidebar-item"><a href="#" class="sidebar-link">Page 2</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
