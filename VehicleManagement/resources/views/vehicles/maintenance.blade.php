@extends('layouts.app')
@section('title', 'Vehicle Maintenance')
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

    /* Card Design */
    .maintenance-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .maintenance-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 28px rgba(0, 0, 0, 0.12);
    }

    /* Card Header */
    .card-header-custom {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: #fff;
        padding: 18px 24px;
        border-bottom: none;
    }

    .card-header-custom h3 {
        font-weight: 600;
        font-size: 1.4rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-header-custom h3 i {
        color: #ffc107;
    }

    /* Labels */
    .form-label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 6px;
    }

    /* Inputs & selects */
    .form-control,
    .form-select,
    textarea {
        border-radius: 10px;
        border: 1px solid #dfe6e9;
        padding: 10px 14px;
        transition: border 0.3s, box-shadow 0.3s;
        background: #f9fbfd;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        border-color: #0d6efd;
        background: #fff;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    /* Button */
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border: none;
        border-radius: 12px;
        padding: 10px 28px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7, #0a58ca);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(13, 110, 253, 0.3);
    }

    /* Notes box */
    textarea {
        resize: none;
    }
</style>

<div class="p-4 maintenance-card mt-5">
    <div class="col-md-11 mt-3">
                <h2 class="text-center my-4">Vehicle Maintenance</h2>
                <p class="text-center my-4">Manage your fleet vehicles eficiently</p>
            </div>
    <div class="card-header-custom">
        <h3><i class="fa-solid fa-screwdriver-wrench"></i> Vehicle Maintenance</h3>
    </div>
    <div class="container-fluid slide-up mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10"> 
                <div class="p-4 bg-white rounded-3">
                    <form action="{{ route('maintenance.store') }}" method="POST">
                        @csrf
                        
                        <!-- Vehicle -->
                        <div class="mb-3">
                            <label class="form-label">Select Vehicle</label>
                            <select name="vehicle_id" class="@error('vehicle_id') is-invalid @enderror form-select">
                                <option value="">Select Vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->plate_no }} - {{ $vehicle->model }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dates -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Maintenance Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Maintenance End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>

                        <!-- Service Details -->
                        <div class="mb-3">
                            <label class="form-label">Service Details</label>
                            <textarea class="form-control" rows="3" name="service_details" required placeholder="Describe the service performed"></textarea>
                        </div>

                        <!-- Cost & Type -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Cost</label>
                                <input type="number" step="0.01" name="cost" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Service Type</label>
                                <select class="form-select" name="service_type" required>
                                    <option value="">Select Service Type</option>
                                    <option value="oil_change">Oil Change</option>
                                    <option value="tire_rotation">Tire Rotation</option>
                                    <option value="brake_service">Brake Service</option>
                                    <option value="engine_service">Engine Service</option>
                                    <option value="inspection">Inspection</option>
                                </select>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="3" required name="notes"
                                placeholder="Add any notes or observations about the vehicle's condition."></textarea>
                        </div>

                        <!-- Action -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
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
