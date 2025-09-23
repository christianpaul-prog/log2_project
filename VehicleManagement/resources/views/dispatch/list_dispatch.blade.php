@extends('layouts.app')
@section('title', 'Dispatch Orders')
@section('content')
    <style>
        /* Container animation */
        .container-fluid {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
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

        /* Table styles */
        .table-hover tbody tr:hover {
            background: rgba(0, 123, 255, 0.05);
            transform: scale(1.02);
            transition: all 0.2s;
        }
       .card-header{
         
    background-color: #5c8c9c;  /* sample: bootstrap primary */
    color: white;
    font-weight: 600;
       
       }

      .table thead th {
       background-color: #5c8c9c;  /* sample: bootstrap primary */
    color: white;
    font-weight: 600;
}


        .table td,
        .table th {
            vertical-align: middle;
        }


        /* Badges */
        .badge {
            font-size: 0.85rem;
            padding: 0.5em 0.75em;
            border-radius: 0.5rem;
            transition: transform 0.2s;
        }

        .badge:hover {
            transform: scale(1.1);
        }

        .badge-low {
            background: #ffc107;
            color: #212529;
        }

        .badge-medium {
            background: #28a745;
            color: #fff;
        }

        .badge-high {
            background: #dc3545;
            color: #fff;
        }

        .badge-pending {
            background: #ffc107;
            color: #212529;
        }

        .badge-onwork {
            background: #007bff;
            color: #fff;
        }

        .badge-completed {
            background: #28a745;
            color: #fff;
        }

        .badge-cancelled {
            background: #6c757d;
            color: #fff;
        }

        /* gray */
        .badge-rejected {
            background: #ff4d4d;
            color: #fff;
        }

        /* Buttons */
        .btn-info {
            background: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background: #138496;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        /* Modal Cards */
        .modal .card {
            border-radius: 0.75rem;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: linear-gradient(90deg, #6610f2, #007bff);
            color: #fff;
        }

        .page-header {
    background: #fff;
    color: #000;
    padding: 25px 20px;
    border-radius: 15px;
    margin-bottom: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.page-header:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.page-header h2 {
    margin: 0;
    font-weight: 700;
    font-size: 1.8rem;
}

.page-header p {
    margin-top: 8px;
    font-size: 1rem;
}
    </style>

    <div class="container-fluid slide-up">
        <div class="row">
            <div class="col-md-11 mx-auto">
              <div class="page-header text-center mb-4 mt-5">
    <h2 class="fw-bold">VRDS - Vehicle Reservation & Dispatch System</h2>
    <p class="text-muted mt-2">
        Manage and track all active dispatch orders. You can view driver and vehicle details, assign tasks, and monitor trip status efficiently.
    </p>
</div>

                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            width: '350px'
                        });
                    </script>
                @endif
<!-- Filters Card -->
<div class="card mb-4 shadow-sm border-0 filters-card p-3">
    <div class="row g-3 align-items-center">
        <div class="col-md-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by driver, vehicle, location...">
        </div>
        <div class="col-md-3">
            <select id="vehicleFilter" class="form-select">
                <option value="">All Vehicles</option>
                @foreach ($vehicles as $vehicle)
                    <option value="{{ strtolower($vehicle->model) }}">{{ ucfirst($vehicle->model) }} - {{ ucfirst($vehicle->plate_no) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select id="priorityFilter" class="form-select">
                <option value="">All Priorities</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="statusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="on_work">On Work</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
    </div>
</div>

                <div class="card mb-4 shadow-sm border-0 ">
                    
                    <div class="card-header text-white fw-bold">Active Dispatch Orders</div>
                    <div class="card-body table-responsive">
                        <div class="d-flex justify-content-end mb-3">
                            <div class="input-group" style="max-width:400px;">
                                <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                                <input type="text" id="searchInput" class="form-control"
                                    placeholder="Search vehicles...">
                            </div>

                        </div>
                               
                        <table id="vehicleTable" class="table table-hover table-bordered align-middle shadow-sm">
                            <thead>
                                <tr>
                                    <th>Drivers</th>
                                    <th>Vehicles</th>
                                    <th>Location</th>
                                    <th>Schedule</th>
                                    <th>Cost</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Instruction</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trips as $trip)
                                    <tr>
                                        <td>{{ $trip->information->full_name }}</td>
                                        <td>{{ $trip->vehicle->plate_no }} - {{ $trip->vehicle->model }}</td>
                                        <td>{{ $trip->reservation->drop }}</td>
                                        <td>{{ $trip->reservation->dispatch_date }} <br>
                                            <small
                                                class="text-muted">{{ date('h:i A', strtotime($trip->reservation->dispatch_time)) }}</small>
                                        </td>
                                        <td>₱{{ number_format($trip->trip_cost, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge
                                        {{ $trip->reservation->priority_level == 'low' ? 'badge-low' : '' }}
                                        {{ $trip->reservation->priority_level == 'medium' ? 'badge-medium' : '' }}
                                        {{ $trip->reservation->priority_level == 'high' ? 'badge-high' : '' }}">
                                                {{ ucfirst($trip->reservation->priority_level) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge
                                        {{ $trip->status == 'pending' ? 'badge-pending' : '' }}
                                        {{ $trip->status == 'on_work' ? 'badge-onwork' : '' }}
                                        {{ $trip->status == 'completed' ? 'badge-completed' : '' }}
                                                {{ $trip->status == 'cancelled' ? 'badge-cancelled' : '' }}
                                                {{ $trip->status == 'rejected' ? 'badge-rejected' : '' }}">
                                                {{ str_replace('_', ' ', ucfirst($trip->status)) }}
                                            </span>
                                        </td>
                                        <td class="d-flex gap-1">
                                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#viewModal{{ $trip->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <form action="{{route('trip.destroy', $trip->id)}}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this dispatch order?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {!! $trips->withQueryString()->links('pagination::bootstrap-5') !!}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @foreach ($trips as $trip)
        <div class="modal fade" id="viewModal{{ $trip->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Dispatch Details - {{ $trip->information->full_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- DRIVER CARD -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-primary text-white fw-bold">Driver Information</div>
                            <div class="card-body text-center">
                                @if ($trip->driver && $trip->driver->photo)
                                    <img src="{{ asset('uploads/' . $trip->driver->photo) }}" class="rounded-circle shadow"
                                        width="100" height="100">
                                @else
                                    <i class="fas fa-user-circle fa-5x text-muted"></i>
                                @endif
                                <p class="mt-2">{{ $trip->information->full_name }}</p>
                                <p>{{ $trip->information->phone_number }}</p>
                            </div>
                        </div>

                        <!-- VEHICLE CARD -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-dark text-white fw-bold">Vehicle Information</div>
                            <div class="card-body">
                                <p><strong>Plate:</strong> {{ $trip->vehicle->plate_no }}</p>
                                <p><strong>Model:</strong> {{ $trip->vehicle->model }}</p>
                                <p><strong>Owner:</strong> {{ $trip->vehicle->owner }}</p>
                                <p><strong>Type:</strong> {{ $trip->vehicle->type }}</p>
                                <p><strong>Color:</strong> {{ $trip->vehicle->color }}</p>
                            </div>
                        </div>

                        <!-- RESERVATION CARD -->
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header bg-success text-white fw-bold">Reservation Information</div>
                            <div class="card-body">
                                <p><strong>Client:</strong> {{ $trip->reservation->name }}</p>
                                <p><strong>Pickup:</strong> {{ $trip->reservation->pickup }}</p>
                                <p><strong>Drop:</strong> {{ $trip->reservation->drop }}</p>
                                <p><strong>Dispatch Date:</strong> {{ $trip->reservation->dispatch_date }}</p>
                                <p><strong>Dispatch Time:</strong>
                                    {{ date('h:i A', strtotime($trip->reservation->dispatch_time)) }}</p>
                                <p><strong>Purpose:</strong> {{ $trip->reservation->purpose }}</p>
                                <p><strong>Trip Cost:</strong> ₱{{ number_format($trip->trip_cost, 2) }}</p>
                                <p><strong>Instructions:</strong> {{ $trip->instruction }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // Search functionality for the vehicle table
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('vehicleTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? '' : 'none';
            }
        });

        const vehicleFilter = document.getElementById('vehicleFilter');
const priorityFilter = document.getElementById('priorityFilter');
const statusFilter = document.getElementById('statusFilter');

function filterTable() {
    const searchText = searchInput.value.toLowerCase();
    const selectedVehicle = vehicleFilter.value.toLowerCase();
    const selectedPriority = priorityFilter.value.toLowerCase();
    const selectedStatus = statusFilter.value.toLowerCase();

    for (let i = 1; i < rows.length; i++) {
        const row = rows[i];
        const cells = row.getElementsByTagName('td');

        const driver = cells[0].textContent.toLowerCase();
        const vehicle = cells[1].textContent.toLowerCase();
        const priority = cells[5].textContent.toLowerCase();
        const status = cells[6].textContent.toLowerCase();

        const matchesSearch = driver.includes(searchText) || vehicle.includes(searchText);
        const matchesVehicle = !selectedVehicle || vehicle.includes(selectedVehicle);
        const matchesPriority = !selectedPriority || priority.includes(selectedPriority);
        const matchesStatus = !selectedStatus || status.includes(selectedStatus);

        row.style.display = (matchesSearch && matchesVehicle && matchesPriority && matchesStatus) ? '' : 'none';
    }
}

searchInput.addEventListener('input', filterTable);
vehicleFilter.addEventListener('change', filterTable);
priorityFilter.addEventListener('change', filterTable);
statusFilter.addEventListener('change', filterTable);

    </script>
@endsection
