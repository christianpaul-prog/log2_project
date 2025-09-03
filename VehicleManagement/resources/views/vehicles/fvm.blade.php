@extends('layouts.app')
@section('title', 'Fleet Vehicle Management')
@section('content')

    <!-- Add Vehicle Modal -->
    <div class="modal fade" id="vehicleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="vehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vehicleModalLabel">Add new Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Add Form --}}
                    <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">License Plate</label>
                                    <input type="text" name="license"
                                        class="@error('license') is-invalid @enderror form-control" required
                                        value="{{ session('modal') === 'add' ? old('license') : '' }}">
                                    @error('license')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Model</label>
                                    <input type="text" name="model"
                                        class="@error('model') is-invalid @enderror form-control" required
                                        value="{{ session('modal') === 'add' ? old('model') : '' }}">
                                    @error('model')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">Make</label>
                                    <input type="text" name="make"
                                        class="@error('make') is-invalid @enderror form-control" required
                                        value="{{ session('modal') === 'add' ? old('make') : '' }}">
                                    @error('make')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">Type</label>
                                    <select name="type" class="@error('type') is-invalid @enderror form-select" required>
                                        <option value="">Select Type</option>
                                        <option
                                            value="sedan"{{ session('modal') === 'add' && old('type') === 'sedan' ? 'selected' : '' }}>
                                            Sedan</option>
                                        <option value="suv"
                                            {{ session('modal') === 'add' && old('type') === 'suv' ? 'selected' : '' }}>
                                            SUV</option>
                                        <option value="truck"
                                            {{ session('modal') === 'add' && old('type') === 'truck' ? 'selected' : '' }}>
                                            Truck</option>
                                        <option value="van"
                                            {{ session('modal') === 'add' && old('type') === 'van' ? 'selected' : '' }}>
                                            Van</option>
                                        <option value="motorcycle"
                                            {{ session('modal') === 'add' && old('type') === 'motorcycle' ? 'selected' : '' }}>
                                            Motorcyle</option>
                                    </select>
                                    @error('type')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">Color</label>
                                    <input name="color" type="text"
                                        class="@error('color') is-invalid @enderror form-control" required
                                        value="{{ session('modal') === 'add' ? old('color') : '' }}">
                                    @error('color')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Odemeter(km)</label>
                                    <input type="text" name="odemeter"
                                        class="@error('odemeter') is-invalid @enderror form-control" required
                                        value="{{ session('modal') === 'add' ? old('odemeter') : '' }}">
                                    @error('odemeter')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">VIN</label>
                                    <input type="text" name="vin"
                                        class=" @error('vin') is-invalid @enderror form-control" required
                                        value="{{ session('modal') === 'add' ? old('vin') : '' }}">
                                    @error('vin')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Notes</label>
                                <textarea class="@error('note') is-invalid @enderror form-control" name="note" rows="3" required>{{ session('modal') === 'add' ? old('note') : '' }}</textarea>
                                @error('note')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Vehicle Image</label>
                                <input type="file" name="image"
                                    class="@error('image') is-invalid @enderror form-control" accept="image/*">
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <div id="MainContent" class="container">
        <div class="row">
            <div class="col-md-11">
                <h2 class="text-center my-4"><i class="fa-solid fa-truck"></i>Vehicle Management</h2>
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
                        <h5 class="card-title">Vehicle List</h5>
                        <!-- ...existing code... -->
                        <div class="row justify-content-center mt-4">
                            <div class="d-flex justify-content-end mb-3">
                                <div class="input-group" style="max-width: 400px;">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" name="search" id="searchInput" class="form-control me-2"
                                        placeholder="Search vehicles">
                                    {{-- <button class="btn btn-primary" id="addVehicleBtn" type="button">AddVehicle</button> --}}
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#vehicleModal">
                                        Add Vehicle
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- ...existing code... -->
                        <table id="vehicleTable" class="table table-striped">
                            <thead>
                                <tr>

                                    <th>Vin</th>
                                    <th>Vehicle Name</th>
                                    <th>License Plate</th>
                                    <th>Odemeter(km)</th>
                                    <th>Type</th>
                                    <th>Color</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr>

                                        <td>{{ $vehicle->vin }}</td>
                                        <td>{{ $vehicle->model }}</td>
                                        <td>{{ $vehicle->license }}</td>
                                        <td>{{ $vehicle->odemeter }}</td>
                                        <td>{{ $vehicle->type }}</td>
                                        <td>{{ $vehicle->color }}</td>
                                        <td class="d-flex gap-2">
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#editVehicleModal{{ $vehicle->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger p-0"
                                                    onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                    <!-- Edit Vehicle Modal -->
                                    <div class="modal fade" id="editVehicleModal{{ $vehicle->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="editVehicleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editVehicleModalLabel">Edit Vehicle
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- Edit Form --}}
                                                    <form action="{{ route('vehicles.update', $vehicle->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <!-- Hidden input to track which vehicle -->
                                                                <input type="hidden" name="id"
                                                                    value="{{ $vehicle->id }}">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="">License Plate</label>
                                                                    <input type="text" name="license"
                                                                        class="@error('license') is-invalid @enderror form-control"
                                                                        required
                                                                        value="{{ old('license', $vehicle->license) }}">
                                                                    @error('license')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="">Model</label>
                                                                    <input type="text" name="model"
                                                                        class="@error('model') is-invalid @enderror form-control"
                                                                        required
                                                                        value="{{ old('model', $vehicle->model) }}">
                                                                    @error('model')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="">Make</label>
                                                                    <input type="text" name="make"
                                                                        class="@error('make') is-invalid @enderror form-control"
                                                                        required
                                                                        value="{{ old('make', $vehicle->make) }}">
                                                                    @error('make')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="">Type</label>
                                                                    <select name="type"
                                                                        class="@error('type') is-invalid @enderror form-select"
                                                                        required>
                                                                        <option value="">Select Type</option>
                                                                        <option value="sedan"
                                                                            {{ old('type', $vehicle->type) == 'sedan' ? 'selected' : '' }}>
                                                                            Sedan</option>
                                                                        <option
                                                                            value="suv"{{ old('type', $vehicle->type) == 'suv' ? 'selected' : '' }}>
                                                                            SUV</option>
                                                                        <option value="truck"
                                                                            {{ old('type', $vehicle->type) == 'tuck' ? 'selected' : '' }}>
                                                                            Truck</option>
                                                                        <option value="van"
                                                                            {{ old('type', $vehicle->type) == 'van' ? 'selected' : '' }}>
                                                                            Van</option>
                                                                        <option
                                                                            value="motorcycle"{{ old('type', $vehicle->type) == 'motorcycle' ? 'selected' : '' }}>
                                                                            Motorcyle</option>
                                                                    </select>
                                                                    @error('type')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <label for="">Color</label>
                                                                    <input name="color" type="text"
                                                                        class="@error('color') is-invalid @enderror form-control"
                                                                        required
                                                                        value="{{ old('color', $vehicle->color) }}">
                                                                    @error('color')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="">Odemeter(km)</label>
                                                                    <input type="text" name="odemeter"
                                                                        class="@error('odemeter') is-invalid @enderror form-control"
                                                                        required
                                                                        value="{{ old('odemeter', $vehicle->odemeter) }}">
                                                                    @error('odemeter')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="">VIN</label>
                                                                    <input type="text" name="vin"
                                                                        class=" @error('vin') is-invalid @enderror form-control"
                                                                        required value="{{ old('vin', $vehicle->vin) }}">
                                                                    @error('vin')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="">Notes</label>
                                                                <textarea class="@error('note') is-invalid @enderror form-control" name="note" rows="3" required>{{ old('note', $vehicle->note) }}</textarea>
                                                                @error('note')
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="">Vehicle Image</label>
                                                                @if ($vehicle->image)
                                                                    <div class="mb-2">
                                                                        <img src="{{ asset('uploads/' . $vehicle->image) }}"
                                                                            alt="Vehicle Image" class="img-thumbnail"
                                                                            style="max-width: 150px;">
                                                                    </div>
                                                                @endif
                                                                <input type="file" name="image"
                                                                    class="@error('image') is-invalid @enderror form-control"
                                                                    accept="image/*">
                                                                @error('image')
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Vehicle Modal -->
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        {!! $vehicles->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Reopen Add Modal if validation failed there
            @if ($errors->any() && session('modal') === 'add')
                var addModal = new bootstrap.Modal(document.getElementById("vehicleModal"));
                addModal.show();
            @endif

            // Reopen Edit Modal if validation failed there
            @if ($errors->any() && old('id'))
                var editModal = new bootstrap.Modal(document.getElementById(
                    "editVehicleModal{{ old('id') }}"));
                editModal.show();
            @endif
        });
    </script>


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
