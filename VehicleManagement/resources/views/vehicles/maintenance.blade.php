@extends('layouts.app')
@section('title', 'Vehicle Maintenance')
@section('content')

<style>
    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .slide-up { animation: slideUp 0.6s ease-out; }

    /* Header redesign (same as reservation) */
    .page-header {
        background: #fff;
        color: #000;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-header i {
        font-size: 2rem;
        color: #ffc107;
    }

    .page-header h3 {
        margin: 0;
        font-weight: bold;
        font-size: 1.6rem;
    }

    .page-header small {
        display: block;
        font-size: 0.9rem;
        opacity: 0.9;
    }
</style>

<div class="container-fluid slide-up mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Modern Page Header -->
            <div class="page-header mb-4">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <div>
                    <h3>Vehicle Maintenance</h3>
                    <small>Log and track all service records of your fleet</small>
                </div>
            </div>

            <!-- Form Card -->
            <div class="p-4 bg-white rounded-3 shadow-sm">
                <form action="{{ route('maintenance.store') }}" method="POST">
                    @csrf

                    <!-- Vehicle -->
                    <div class="mb-3">
                        <label class="form-label">Select Vehicle</label>
                        <select name="vehicle_id" class="form-select @error('vehicle_id') is-invalid @enderror">
                            <option value="">Select Vehicle</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->plate_number }} - {{ $vehicle->model }}
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_id') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
                    </div>

                    <!-- Dates -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" required>
                            @error('start_date') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" required>
                            @error('end_date') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Service Details -->
                    <div class="mb-3">
                        <label class="form-label">Service Details</label>
                        <textarea name="service_details" rows="3" class="form-control @error('service_details') is-invalid @enderror" required>{{ old('service_details') }}</textarea>
                        @error('service_details') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
                    </div>

                    <!-- Cost & Type -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Cost</label>
                            <input type="number" step="0.01" name="cost" class="form-control @error('cost') is-invalid @enderror" required value="{{ old('cost') }}">
                            @error('cost') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Service Type</label>
                            <select name="service_type" class="form-select @error('service_type') is-invalid @enderror" required>
                                <option value="">Select Service Type</option>
                                <option value="oil_change" {{ old('service_type')=='oil_change'?'selected':'' }}>Oil Change</option>
                                <option value="tire_rotation" {{ old('service_type')=='tire_rotation'?'selected':'' }}>Tire Rotation</option>
                                <option value="brake_service" {{ old('service_type')=='brake_service'?'selected':'' }}>Brake Service</option>
                                <option value="engine_service" {{ old('service_type')=='engine_service'?'selected':'' }}>Engine Service</option>
                                <option value="inspection" {{ old('service_type')=='inspection'?'selected':'' }}>Inspection</option>
                            </select>
                            @error('service_type') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror" required>{{ old('notes') }}</textarea>
                        @error('notes') <div class="alert alert-danger mt-2">{{ $message }}</div> @enderror
                    </div>

                    <!-- Submit -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-save me-2"></i> Save Maintenance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
