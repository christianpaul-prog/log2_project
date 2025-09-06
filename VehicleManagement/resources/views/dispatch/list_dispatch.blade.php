@extends('layouts.app')
@section('title', 'Dispatch Orders')
@section('content')
    <style>
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

        .status-badge {
            padding: 0.4em 0.8em;
            font-size: 0.85rem;
            border-radius: 0.5rem;
            transition: transform 0.2s;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }
    </style>
    <!-- Main Content -->
    <div id="MainContent" class="container-fluid slide-up">
        <div class="row">
            <div class="col-md-11">
                <h2 class="text-center my-4">VRDS - Vehicle Reservation & Dispatch System</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
                <div class="card mb-4 shadow-sm border-0">

                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: '{{ session('success') }}',
                                timer: 2000, // auto close after 2 seconds
                                showConfirmButton: false,
                                timerProgressBar: true
                            });
                        </script>
                    @endif

                    <!-- Card Header -->
                    <div class="card-header bg-primary text-white fw-bold">
                        Active Dispatch Order
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row justify-content-center mt-3">
                            <div class="d-flex justify-content-end mb-3">
                                <div class="input-group" style="max-width: 400px;">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" name="search" id="searchInput" class="form-control"
                                        placeholder="Search vehicles...">
                                </div>
                            </div>
                        </div>

                        <!-- Vehicle Table -->
                        <table id="vehicleTable" class="table table-hover table-bordered align-middle">
                            <thead class="table-primary">
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
                                        <td>{{ $trip->driver->full_name }}</td>
                                        <td>{{ $trip->vehicle->plate_no }} - {{ $trip->vehicle->model }}
                                        </td>
                                        <td>{{ $trip->reservation->drop }}</td>
                                        <td>{{ $trip->reservation->dispatch_date }} <br>
                                            <small
                                                class="text-muted">{{ date('h:i A', strtotime($trip->reservation->dispatch_time)) }}</small>
                                        </td>
                                        <td>₱{{ number_format($trip->trip_cost, 2) }}</td>
                                        <td>
                                            @if ($trip->reservation->priority_level == 'low')
                                                <span class="badge bg-warning text-dark">Low</span>
                                            @elseif ($trip->reservation->priority_level == 'medium')
                                                <span class="badge bg-success">Medium</span>
                                            @elseif ($trip->reservation->priority_level == 'high')
                                                <span class="badge bg-danger">High</span>
                                            @endif
                                        <td>
                                        <td>
                                            @if ($trip->status == 'pending')
                                                <span class="badge bg-warning text-dark status-badge">Pending</span>
                                            @elseif ($trip->status == 'on_work')
                                                <span class="badge bg-primary text-white status-badge">On Work</span>
                                            @elseif ($trip->status == 'completed')
                                                <span class="badge bg-danger text-white status-badge">Completed</span>
                                            @endif
                                        <td>
                                            <a href="" class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                                data-bs-target="#viewModal{{ $trip->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <form action="" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this dispatch order?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    title="Delete Dispatch"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    {{-- View Modal --}}
                                    <div class="modal fade" id="viewModal{{ $trip->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewModalLabel">Dispatch details
                                                        @if ($trip->status == 'pending')
                                                            <span
                                                                class="badge bg-warning text-dark status-badge">Pending</span>
                                                        @elseif ($trip->status == 'on_work')
                                                            <span class="badge bg-primary text-white status-badge">On
                                                                Work</span>
                                                        @elseif ($trip->status == 'completed')
                                                            <span
                                                                class="badge bg-danger text-white status-badge">Completed</span>
                                                        @endif
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
    <input type="hidden" value="{{ $trip->id }}">

    <!-- DRIVER INFO -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white fw-bold">
            Driver Information
        </div>
        <div class="card-body">
            <div class="row text-center mb-3">
                @if ($trip->driver && $trip->driver->photo)
                    <img src="{{ asset('uploads/' . $trip->driver->photo) }}" 
                         class="rounded-circle shadow" 
                         width="100" height="100" alt="Driver Photo">
                @else
                    <i class="fas fa-user-circle fa-5x text-muted"></i>
                @endif
            </div>
            <div class="row">
                <div class="col-md-4">
                    <strong>Full Name:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->driver->full_name }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Age:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->driver->age }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Gender:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->driver->gender }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Phone:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->driver->phone_number }}</p>
                </div>
                <div class="col-md-4">
                    <strong>License:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->driver->license_no }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Nationality:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->driver->nationality }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CLIENT INFO -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-success text-white fw-bold">
            Client Information
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <strong>Full Name:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->name }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Phone:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->phone }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Company:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->company }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Pickup:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->pickup }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Drop-off:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->drop }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Estimated Cost:</strong>
                    <p class="text-uppercase fw-bold text-success">₱{{ number_format($trip->trip_cost, 2) }}</p>
                </div>
            </div>
            <div class="mt-3">
                <strong>Purpose:</strong>
                <p class="text-uppercase text-muted">{{ $trip->reservation->purpose }}</p>
            </div>
            <div>
                <strong>Special Instruction:</strong>
                <p class="text-uppercase text-muted">{{ $trip->instruction }}</p>
            </div>
        </div>
    </div>

    <!-- VEHICLE INFO -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-dark text-white fw-bold">
            Vehicle Information
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <strong>Plate No:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->vehicle->plate_no }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Model:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->vehicle->model }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Owner:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->vehicle->owner }}</p>
                </div>
                <div class="col-md-4">
                    <strong>License No:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->vehicle->license }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Type:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->vehicle->type }}</p>
                </div>
                <div class="col-md-4">
                    <strong>Color:</strong>
                    <p class="text-uppercase text-muted">{{ $trip->reservation->vehicle->color }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

                                            </div>
                                        </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVf0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

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
                    const text = cells[j].textContent.toLowerCase();
                    if (text.includes(filter)) {
                        match = true;
                        break;
                    }
                }

                row.style.display = match ? '' : 'none';
            }
        });
    </script>
@endsection
