@extends('layouts.app')
@section('title', 'Create Dispatch Order')

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

    .dispatch-card {
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        background: #fff;
        padding: 35px;
        transition: 0.3s ease;
    }

    .dispatch-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.18);
    }

    .dispatch-title {
        font-weight: bold;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .dispatch-subtitle {
        font-size: 0.95rem;
        color: #6c757d;
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
    }

    .form-control, 
    .form-select, 
    textarea {
        border-radius: 12px !important;
        padding: 10px 14px;
    }

    .btn-custom {
        border-radius: 12px;
        padding: 10px 25px;
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
</style>

<div class="container-fluid slide-up mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="dispatch-card">
                <h3 class="dispatch-title"><i class="fa-solid fa-truck-ramp-box"></i> Create Dispatch Order</h3>
                <p class="dispatch-subtitle">Fill in the form below to schedule a new dispatch order</p>
                
                <form action="{{ route('dispatch.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fa-solid fa-truck"></i> Select Vehicle</label>
                            <select name="vehicle_id" class="@error('vehicle_id') is-invalid @enderror form-select">
                                <option value="">-- Select Vehicle --</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->plate_number }} - {{ $vehicle->model }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')<div class="alert alert-danger mt-2">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fa-solid fa-user"></i> Select Driver</label>
                            <select name="driver_id" class="@error('driver_id') is-invalid @enderror form-select" required>
                                <option value="">-- Select Driver --</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->full_name }} - {{ $driver->license_no }}
                                    </option>
                                @endforeach
                            </select>
                            @error('driver_id')<div class="alert alert-danger mt-2">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fa-solid fa-globe"></i> Country</label>
                        <select name="country" class="@error('country') is-invalid @enderror form-select">
                            <option value="">-- Select Country --</option>
                            <option value="PH" {{ old('country') == 'PH' ? 'selected' : '' }}>Philippines</option>
                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United States</option>
                            <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                            <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                            <option value="AU" {{ old('country') == 'AU' ? 'selected' : '' }}>Australia</option>
                            <option value="JP" {{ old('country') == 'JP' ? 'selected' : '' }}>Japan</option>
                            <option value="CN" {{ old('country') == 'CN' ? 'selected' : '' }}>China</option>
                            <option value="IN" {{ old('country') == 'IN' ? 'selected' : '' }}>India</option>
                            <option value="DE" {{ old('country') == 'DE' ? 'selected' : '' }}>Germany</option>
                            <option value="FR" {{ old('country') == 'FR' ? 'selected' : '' }}>France</option>
                        </select>
                        @error('country')<div class="alert alert-danger mt-2">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Region</label>
                            <input type="text" name="region" value="{{ old('region') }}" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Barangay</label>
                            <input type="text" name="brgy" value="{{ old('brgy') }}" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fa-solid fa-calendar"></i> Schedule Date</label>
                            <input type="date" name="dispatch_date" value="{{ old('dispatch_date') }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fa-solid fa-clock"></i> Schedule Time</label>
                            <input type="time" name="dispatch_time" value="{{ old('dispatch_time') }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fa-solid fa-clipboard-list"></i> Special Instructions</label>
                        <textarea name="cargo_details" class="form-control" rows="3" placeholder="Enter details here...">{{ old('cargo_details') }}</textarea>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('dispatch.index') }}" class="btn btn-secondary btn-custom">
                            <i class="fa-solid fa-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="fa-solid fa-floppy-disk"></i> Save Dispatch
                        </button>
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
