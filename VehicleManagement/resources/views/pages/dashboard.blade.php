@extends('layouts.app')
@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-bottom: 1.5rem;
            margin-top: 1.5rem;
            transition: all .5s ease;
            color: #000000ff;

        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card .body1 {
            background: white;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .table-responsive {
            max-height: 250px;
            overflow-y: auto;
        }

        .filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .slide-up {
            animation: slideUp 0.6s ease-out;
        }

        .notification-list {
            max-height: 350px;
            overflow-y: auto;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Notification Item */
        .notification-item {
            border-left: 4px solid transparent;
            transition: all 0.2s ease-in-out;
            padding: 12px 15px;
        }

        /* Hover Effect */
        .notification-item:hover {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;

        }

        /* Scrollbar Styling */
        .notification-list::-webkit-scrollbar {
            width: 6px;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
    </style>




    <div class="container-fluid slide-up mt-4">
        <div class="col-md-11 mt-5">
            <h2 class=" my-4">Dashboard</h2>
            <p class=" my-4">Manage your fleet vehicles eficiently</p>
        </div>
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i> 
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> 
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        <!-- Stats Cards -->
        <div class="row g-4">
            <!-- Total Vehicles -->
            <div class="col-md-3">
                <div class="card shadow-lg border-0 rounded-3 " style="background: #fff;">
                    <div class="card-body">
                        <h6>Total Vehicles</h6>
                        <h3 class="fw-bold text-success">{{ $totalVehicles ?? 0 }}</h3>
                        <small>↗ includes all vehicles</small>
                    </div>
                </div>
            </div>

            <!-- Active Vehicles -->
            <div class="col-md-3">
                <div class="card shadow-lg border-0 rounded-3 " style="background: #fff;">
                    <div class="card-body">
                        <h6>Active Vehicles</h6>
                        <h3 class="fw-bold text-danger-emphasis">{{ $activeVehicles ?? 0 }}</h3>
                        <small>↗ currently running</small>
                    </div>
                </div>
            </div>

            <!-- Pending Maintenance -->
            <div class="col-md-3">
                <div class="card shadow-lg border-0 rounded-3 " style="background: #fff;">
                    <div class="card-body">
                        <h6>Pending Maintenance</h6>
                        <h3 class="fw-bold text-info-emphasis">{{ $pendingMaint ?? 0 }}</h3>
                        <small>↗ scheduled repairs</small>
                    </div>
                </div>
            </div>

            <!-- Reports -->
            <div class="col-md-3">
                <div class="card shadow-lg border-0 rounded-3 " style="background: #fff;">
                    <div class="card-body">
                        <h6>Reports</h6>
                        <h3 class="fw-bold text-primary-emphasis">{{ $reportsCount ?? 0 }}</h3>
                        <small>↗ this week</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-bar mb-3">
            <input type="text" id="notifSearch" class="form-control w-25" placeholder="Search notifications...">
            <select id="notifFilter" class="form-select w-25">
                <option value="">All</option>
                <option value="vehicle_service">Maintenance</option>
                <option value="Trip">Trip</option>
                <option value="driver_report">Report</option>
                <option value="Vehicle">Vehicle</option>
            </select>
        </div>

        <div class="row mt- ">
            <div class="col-md-11">
                <h6 class="mb-3">Notification Activities</h6>
                <ul class="list-group list-group-flush notification-list">
                    @forelse($notifications as $note)
                        <li class="list-group-item notification-item" data-type="{{ strtolower($note->type) }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge bg-primary me-2">{{ $note->type }}</span>
                                    <span>{{ $note->message }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
                                    <form action="{{ route('notifications.destroy', $note->id) }}" method="POST"
                                        class="m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-light text-danger border-0 p-0 ms-2 delete-btn">
                                            ✖
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted text-center">No notifications yet.</li>
                    @endforelse
                </ul>

            </div>
        </div>


        <div class="col-12 mt-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body" style="height: 400px;">
                    <h6 class="fw-bold">Fleet Usage Trend (Last 7 Days)</h6>
                    <canvas id="fleetChart" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>
        </div>


        <script>
          function renderFleetChart(canvasId, labels, completedData, cancelledData) {
    const ctx = document.getElementById(canvasId);
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Completed Trips',
                    data: completedData,
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.1)',
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Cancelled Trips',
                    data: cancelledData,
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    fill: true,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    min: 0,       // 🔹 Always start from 0
                    max: 100,     // 🔹 Always end at 100
                    ticks: {
                        stepSize: 10 // 🔹 Show 0,10,20,...,100
                    }
                }
            }
        }
    });
}

// Pass PHP data to JS
const labels = @json($labels);
const completedData = @json($completedData);
const cancelledData = @json($cancelledData);

renderFleetChart('fleetChart', labels, completedData, cancelledData);

            document.getElementById("notifSearch").addEventListener("keyup", function() {
                let value = this.value.toLowerCase();
                document.querySelectorAll(".notification-item").forEach(item => {
                    item.style.display = item.textContent.toLowerCase().includes(value) ? "" : "none";
                });
            });

            document.getElementById("notifFilter").addEventListener("change", function() {
                let value = this.value.toLowerCase();
                document.querySelectorAll(".notification-item").forEach(item => {
                    let type = item.getAttribute("data-type");
                    item.style.display = value === "" || type === value ? "" : "none";
                });
            });
        </script>
    @endsection
