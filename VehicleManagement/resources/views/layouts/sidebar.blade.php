<div>
    <h2 class="text-white text-center">Dashboard</h2>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('dashboard')}}"><i class="fa-solid fa-house"></i> Home</a>
        </li>
        <!-- Dropdown -->
        <li class="nav-item ">
            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#submenu1" role="button"
                aria-expanded="false">
                <i class="fa-solid fa-truck"></i> FVM
            </a>
            <div class="collapse" id="submenu1">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ">
                    <li><a href="{{ route('vehicles.index') }}" class="nav-link">- Vehicle Registration</a></li>
                    <li><a href="{{ route('maintenance.index') }}" class="nav-link">- Maintenance list</a></li>
                    <li><a href="{{ route('maintenance.create') }}" class="nav-link">- Add Maintenance</a></li>
                    <li><a href="{{ route('maintenances.completed') }}" class="nav-link">- Completed list</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#submenu2" role="button"
                aria-expanded="false">
                <i class="fa-solid fa-truck-ramp-box"></i> VRDS
            </a>
            <div class="collapse" id="submenu2">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('dispatch.vehicles_drivers')}}" class="nav-link">- Vehicles & Drivers</a></li>
                    <li><a href="{{route('dispatch.index')}}" class="nav-link">- Dispatch Order List</a></li>
                    <li><a href="{{route('dispatch.create')}}" class="nav-link">- Create Dispatch Order</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#submenu3" role="button"
                aria-expanded="false">
                <i class="fa-solid fa-file"></i> Driver & Performance
            </a>
            <div class="collapse" id="submenu3">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link">- Reports</a></li>
                    <li><a href="#" class="nav-link">- Projects</a></li>
                    <li><a href="#" class="nav-link">- Calendar</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#submenu4" role="button"
                aria-expanded="false">
                <i class="fa-solid fa-chart-area"></i> TACAO
            </a>
            <div class="collapse" id="submenu4">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="nav-link">- Size</a></li>
                    <li><a href="#" class="nav-link">- List</a></li>
                    <li><a href="#" class="nav-link">- Completed</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">⚙️ Settings</a>
        </li>

    </ul>
</div>
<!-- Logout at bottom -->
<div class="button text-center">
    <a class="nav-link" href="#"><i class="fa-solid fa-user"></i> Profile</a>
    <a class="nav-link text-danger fw-bold" href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>
        Logout</a>

</div>
