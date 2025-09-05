@extends('layouts.app')
@section('title', 'List Maintenance')
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

</style>
    <!-- Main Content -->
    <div id="MainContent" class="container-fluid slide-up">
        <div class="row">
            <div class="col-md-11">
                <h2 class="text-center my-4"><i class="fa-solid fa-screwdriver-wrench"></i> List Maintenance</h2>
                <p class="text-center my-4">Manage your fleet vehicles eficiently</p>
            </div>
        </div>
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

        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row justify-content-center mt-4">
                            <div class="d-flex justify-content-end mb-3">
                                <div class="input-group" style="max-width: 400px;">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" name="search" id="searchInput" class="form-control me-2"
                                        placeholder="Search vehicles">
                                </div>
                            </div>
                        </div>
                        <!-- ...existing code... -->
                        <table id="vehicleTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Plate no#</th>
                                    <th>Vehicle Name</th>
                                    <th>Serivice info</th>
                                    <th>Start date</th>
                                    <th>End Date</th>
                                    <th>Cost</th>
                                    <th>status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenances as $maintenance)
                                    <tr>
                                        <td>{{ $maintenance->id }}</td>
                                        <td>{{ $maintenance->vehicle->plate_no ?? 'N/A' }}</td>
                                        <td>{{ $maintenance->vehicle->model ?? 'Unnamed Vehicle' }}</td>
                                        <td>{{ $maintenance->service_details }}</td>
                                        <td>{{ $maintenance->start_date }}</td>
                                        <td>{{ $maintenance->end_date }}</td>
                                        <td>${{ number_format($maintenance->cost, 2) }}</td>
                                        <td>
                                            @if ($maintenance->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-warning">In Progress</span>
                                            @endif
                                        <td>
                                            <div class="d-flex">
                                                <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $maintenance->id }}"
                                                    class="btn btn-primary me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                    </tr>
                                    <!-- View Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $maintenance->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Update</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- Edit Form --}}
                                                    <form action="{{ route('maintenances.update', $maintenance->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id"
                                                            value="{{ $maintenance->id }}">
                                                        <div class="mb-3">
                                                            <label class="form-label">Select Vehicle</label>
                                                            <select class="form-select" disabled>
                                                                <option value="">Select Vehicle</option>
                                                                @foreach ($vehicles as $vehicle)
                                                                    <option value="{{ $vehicle->id }}"
                                                                        {{ $maintenance->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                                                        {{ $vehicle->plate_no ?? $vehicle->model }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            <!-- hidden input so the selected vehicle still gets submitted -->
                                                            <input type="hidden" name="vehicle_id" value="{{ $maintenance->vehicle_id }}">
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Maintenance Start Date</label>
                                                                <input type="date" name="start_date" class="form-control"
                                                                    value="{{ old('start_date', $maintenance->start_date ? $maintenance->start_date->format('Y-m-d') : '') }}"
                                                                    readonly>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Maintenance End Date</label>
                                                                <input type="date" name="end_date" class="form-control"
                                                                    value="{{ old('end_date', $maintenance->end_date ? $maintenance->end_date->format('Y-m-d') : '') }}"
                                                                    readonly>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Service Details</label>
                                                            <textarea class="form-control" rows="3" name="service_details" readonly
                                                                placeholder="Describe the service performed">{{ old('service_details', $maintenance->service_details) }}
                                                            </textarea>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Total Cost</label>
                                                                <input type="text" name="cost" class="form-control"
                                                                    value="{{ old('cost', $maintenance->cost) }}" readonly>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Service Type</label>
                                                                <select class="form-select" disabled>
                                                                    <option value="">Select Service Type</option>
                                                                    <option value="oil_change"
                                                                        {{ $maintenance->service_type == 'oil_change' ? 'selected' : '' }}>
                                                                        Oil Change</option>
                                                                    <option value="tire_rotation"
                                                                        {{ $maintenance->service_type == 'tire_rotation' ? 'selected' : '' }}>
                                                                        Tire Rotation</option>
                                                                    <option value="brake_service"
                                                                        {{ $maintenance->service_type == 'brake_service' ? 'selected' : '' }}>
                                                                        Brake Service</option>
                                                                    <option value="engine_service"
                                                                        {{ $maintenance->service_type == 'engine_service' ? 'selected' : '' }}>
                                                                        Engine Service</option>
                                                                    <option value="inspection"
                                                                        {{ $maintenance->service_type == 'inspection' ? 'selected' : '' }}>
                                                                        Inspection</option>
                                                                </select>

                                                                <!-- hidden input to actually submit the selected value -->
                                                                <input type="hidden" name="service_type"
                                                                    value="{{ $maintenance->service_type }}">

                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Notes</label>
                                                            <textarea class="form-control" rows="3" required name="notes" readonly
                                                                placeholder="Add any notes or observations about the vehicle's condition.">{{ old('notes', $maintenance->notes) }}
                                                            </textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Completed</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End View Edit Modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
   

    <script>
        // Search functionality for the vehicle table
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('vehicleTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();

            // Loop through table rows (skip the header row)
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let match = false;

                // Check all cells in the row
                for (let j = 0; j < cells.length; j++) {
                    const text = cells[j].textContent.toLowerCase();
                    if (text.includes(filter)) {
                        match = true;
                        break;
                    }
                }

                // Show or hide the row based on the search input
                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }

            }
        });
    </script>
@endsection
