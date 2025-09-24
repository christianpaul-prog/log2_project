@extends('layouts.app')
@section('title', 'Reservation List')

@section('content')
    <!-- Main Content -->
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

        .page-header {
            background: #fff;
            color: #000;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .page-header h2 {
            margin: 0;
            font-weight: bold;
        }

        .table-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .table thead th {
            background-color: #5c8c9c;
            /* sample: bootstrap primary */
            color: white;
            font-weight: 600;
        }

        .table th {
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 20px;
            color: #fff;
        }

        .stat-card h4 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .stat-card p {
            margin: 0;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .bg-1 {
            background: #5c8c9c;
        }

        .bg-2 {
            background: #6c63ff;
        }

        .bg-3 {
            background: #28a745;
        }

        .bg-4 {
            background: #dc3545;
        }
    </style>
    <div class="container-fluid slide-up my-5">
        <!-- Header -->
        <div class="page-header text-center mb-4">
            <h2 class="fw-bold">Reservation List</h2>
            <p class="text-muted mt-2">View and manage all your reservations efficiently from one place.</p>
        </div>

        <!-- Four Card Boxes -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stat-card bg-1">
                    <h4>Total Reservations</h4>
                    <p>0</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-2">
                    <h4>Pending</h4>
                    <p>0</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-3">
                    <h4>Completed</h4>
                    <p>0</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-4">
                    <h4>Cancelled</h4>
                    <p>0</p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card p-3 mb-4 shadow-sm">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by name or company">
                    </div>
                </div>

                <div class="col-md-4">
                    <select id="vehicleFilter" class="form-select">
                        <option value="">All Vehicles Type</option>
                        <option value="suv">Suv</option>
                        <option value="truck">Truck</option>
                        <option value="sedan">Sedan</option>
                        <option value="van">Van</option>
                        <option value="motorcyle">Motorcyle</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="priorityFilter" class="form-select">
                        <option value="">All Priorities</option>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
                <div class="col-md-3 text-end">
                    <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#reservationModal">
                        <i class="bi bi-plus-circle"></i> Add Reservation
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="reservationModalLabel">Add Reservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="">Full Name:</label>
                                    <input type="text" class="@error('name') is-invalid @enderror form-control"
                                        name="name" placeholder="Enter you Full name.." value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="">Phone no:</label>
                                    <input type="number" class="@error('phone') is-invalid @enderror  form-control"
                                        name="phone" value="{{ old('phone') }}" placeholder="Enter your Phone number.."
                                        required>
                                    @error('phone')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="">Company:</label>
                                    <input type="text" class="@error('company') is-invalid @enderror  form-control"
                                        name="company" placeholder="Enter your Company.." value="{{ old('company') }}"
                                        required>
                                    @error('company')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Select Vehicle</label>
                                    <select name="vehicle_id" class="@error('vehicle_id') is-invalid @enderror form-select"
                                        id="">
                                        <option value="">Select Vehicle</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                                {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->plate_no }} - {{ $vehicle->model }} - {{ $vehicle->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_id')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Schedule Date</label>
                                    <input type="date" name="dispatch_date" value="{{ old('dispatch_date') }}"
                                        class="form-control" required>
                                    @error('dispatch_date')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Schedule Time</label>
                                    <input type="time" name="dispatch_time" value="{{ old('dispatch_time') }}"
                                        class=" form-control" required>
                                    @error('dispatch_time')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label
                                        class="@error('priority_level') is-invalid @enderror form-label">Priority</label>
                                    <select name="priority_level" class="form-select" id="">
                                        <option value="low" {{ old('priority_level') == 'low' ? 'selected' : '' }}>
                                            Low
                                        </option>
                                        <option value="medium" {{ old('priority_level') == 'medium' ? 'selected' : '' }}>
                                            Medium
                                        </option>
                                        <option value="high" {{ old('priority_level') == 'high' ? 'selected' : '' }}>
                                            High
                                        </option>
                                    </select>
                                    @error('priority_level')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pick-up Location</label>
                                    <input type="text" value="{{ old('pickup') }}"
                                        class="@error('region') is-invalid @enderror form-control" name="pickup"
                                        required>
                                    @error('pickup')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Drop-off Location</label>
                                    <input type="text" value="{{ old('drop') }}"
                                        class="@error('city') is-invalid @enderror form-control" name="drop" required>
                                    @error('drop')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Other Detail Address</label>
                                    <textarea class="@error('details') is-invalid @enderror form-control" rows="3" required name="details"
                                        placeholder="">{{ old('details') }}</textarea>
                                    @error('details')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Trip Purpose</label>
                                    <textarea class="@error('purpose') is-invalid @enderror form-control" rows="3" required name="purpose"
                                        placeholder="">{{ old('purpose') }}</textarea>
                                    @error('purpose')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    timer: 2000, // auto close after 2 seconds
                    showConfirmButton: false,
                    timerProgressBar: true,
                    width: '350px', // 👈 smaller width (default is ~500px)
                    customClass: {
                        popup: 'swal-small-box'
                    }
                });
            </script>
        @endif

        <!-- Table -->
        <div class="card table-card">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0" id="reservationTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Vehicle</th>
                            <th>Schedule</th>
                            <th>Pickup</th>
                            <th>Drop-off</th>
                            <th>Priority</th>
                            <th>Purpose</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->phone }}</td>
                                <td>{{ $reservation->company }}</td>
                                <td>{{ $reservation->vehicle->model }} - {{ $reservation->vehicle->type }}</td>
                                <td>{{ $reservation->dispatch_date }} <br>
                                    <small
                                        class="text-muted">{{ date('h:i A', strtotime($reservation->dispatch_time)) }}</small>
                                </td>
                                <td>{{ $reservation->pickup }}</td>
                                <td>{{ $reservation->drop }}</td>
                                <td>{{ $reservation->priority_level }}</td>
                                <td>{{ $reservation->purpose }}</td>
                                <td>
                                    <div class="d-flex">
                                        @php
                                            $tripStatus = $reservation->trip->status ?? null;
                                        @endphp

                                        @if (in_array($tripStatus, ['pending', 'on_work']))
                                            {{-- Disabled buttons --}}
                                            <button class="btn btn-sm btn-secondary me-2" disabled>
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary" disabled>
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @else
                                            {{-- Active buttons --}}
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $reservation->id }}"
                                                class="btn btn-sm btn-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('reservation.destroy', $reservation->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this reservation request?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    title="Delete Reservation">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>


                            {{-- editModal --}}
                            <div class="modal fade" id="editModal{{ $reservation->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Request</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('reservation.update', $reservation->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" value="">
                                                <input type="hidden" name="id" value="{{ $reservation->id }}">

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">Full Name:</label>
                                                        <input type="text"
                                                            class="@error('name') is-invalid @enderror form-control"
                                                            name="name" placeholder="Enter you Full name.."
                                                            value="{{ old('name', $reservation->name) }}" required>
                                                        @error('name')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Select Vehicle</label>
                                                        <select name="vehicle_id"
                                                            class="@error('vehicle_id') is-invalid @enderror form-select"
                                                            id="">
                                                            <option value="">Select Vehicle</option>
                                                            @foreach ($vehicles as $vehicle)
                                                                <option value="{{ $vehicle->id }}"
                                                                    {{ old('vehicle_id', $reservation->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                                                    {{ $vehicle->plate_number }} - {{ $vehicle->model }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('vehicle_id')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">Phone no:</label>
                                                        <input type="number"
                                                            class="@error('phone') is-invalid @enderror  form-control"
                                                            name="phone"
                                                            value="{{ old('phone', $reservation->phone) }}"
                                                            placeholder="Enter your Phone number.." required>
                                                        @error('phone')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">Company:</label>
                                                        <input type="text"
                                                            class="@error('company') is-invalid @enderror  form-control"
                                                            name="company" placeholder="Enter your Company.."
                                                            value="{{ old('company', $reservation->company) }}" required>
                                                        @error('company')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Schedule Date</label>
                                                        <input type="date" name="dispatch_date"
                                                            value="{{ old('dispatch_date', $reservation->dispatch_date) }}"
                                                            class="form-control" required>
                                                        @error('dispatch_date')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label">Schedule Time</label>
                                                        <input type="time" name="dispatch_time"
                                                            value="{{ old('dispatch_time', $reservation->dispatch_time) }}"
                                                            class=" form-control" required>
                                                        @error('dispatch_time')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label
                                                            class="@error('priority_level') is-invalid @enderror form-label">Priority</label>
                                                        <select name="priority_level" class="form-select" id="">
                                                            <option value="low"
                                                                {{ old('priority_level', $reservation->priority_level) == 'low' ? 'selected' : '' }}>
                                                                Low
                                                            </option>
                                                            <option value="medium"
                                                                {{ old('priority_level', $reservation->priority_level) == 'medium' ? 'selected' : '' }}>
                                                                Medium
                                                            </option>
                                                            <option value="high"
                                                                {{ old('priority_level', $reservation->priority_level) == 'high' ? 'selected' : '' }}>
                                                                High
                                                            </option>
                                                        </select>
                                                        @error('priority_level')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Pick-up Location</label>
                                                        <input type="text"
                                                            value="{{ old('pickup', $reservation->pickup) }}"
                                                            class="@error('region') is-invalid @enderror form-control"
                                                            name="pickup" required>
                                                        @error('pickup')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Drop-off Location</label>
                                                        <input type="text"
                                                            value="{{ old('drop', $reservation->drop) }}"
                                                            class="@error('city') is-invalid @enderror form-control"
                                                            name="drop" required>
                                                        @error('drop')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Other Detail Address</label>
                                                    <textarea class="@error('details') is-invalid @enderror form-control" rows="3" required name="details"
                                                        placeholder="">{{ old('details', $reservation->details) }}</textarea>
                                                    @error('details')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Trip Purpose</label>
                                                    <textarea class="@error('purpose') is-invalid @enderror form-control" rows="3" required name="purpose"
                                                        placeholder="">{{ old('purpose', $reservation->purpose) }}</textarea>
                                                    @error('purpose')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {!! $reservations->withQueryString()->links('pagination::bootstrap-5') !!}

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Reopen Add Modal if validation failed there
            @if ($errors->any() && session('modal') === 'add')
                var addModal = new bootstrap.Modal(document.getElementById("reservationModal"));
                addModal.show();
            @endif

            // Reopen Edit Modal if validation failed there
            @if ($errors->any() && old('id'))
                var editModal = new bootstrap.Modal(document.getElementById(
                     "editModal{{ $reservation->id }}"));
                editModal.show();
            @endif
        });
        // document.addEventListener("DOMContentLoaded", function() {
        //     // Reopen Edit Modal if validation failed there
        //     @if ($errors->any() && old('id'))
        //         var editModal = new bootstrap.Modal(document.getElementById(
        //             "editModal{{ $reservation->id }}"));
        //         editModal.show();
        //     @endif
        // });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            const vehicleFilter = document.getElementById("vehicleFilter");
            const priorityFilter = document.getElementById("priorityFilter");
            const table = document.getElementById("reservationTable");
            const rows = table.getElementsByTagName("tr");

            function filterTable() {
                const searchText = searchInput.value.toLowerCase().trim();
                const vehicleType = vehicleFilter.value.toLowerCase();
                const priority = priorityFilter.value.toLowerCase();

                for (let i = 1; i < rows.length; i++) { // skip header row
                    const cells = rows[i].getElementsByTagName("td");
                    if (cells.length > 0) {
                        const name = cells[1].textContent.toLowerCase();
                        const company = cells[3].textContent.toLowerCase();
                        const vehicle = cells[4].textContent.toLowerCase();
                        const priorityLevel = cells[8].textContent.toLowerCase();

                        let matchSearch =
                            name.includes(searchText) || company.includes(searchText);

                        let matchVehicle = !vehicleType || vehicle.includes(vehicleType);

                        let matchPriority = !priority || priorityLevel === priority;

                        if (matchSearch && matchVehicle && matchPriority) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                }
            }

            // Trigger filter on input/change
            searchInput.addEventListener("keyup", filterTable);
            vehicleFilter.addEventListener("change", filterTable);
            priorityFilter.addEventListener("change", filterTable);
        });
    </script>


@endsection
