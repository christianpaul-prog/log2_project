@extends('layouts.app')
@section('title', 'Vehicle Maintenance')
@section('content')

<style>
    /* Container animation */
    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    .slide-up { animation: slideUp 0.6s ease-out; }

    /* Card Styling */
    .maintenance-card {
        background: #ffffff;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
        overflow: hidden;
    }
    .maintenance-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }

    /* Header */
    .card-header-custom {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: #fff;
        padding: 20px 25px;
        border-bottom: none;
        display: flex;
        align-items: center;
        gap: 12px;
        border-radius: 25px 25px 0 0;
    }
    .card-header-custom h3 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }
    .card-header-custom i {
        font-size: 1.6rem;
        color: #ffc107;
    }

    /* Form elements */
    .form-label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    .form-control,
    .form-select,
    textarea {
        border-radius: 12px;
        border: 1px solid #dfe6e9;
        padding: 12px 15px;
        background: #f9fbfd;
        transition: all 0.3s ease;
    }
    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        border-color: #0d6efd;
        background: #fff;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.15);
    }
    textarea { resize: none; }

    /* Submit Button */
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border: none;
        border-radius: 14px;
        padding: 12px 30px;
        font-weight: 500;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7, #0a58ca);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(13,110,253,0.25);
    }

    /* Section padding */
    .form-section {
        padding: 25px 30px;
        background: #f7f9fc;
        border-radius: 0 0 25px 25px;
    }

    /* Responsive tweaks */
    @media (max-width: 576px) {
        .card-header-custom h3 { font-size: 1.3rem; }
        .btn-primary { width: 100%; padding: 12px 0; }
    }
</style>
<div class="container-fluid mt-5 slide-up">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="maintenance-card">
                <div class="card-header-custom">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <h3>Vehicle Maintenance</h3>
                </div>
                <div class="form-section">
                    <form action="{{ route('maintenance.store') }}" method="POST">
                        @csrf
                        <!-- Vehicle Selection -->
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
                            @error('vehicle_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Dates -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" required>
                                @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" required>
                                @error('end_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div class="mb-3">
                            <label class="form-label">Service Details</label>
                            <textarea name="service_details" rows="3" class="form-control @error('service_details') is-invalid @enderror" placeholder="Describe the service performed" required>{{ old('service_details') }}</textarea>
                            @error('service_details') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Cost & Type -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Cost</label>
                                <input type="number" step="0.01" name="cost" class="form-control @error('cost') is-invalid @enderror" required value="{{ old('cost') }}">
                                @error('cost') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                @error('service_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror" placeholder="Add any notes or observations." required>{{ old('notes') }}</textarea>
                            @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Submit -->
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save me-2"></i> Save Maintenance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
