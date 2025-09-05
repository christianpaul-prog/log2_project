@extends('layouts.app')
@section('title', 'Vehicles and Drivers')
@section('content')
    <style>
        body {
            background-color: #f5f6f8;
        }

        .section-box {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .item-card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #ffffff;
            transition: all 0.3s ease;
        }

        .item-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            background-color: #f8fbff;
        }

        .circle-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #dee2e6;
        }

        .status-text {
            font-weight: 600;
            color: #28a745;
        }

        .badge-custom {
            background-color: #343a40;
            color: #fff;
            font-size: 0.9rem;
            border-radius: 8px;
            padding: 6px 10px;
            display: inline-block;
            text-align: left;
            line-height: 1.4;
        }
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

    </style>
    <div class="container-fluid slide-up">
        <div class="mt-3">
            <h1 class="mb-2">Vehicles and Drivers</h1>
            <p class="text-muted">Manage your fleet and assigned drivers</p>
        </div>
        <hr>
        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Search vehicles or drivers...">
        </div>
        <div class="row">
            <!-- Vehicles Section -->
            <div class="col-md-6">
                <div class="section-box">
                    <h3 class="mb-3 p-2 text-white bg-primary rounded">
                        <i class="fa-solid fa-car-side"></i> Vehicles
                    </h3>
                    @foreach ($vehicles as $vehicle)
                        <div class="item-card">
                            <div class="row align-items-center">
                                <div class="col-4 text-center">
                                    {{-- <img src="op.jpg" class="circle-img"> --}}
                                    @if ($vehicle->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('uploads/' . $vehicle->image) }}" class="circle-img">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-5">
                                    <h5 class="mb-1">{{ $vehicle->model }}</h5>
                                    <span class="badge-custom">
                                        <i class="fa-solid fa-car-side"></i> {{ $vehicle->type }}<br>
                                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $vehicle->odemeter }} km<br>
                                        <i class="fa-solid fa-barcode"></i> VIN: {{ $vehicle->vin }}<br>
                                    </span>
                                </div>
                                <div class="col-3 text-center">
                                    <p class="status-text">Active</p>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#viewVehicleModal{{ $vehicle->id }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- viewModal --}}
                        <div class="modal fade" id="viewVehicleModal{{ $vehicle->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewVehicleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewVehicleModalLabel">Vehicles Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" value="{{ $vehicle->id }}">
                                        <div>
                                            <div class="text-center">
                                                @if ($vehicle->image)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('uploads/' . $vehicle->image) }}"
                                                            class="circle-img"> <br>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row text-center">
                                                <div class="col-md-4 mb-3">
                                                    <p><strong>Model:</strong>
                                                       <br> {{ $vehicle->model }}</p>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <p><strong>License:</strong>
                                                       <br> {{ $vehicle->license }} km</p>
                                                </div>
                                                 <div class="col-md-4 mb-3">
                                                    <p><strong>Make:</strong>
                                                       <br> {{ $vehicle->make }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row text-center">
                                                 <div class="col-md-4 mb-3">
                                                    <p><strong>Color:</strong>
                                                       <br> {{ $vehicle->color }}</p>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <p><strong>VIN:</strong>
                                                      <br>  {{ $vehicle->vin }}</p>
                                                </div>
                                                    <div class="col-md-4 mb-3">
                                                        <p><strong>Type:</strong>
                                                         <br>   {{ $vehicle->type }}</p>
                                                    </div>
                                            </div>
                                            <hr>
                                            <div class="row text-center">
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>Notes:</strong>
                                                      <br>  {{ $vehicle->note }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>Odemeter:</strong>
                                                      <br>  {{ $vehicle->odemeter }} km </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforEach
                </div>
            </div>

            <!-- Drivers Section -->
            <div class="col-md-6">
                <div class="section-box">
                    <h3 class="mb-3 p-2 text-white bg-primary rounded">
                        <i class="fa-solid fa-id-badge"></i> Drivers
                    </h3>
                    @foreach ($drivers as $driver)
                        <div class="item-card">
                            <div class="row align-items-center">
                                <div class="col-4 text-center">
                                    <img src="us.jpg" class="circle-img">
                                </div>
                                <div class="col-5">
                                    <h5 class="mb-1">{{$driver->full_name}}</h5>
                                    <span class="badge-custom">
                                        <i class="fa-solid fa-id-card"></i> License: {{$driver->license_no}}<br>
                                        <i class="fa-solid fa-phone"></i> {{$driver->phone_number}}<br>
                                    </span>
                                </div>
                                <div class="col-3 text-center">
                                    <p class="status-text">Active</p>
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#viewDriversModal{{ $driver->id }}">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- viewModal --}}
                        <div class="modal fade" id="viewDriversModal{{$driver->id}}" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="viewDrivereModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewDrivereModalLabel">Drivers Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" value="{{ $driver->id }}">
                                        <div>
                                            <div class="text-center">
                                                @if ($driver->photo)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('uploads/' . $driver->photo) }}"
                                                            class="circle-img"> <br>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-center">
                                              <p><strong>Full Name:</strong> {{$driver->fullname}}</p>
                                              <p><strong>Age:</strong> {{$driver->age}}</p>
                                              <p><strong>Gender:</strong> {{$driver->gender}}</p>
                                              <p><strong>Place of Birth:</strong> {{$driver->place_of_birth}}</p>
                                                <p><strong>Nationality:</strong> {{$driver->nationality}}</p>
                                            <hr>
                                            <p><strong>Phone #:</strong> {{$driver->phone_number}}</p>
                                            <p><strong>Address:</strong> {{$driver->address}}</p>
                                            <p><strong>License #:</strong> {{$driver->license_no}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforEach
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
   

    <script>
        // Get input field
        const searchInput = document.getElementById("searchInput");

        searchInput.addEventListener("keyup", function() {
            let filter = searchInput.value.toLowerCase();
            let items = document.querySelectorAll(".item-card"); // all cards

            items.forEach(function(item) {
                let text = item.innerText.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });
    </script>
@endsection
