@extends('layouts.app')
@section('title', 'Dispatch Orders')
@section('content')
<style>
/* Container animation */
.container-fluid { transition: transform 0.3s ease, box-shadow 0.3s ease; }
@keyframes slideUp { from { transform: translateY(100px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
.slide-up { animation: slideUp 0.6s ease-out; }

/* Table styles */
.table-hover tbody tr:hover { background: rgba(0,123,255,0.05); transform: scale(1.02); transition: all 0.2s; }
 .table thead th {
    background-color: #2c3c8c;  /* sample: bootstrap primary */
    color: white;
    font-weight: 600;
 }
.table td, .table th { vertical-align: middle; }

/* Badges */
.badge { font-size:0.85rem; padding:0.5em 0.75em; border-radius:0.5rem; transition: transform 0.2s; }
.badge:hover { transform: scale(1.1); }
.badge-low { background:#ffc107;color:#212529; }
.badge-medium { background:#28a745;color:#fff; }
.badge-high { background:#dc3545;color:#fff; }
.badge-pending { background:#ffc107;color:#212529; }
.badge-onwork { background:#007bff;color:#fff; }
.badge-completed { background:#28a745;color:#fff; }

/* Buttons */
.btn-info { background:#17a2b8; border:none; }
.btn-info:hover { background:#138496; }
.btn-danger:hover { background:#c82333; }

/* Modal Cards */
.modal .card { border-radius:0.75rem; box-shadow:0 0.25rem 1rem rgba(0,0,0,0.15); }
.modal-header { background: linear-gradient(90deg,#6610f2,#007bff); color:#fff; }
</style>

<div class="container-fluid slide-up">
    <div class="row">
        <div class="col-md-11 mx-auto mt-5">
            <h2 class="text-center my-4">VRDS - Vehicle Reservation & Dispatch System</h2>

            @if(session('success'))
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

            <div class="card mb-4 shadow-sm border-0 ">
                <div class="card-header  fw-bold"style="  background: linear-gradient(135deg, #4e73df, #3751c1);color:#fff;">Active Dispatch Orders</div>
                <div class="card-body table-responsive">
                    <div class="d-flex justify-content-end mb-3">
                        <div class="input-group" style="max-width:400px;">
                            <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Search vehicles...">
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
                            @foreach($trips as $trip)
                            <tr>
                                <td>{{ $trip->driver->full_name }}</td>
                                <td>{{ $trip->vehicle->plate_no }} - {{ $trip->vehicle->model }}</td>
                                <td>{{ $trip->reservation->drop }}</td>
                                <td>{{ $trip->reservation->dispatch_date }} <br>
                                    <small class="text-muted">{{ date('h:i A', strtotime($trip->reservation->dispatch_time)) }}</small>
                                </td>
                                <td>₱{{ number_format($trip->trip_cost,2) }}</td>
                                <td>
                                    <span class="badge
                                        {{ $trip->reservation->priority_level == 'low' ? 'badge-low' : '' }}
                                        {{ $trip->reservation->priority_level == 'medium' ? 'badge-medium' : '' }}
                                        {{ $trip->reservation->priority_level == 'high' ? 'badge-high' : '' }}">
                                        {{ ucfirst($trip->reservation->priority_level) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge
                                        {{ $trip->status == 'pending' ? 'badge-pending' : '' }}
                                        {{ $trip->status == 'on_work' ? 'badge-onwork' : '' }}
                                        {{ $trip->status == 'completed' ? 'badge-completed' : '' }}">
                                        {{ str_replace('_',' ', ucfirst($trip->status)) }}
                                    </span>
                                </td>
                                <td class="d-flex gap-1">
                                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $trip->id }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                    <form action="" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this dispatch order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">{{ $trips->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
@foreach($trips as $trip)
<div class="modal fade" id="viewModal{{ $trip->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dispatch Details - {{ $trip->driver->full_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- DRIVER CARD -->
                <div class="card mb-3 shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">Driver Information</div>
                    <div class="card-body text-center">
                        @if($trip->driver && $trip->driver->photo)
                        <img src="{{ asset('uploads/' . $trip->driver->photo) }}" class="rounded-circle shadow" width="100" height="100">
                        @else
                        <i class="fas fa-user-circle fa-5x text-muted"></i>
                        @endif
                        <p class="mt-2">{{ $trip->driver->full_name }}</p>
                        <p>{{ $trip->driver->phone_number }}</p>
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
                        <p><strong>Dispatch Time:</strong> {{ date('h:i A', strtotime($trip->reservation->dispatch_time)) }}</p>
                        <p><strong>Purpose:</strong> {{ $trip->reservation->purpose }}</p>
                        <p><strong>Trip Cost:</strong> ₱{{ number_format($trip->trip_cost,2) }}</p>
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
                match = true; break;
            }
        }
        row.style.display = match ? '' : 'none';
    }
});
</script>
@endsection
