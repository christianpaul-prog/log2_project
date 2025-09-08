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
 .maintenance-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .maintenance-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    /* Heading */
    h3 {
        font-weight: 600;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    h3 i {
        color: #0d6efd;
    }

    /* Labels */
    .form-label {
        font-weight: 500;
        color: #34495e;
        margin-bottom: 6px;
    }

    /* Inputs & selects */
    .form-control, .form-select, textarea {
        border-radius: 10px;
        border: 1px solid #dfe6e9;
        padding: 10px 14px;
        transition: border 0.3s, box-shadow 0.3s;
    }

    .form-control:focus, 
    .form-select:focus, 
    textarea:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    /* Button */
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        border: none;
        border-radius: 12px;
        padding: 10px 24px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0b5ed7, #0a58ca);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(13, 110, 253, 0.3);
    }
</style>
<div class="p-4 maintenance-card mt-5">
    <div class="container-fluid slide-up mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- wider but not too big -->
                <h3 class="mb-3"><i class="fa-solid fa-screwdriver-wrench"></i> Vehicle Maintenance</h3>
                <!-- Left aligned heading -->
                <div class="p-4 bg-white rounded-3 shadow-sm">
                    <form action="{{route('maintenance.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select Vehicle</label>
                            <select name="vehicle_id" class="@error('vehicle_id') is-invalid @enderror form-select"
                                    id="">
                                    <option value="">Select Vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->plate_number }} - {{ $vehicle->model }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
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

                        <div class="mb-3">
                            <label class="form-label">Service Details</label>
                            <textarea class="form-control" rows="3" name="service_details" required placeholder="Describe the service performed"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Cost</label>
                                <input type="text" name="cost" class="form-control" required>
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

                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="3" required name="notes"
                                placeholder="Add any notes or observations about the vehicle's condition."></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
