@extends('layouts.app')
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }


        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 1.5rem;
        }

        .card-header {

            background-color: #2c3c8c;
            /* sample: bootstrap primary */
            color: white;
            font-weight: 600;
            border-radius: 15px 15px 0 0;

            padding: 1rem 1.5rem;

        }

        .stats-card {
            background: #fff;
            color: #000000ff;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }



        .trip-item {
            background: rgba(248, 249, 250, 0.8);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .trip-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            font-size: 0.8rem;
            padding: 0.3rem 0.7rem;
            border-radius: 15px;
            text-align: center
        }

        .status-completed {
            background: #28a745;
        }

        .status-ongoing {
            background: #ffc107;
            color: #212529;
        }

        .status-cancelled {
            background: #dc3545;
        }

        .status-pending {
            background: #6c757d;
        }

        .performance-meter {
            background: #e9ecef;
            border-radius: 10px;
            height: 20px;
            margin: 0.5rem 0;
            overflow: hidden;
        }

        .performance-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.8s ease;
        }


        .btn-action {
            background-color: #2c3c8c;
            /* sample: bootstrap primary */
            color: white;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin: 0.2rem;
            transition: transform 0.3s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            color: white;
        }

        .filter-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .driver-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 1rem;
        }

        .slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-pills .nav-link {
            border-radius: 25px;
            margin: 0 0.2rem;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }


        .table td {
            padding: 0.8rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            /* important para di magdoble ang borders */
        }

        .table th,
        .table td {
            border: 1px solid #dee2e6;
            /* light gray lines sa gitna ng cells */
            padding: 0.8rem 1rem;
            text-align: left;
        }

        .table th {
            background-color: #5c8c9c;
            /* header background */
            color: white;
        }

         .nav-tabs .nav-link {
    color: #000 !important;   /* black */
}

/* kapag active yung tab */
.nav-tabs .nav-link.active {
    color: #000 !important;   /* black */
    background-color: #f8f9fa; /* light background */
    border-color: #dee2e6 #dee2e6 #fff;
}
    </style>
    </head>

    <body>
        <div class="container-fluid main-container">
            <div class="col-md-11 mt-5">
                <h2 class=" text-center my-4">Trip Performance Overview</h2>
                <p class="text-center my-4">Manage your Trips eficiently</p>
            </div>
            <div class="container-xl">

                <!-- Header Section -->
                <div class="row mb-4 slide-up">
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-1">{{ $totalTrips ?? 0 }}</h3>
                                    <p class="mb-0">Total Trips</p>
                                </div>
                                <i class="fas fa-road fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card success">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-1">{{ $completed ?? 0 }}</h3>
                                    <p class="mb-0">Completed</p>
                                </div>
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card warning">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-1">{{ $cancelled ?? 0 }}</h3>
                                    <p class="mb-0">Cancelled</p>
                                </div>
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card info">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-1">{{ $successRate ?? 0 }}%</h3>
                                    <p class="mb-0">Success Rate</p>
                                </div>
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs" id="mainTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="trips-tab" data-bs-toggle="tab" data-bs-target="#trips"
                        type="button" role="tab">
                        Trips Management
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="logs-tab" data-bs-toggle="tab" data-bs-target="#logs" type="button"
                        role="tab">
                        Logs
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="mainTabsContent">

                <!-- Trips Management Tab -->
                <div class="tab-pane fade show active mt-3" id="trips">
                    <div class="row">
                        <!-- Filters -->
                        <div class="col-12">
                            <div class="filter-section">
                                <div class="row align-items-center">
                                    <!-- 🔎 Driver Search Input -->
                                    <div class="col-lg-3 col-md-6 mb-2">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="text" id="driverSearch" class="form-control"
                                                placeholder="Search Driver...">
                                        </div>
                                    </div>

                                    <!-- Status Dropdown -->
                                    <div class="col-lg-3 col-md-6 mb-2">
                                        <select id="statusFilter" class="form-select">
                                            <option value="">All Status</option>
                                            <option value="Completed">Completed</option>
                                            <option value="On_work">On Work</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>

                                    <!-- Date Picker -->
                                    <div class="col-lg-3 col-md-6 mb-2">
                                        <input type="date" id="dateFilter" class="form-control">
                                    </div>

                                    <!-- Filter Button -->
                                    <div class="col-lg-3 col-md-6 mb-2">
                                        <button class="btn btn-action w-100" onclick="applyFilters()">
                                            <i class="fas fa-filter"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trips List -->
                        <div class="col-12">
                            <div class="dashboard-card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-route"></i> Recent Trips</h5>
                                </div>
                                @foreach ($shifts as $shift)
                                    <div class="card-body" id="tripList">
                                        <div class="trip-item" data-date="{{ $shift->shift_date }}">
                                            <div class="row align-items-center">
                                                <div class="col-lg-2 col-md-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="driver-avatar">
                                                            {{ $shift->driver->information->initials }}
                                                        </div>
                                                        <div>
                                                            <strong class="driver-name">
                                                                {{ $shift->driver->information->full_name }}
                                                            </strong>
                                                            <br>
                                                            <small class="text-muted vehicle-type">
                                                                {{ $shift->trip->vehicle->type }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4">
                                                    <div class="pickup-drop">
                                                        <i class="fas fa-map-marker-alt text-success"></i>
                                                        {{ $shift->trip->reservation->pickup }}
                                                        <i class="fas fa-arrow-right mx-2"></i>
                                                        <i class="fas fa-map-marker-alt text-danger"></i>
                                                        {{ $shift->trip->reservation->drop }}
                                                    </div>
                                                    <small class="text-muted dispatch-date">
                                                        {{ $shift->trip && $shift->trip->reservation && $shift->trip->reservation->dispatch_date
                                                            ? \Carbon\Carbon::parse($shift->trip->reservation->dispatch_date)->format('M d, Y - h:i A')
                                                            : 'N/A' }}
                                                    </small>
                                                </div>
                                                <div class="col-lg-2 col-md-2">
                                                    <div
                                                        class="status-text status-badge
                                        @if ($shift->trip->status == 'completed') status-completed
                                        @elseif($shift->trip->status == 'on_work') status-ongoing
                                        @elseif($shift->trip->status == 'cancelled') status-cancelled
                                        @else bg-secondary text-white @endif">
                                                        {{ ucfirst($shift->trip->status) }}
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2">
                                                    <strong class="trip-fare">
                                                        ₱{{ number_format($shift->trip->trip_cost) }}
                                                    </strong>
                                                    <br><small class="text-muted">Revenue</small>
                                                </div>
                                                <div class="col-lg-2 col-md-2">
                                                    <small class="text-muted trip-date">
                                                        {{ $shift->shift_date ? \Carbon\Carbon::parse($shift->shift_date)->format('M d, Y') : 'N/A' }}
                                                    </small>
                                                    <br>
                                                    <small class="start-time">
                                                        {{ $shift->start_time ? \Carbon\Carbon::parse($shift->start_time)->format('h:i A') : 'N/A' }}
                                                    </small>
                                                    <br>
                                                    <small class="end-time">
                                                        {{ $shift->end_time ? \Carbon\Carbon::parse($shift->end_time)->format('h:i A') : 'N/A' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        {!! $shifts->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
            <!-- Logs Tab -->
            <!-- Logs Tab -->
<div class="tab-pane fade" id="logs" role="tabpanel">
    <div class="row mt-3">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-file-alt"></i> Driver Shifts Logs</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Shift Date</th>
                                <th>Start Shift</th>
                                <th>End Shift</th>
                                <th>Earning</th>
                                <th>Details</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivershifts as $drivershift)
                                <tr>
                                    <td>{{ $drivershift->shift_date ? \Carbon\Carbon::parse($drivershift->shift_date)->format('M d, Y') : 'N/A' }}</td>
                                    <td>{{ $drivershift->start_time ? \Carbon\Carbon::parse($drivershift->start_time)->format('h:i A') : 'N/A' }}</td>
                                    <td>{{ $drivershift->end_time ? \Carbon\Carbon::parse($drivershift->end_time)->format('h:i A') : 'N/A' }}</td>
                                    <td>₱{{ number_format($drivershift->earning) }}</td>
                                    <td>Trip ID #{{ $drivershift->trip->id }} assigned to {{ $drivershift->driver->information->full_name }} and mark as {{ ucfirst($drivershift->trip->status) }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {!! $drivershifts->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Driver Performance Tab -->
        <script>
            function applyFilters() {
                let search = document.getElementById("driverSearch").value.toLowerCase();
                let status = document.getElementById("statusFilter").value.toLowerCase();
                let date = document.getElementById("dateFilter").value;

                let trips = document.querySelectorAll("#tripList .trip-item");

                trips.forEach(trip => {
                    let driver = trip.querySelector(".driver-name").innerText.toLowerCase();
                    let tripStatus = trip.querySelector(".status-text").innerText.toLowerCase();
                    let tripDate = trip.querySelector(".trip-date").innerText.trim();

                    let matchesSearch = !search || driver.includes(search);
                    let matchesStatus = !status || tripStatus.includes(status);
                    let matchesDate = !date || tripDate === date;

                    if (matchesSearch && matchesStatus && matchesDate) {
                        trip.style.display = "";
                    } else {
                        trip.style.display = "none";
                    }
                });
            }
        </script>
    @endsection
