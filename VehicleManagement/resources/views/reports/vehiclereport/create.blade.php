@extends('layouts.app')

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

    .vehicle-form-card {
        max-width: 1000px; /* wider for landscape */
        margin: auto;
        border-radius: 20px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        padding: 30px;
        background: #fff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .vehicle-form-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .form-label {
        font-weight: 600;
    }
    .form-control, .form-select {
        border-radius: 12px;
        padding: 10px 14px;
    }
    .btn-custom {
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 600;
    }
    .form-header {
        text-align: center;
        margin-bottom: 25px;
    }
    .form-header h2 {
        font-weight: bold;
    }
    .form-header p {
        color: #6c757d;
        font-size: 15px;
    }
    /* Grid layout for landscape style */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px 30px;
    }
    .form-grid .full-width {
        grid-column: span 2;
    }
</style>

<div class="container-fluid slide-up mt-5">
    <div class="vehicle-form-card">
        <div class="form-header">
            <h2><i class="fa-solid fa-car"></i> Add Vehicle</h2>
            <p>Vehicle Reports For Maintenance Cost</p>
        </div>

        <form action="{{ route('reports.vehiclereport.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div>
                    <label class="form-label"><i class="fa-solid fa-id-card"></i> Plate Number</label>
                    <input type="text" name="plate_number" class="form-control" placeholder="e.g. ABC-1234" required>
                </div>
                <div>
                    <label class="form-label"><i class="fa-solid fa-industry"></i> Brand</label>
                    <input type="text" name="brand" class="form-control" placeholder="e.g. Toyota">
                </div>

                <div>
                    <label class="form-label"><i class="fa-solid fa-car-side"></i> Model</label>
                    <input type="text" name="model" class="form-control" placeholder="e.g. Vios">
                </div>
                <div>
                    <label class="form-label"><i class="fa-solid fa-calendar"></i> Year</label>
                    <input type="number" name="year" class="form-control" min="1900" max="{{ date('Y') }}" placeholder="e.g. 2020">
                </div>

                <div>
                    <label class="form-label"><i class="fa-solid fa-palette"></i> Color</label>
                    <input type="text" name="color" class="form-control" placeholder="e.g. Red">
                </div>
                <div>
                    <label class="form-label"><i class="fa-solid fa-road"></i> Mileage (km)</label>
                    <input type="number" name="mileage" class="form-control" value="0">
                </div>

                <div class="full-width">
                    <label class="form-label"><i class="fa-solid fa-align-left"></i> Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Description Reports"></textarea>
                </div>

                <div class="full-width">
                    <label class="form-label"><i class="fa-solid fa-gear"></i> Status</label>
                    <select name="status" class="form-select">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Under Maintenance">Under Maintenance</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('reports.vehiclereport.index') }}" class="btn btn-secondary btn-custom">
                    <i class="fa-solid fa-arrow-left"></i> Cancel
                </a>
                <button type="submit" class="btn btn-success btn-custom">
                    <i class="fa-solid fa-save"></i> Save Vehicle
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
