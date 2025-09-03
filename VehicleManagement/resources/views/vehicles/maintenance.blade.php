@extends('layouts.app')
@section('title', 'Vehicle Maintenance')
@section('content')

    <div class="container-fuild mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8"> <!-- wider but not too big -->
                <h3 class="mb-3"><i class="fa-solid fa-screwdriver-wrench"></i> Vehicle Maintenance</h3>
                <!-- Left aligned heading -->
                <div class="p-4 bg-white rounded-3 shadow-sm">
                    <form action="{{route('maintenance.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select Vehicle</label>
                            <select name="vehicle_id" class="form-select" required>
                                <option value="">Select Vehicle</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->vin ?? ($vehicle->model ?? 'Unnamed Vehicle') }}
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

    <!-- Add form -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

@endsection
