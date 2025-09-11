@extends('layouts.app')
@section('title', 'Create Dispatch Order')
@section('content')
    <!-- Main Content -->
    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

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
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            padding: 25px 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
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

        .btn-new {
            background: white;
            color: #2575fc;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-new:hover {
            background: #2575fc;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .filters-card {
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }

        .table-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }

        table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        thead tr {
            background-color: #2575fc;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        tbody tr {
            background-color: #fefefe;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        tbody tr:hover {
            background-color: #e0f0ff;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        tbody td {
            vertical-align: middle !important;
        }

        .badge-high {
            background-color: #ff4d4f;
        }

        .badge-medium {
            background-color: #ffa940;
            color: #212529;
        }

        .badge-low {
            background-color: #52c41a;
        }

        input::placeholder {
            color: #999;
        }

        select.form-select {
            border-radius: 8px;
        }
    </style>

    <div class="container-fluid slide-up my-5">
        <!-- Header -->
        <div class="page-header">
            <h2>Request List</h2>
        </div>

        <!-- Filters -->
        <div class="filters-card">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by name or company...">
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
            </div>
        </div>

        <!-- Table -->
        <div class="table-card p-3">
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="reservationTable">
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
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#assignModal{{ $reservation->id }}"
                                            class="btn btn-sm btn-primary me-2">
                                            Assign
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            {{-- AssignModal --}}
                            <div class="modal fade" id="assignModal{{ $reservation->id }}" tabindex="-1"
                                aria-labelledby="assignModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="assignModalLabel">Edit Request</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('trip.store', $reservation->id) }}" method="POST">
                                                @csrf

                                                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">Full Name:</label>
                                                        <input type="text"
                                                            class="@error('name') is-invalid @enderror form-control"
                                                            name="name" value="{{ old('name', $reservation->name) }}"
                                                            style="text-transform: uppercase;" readonly>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Select Vehicle</label>
                                                        <select disabled
                                                            class="@error('vehicle_id') is-invalid @enderror form-select"
                                                            id="">
                                                            <option value="">Select Vehicle</option>
                                                            @foreach ($vehicles as $vehicle)
                                                                <option value="{{ $vehicle->id }}"
                                                                    style="text-transform: uppercase;"
                                                                    {{ old('vehicle_id', $reservation->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                                                    {{ $vehicle->plate_number }} - {{ $vehicle->model }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="vehicle_id"
                                                            value="{{ $reservation->vehicle_id }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">Cost:</label>
                                                        <input type="text"
                                                            class="@error('trip_cost') is-invalid @enderror form-control"
                                                            name="trip_cost" value="{{ old('trip_cost') }}" required>
                                                        @error('trip_cost')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label
                                                            class="@error('priority_level') is-invalid @enderror form-label">Priority</label>
                                                        <select class="form-select" id="">
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
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Select Drivers</label>
                                                    <select name="driver_id"
                                                        class="@error('driver_id') is-invalid @enderror form-select"
                                                        id="">
                                                        <option value="">Select Drivers</option>
                                                        @foreach ($drivers as $driver)
                                                            <option value="{{ $driver->id }}"
                                                                {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                                                {{ $driver->full_name }} - {{ $driver->license_no }} -
                                                                {{ $driver->gender }} - {{ $driver->age }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('vehicle_id')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Special Instruction</label>
                                                    <textarea class="@error('instruction') is-invalid @enderror form-control" rows="3" required name="purpose"
                                                        placeholder="">{{ old('instruction') }}</textarea>
                                                    @error('instruction')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Assign</button>
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
                    {{ $reservations->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        const searchInput = document.getElementById("searchInput");
        const vehicleFilter = document.getElementById("vehicleFilter");
        const priorityFilter = document.getElementById("priorityFilter");
        const tableRows = document.querySelectorAll("#reservationTable tbody tr");

        function filterTable() {
            const searchText = searchInput.value.toLowerCase();
            const selectedVehicle = vehicleFilter.value.toLowerCase();
            const selectedPriority = priorityFilter.value.toLowerCase();

            tableRows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                const company = row.cells[3].textContent.toLowerCase();
                const vehicle = row.cells[4].textContent.toLowerCase();
                const priority = row.cells[8].textContent.toLowerCase();

                const matchesSearch = name.includes(searchText) || company.includes(searchText);
                const matchesVehicle = !selectedVehicle || vehicle.includes(selectedVehicle);
                const matchesPriority = !selectedPriority || priority.includes(selectedPriority);

                row.style.display = (matchesSearch && matchesVehicle && matchesPriority) ? "" : "none";
            });
        }

        searchInput.addEventListener("keyup", filterTable);
        vehicleFilter.addEventListener("change", filterTable);
        priorityFilter.addEventListener("change", filterTable);
    </script>

@endsection
