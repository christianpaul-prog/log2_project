@extends('layouts.apps')
@section('title', 'Create Dispatch Order')

@section('content')
    <!-- Main Content -->

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- wider but not too big -->
                <h3 class="mb-3"><i class="fa-solid fa-truck-ramp-box"></i> Create Dispatch Order</h3>
                <!-- Left aligned heading -->
                <div class="p-4 bg-white rounded-3 shadow-sm">
                    <form action="{{ route('dispatch.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Select Vehicle</label>
                                <select name="vehicle_id" class="@error('vehicle_id') is-invalid @enderror form-select" id="">
                                    <option value="">Select Vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}">{{ $vehicle->plate_number }} -
                                            {{ $vehicle->model }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle_id')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Select Driver</label>
                                <select name="driver_id" class="@error('driver_id') is-invalid @enderror form-select" required>
                                    <option value="">-- Select Driver --</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">
                                            {{ $driver->full_name }} - {{ $driver->license_no }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('driver_id')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Delivery Location</label>
                            <input type="text" name="location" class="@error('location') is-invalid @enderror form-control" placeholder="Enter delivery location"
                                required>
                            @error('location')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Schedule Date</label>
                                <input type="date" name="dispatch_date" class="@error('dispatch_date') is-invalid @enderror form-control" required>
                            @error('dispatch_date')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Schedule Time</label>
                                <input type="time" name="dispatch_time" class="@error('dispatch_time') is-invalid @enderror form-control" required>
                            @error('dispatch_time')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="@error('priority_level') is-invalid @enderror form-label">Priority</label>
                                <select name="priority_level" class="form-select" id="">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                                @error('priority_level')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Special Instruction</label>
                            <textarea class="@error('cargo_details') is-invalid @enderror form-control" rows="3" required name="cargo_details" placeholder=""></textarea>
                            @error('cargo_details')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add form -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection
