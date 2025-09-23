@extends('layouts.app')
@section('title', 'Reserve Vehicles')

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

        /* Header redesign */
        .page-header {
              background: linear-gradient(135deg, #4e73df, #3751c1);
            color: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-header i {
            font-size: 2rem;
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
                    <i class="fa-solid fa-truck-ramp-box"></i>
                    <div>
                        <h3>Create Reservation</h3>
                        <small>Fill out the details below to schedule a new dispatch</small>
                    </div>
                </div>

                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            width: '350px'
                        });
                    </script>
                @endif

                <!-- Form Card -->
                <div class="p-4 bg-white rounded-3 shadow-sm">
                    <form action="{{ route('reservation.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="">Full Name:</label>
                                <input type="text" class="@error('name') is-invalid @enderror form-control" name="name" placeholder="Enter you Full name.." value="{{ old('name') }}"
                                required>
                                @error('name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Select Vehicle</label>
                                <select name="vehicle_id" class="@error('vehicle_id') is-invalid @enderror form-select"
                                    id="">
                                    <option value="">Select Vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->plate_no }} - {{ $vehicle->model }} - {{ $vehicle->type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vehicle_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="">Phone no:</label>
                                <input type="number" class="@error('phone') is-invalid @enderror  form-control" name="phone" value="{{ old('phone') }}"
                                    placeholder="Enter your Phone number.." required>
                                    @error('phone')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="">Company:</label>
                                <input type="text" class="@error('company') is-invalid @enderror  form-control" name="company" placeholder="Enter your Company.."
                                    value="{{ old('company') }}" required>
                                    @error('company')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Schedule Date</label>
                                <input type="date" name="dispatch_date" value="{{ old('dispatch_date') }}" class="form-control" required>
                                @error('dispatch_date')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Schedule Time</label>
                                <input type="time" name="dispatch_time" value="{{ old('dispatch_time') }}" class=" form-control" required>
                                 @error('dispatch_time')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="@error('priority_level') is-invalid @enderror form-label">Priority</label>
                                <select name="priority_level" class="form-select" id="">
                                    <option value="low" {{ old('priority_level')=='low' ? 'selected' : '' }}>
                                        Low
                                    </option>
                                    <option value="medium" {{ old('priority_level')=='medium' ? 'selected' : '' }}>
                                        Medium
                                    </option>
                                    <option value="high" {{ old('priority_level')=='high' ? 'selected' : '' }}>
                                        High
                                    </option>
                                </select>
                                 @error('priority_level')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pick-up Location</label>
                                <input type="text" value="{{ old('pickup') }}" class="@error('region') is-invalid @enderror form-control" name="pickup" required>
                                @error('pickup')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Drop-off Location</label>
                                <input type="text" value="{{ old('drop') }}" class="@error('city') is-invalid @enderror form-control" name="drop" required>
                                @error('drop')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                             <label class="form-label">Other Detail Address</label>
                            <textarea class="@error('details') is-invalid @enderror form-control" rows="3" required name="details"
                                placeholder="">{{ old('details') }}</textarea>
                                @error('details')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                             <label class="form-label">Trip Purpose</label>
                            <textarea class="@error('purpose') is-invalid @enderror form-control" rows="3" required name="purpose"
                                placeholder="">{{ old('purpose') }}</textarea>
                                @error('purpose')
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

@endsection
