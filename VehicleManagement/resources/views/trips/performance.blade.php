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
<<<<<<< HEAD
        
    background-color: #5c8c9c;  /* sample: bootstrap primary */
    color: white;
    font-weight: 600;
        
=======
            background-color: #2c3c8c;
            /* sample: bootstrap primary */
            color: white;
            font-weight: 600;
            border-radius: 15px 15px 0 0;
>>>>>>> 014cce5d3b3d7c117d8d7ba30053bfb3fab2b506
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

        .table th {
            background: ;
            color: white;
            border: none;
            padding: 1rem;
        }

        .table td {
            padding: 0.8rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
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

            <!-- Tab Content -->
            <div class="tab-content" id="mainTabsContent">

                <!-- Trips Management Tab -->
                <div class="tab-pane fade show active" id="trips">
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
                                                <div class="col-lg-1 col-md-1">
                                                    <button class="btn btn-action btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#viewShift{{ $shift->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- View Shift Modal -->
                                    {{-- <div class="modal fade" id="viewShift{{ $shift->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Trip Details (ID: {{ $shift->id }})</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <strong>Driver:</strong><br>
                                                            {{ $shift->driver->information->full_name }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Vehicle:</strong><br>
                                                            {{ $shift->trip->vehicle->type }}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <strong>Pickup:</strong><br>
                                                            {{ $shift->trip->reservation->pickup ?? 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Drop:</strong><br>
                                                            {{ $shift->trip->reservation->drop ?? 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <strong>Status:</strong><br>
                                                            {{ ucfirst($shift->trip->status) }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Revenue:</strong><br>
                                                            ₱{{ number_format($shift->earning) }}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <strong>Shift Date:</strong><br>
                                                            {{ $shift->shift_date ? \Carbon\Carbon::parse($shift->shift_date)->format('M d, Y') : 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Dispatch Date:</strong><br>
                                                            {{ $shift->trip && $shift->trip->reservation && $shift->trip->reservation->dispatch_date
                                                                ? \Carbon\Carbon::parse($shift->trip->reservation->dispatch_date)->format('M d, Y - h:i A')
                                                                : 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <strong>Start Time:</strong><br>
                                                            {{ $shift->start_time ? \Carbon\Carbon::parse($shift->start_time)->format('h:i A') : 'N/A' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>End Time:</strong><br>
                                                            {{ $shift->end_time ? \Carbon\Carbon::parse($shift->end_time)->format('h:i A') : 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="fas fa-times"></i> Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        {{ $shifts->links() }}
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
