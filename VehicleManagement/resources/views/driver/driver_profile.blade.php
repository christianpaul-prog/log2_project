@extends('layouts.app')
@section('title', 'Drivers Profile')
@section('content')
    <style>
        body {
            background-color: #f5f6f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-header {
            text-align: center;
            margin: 30px 0;
        }

        .page-header h1 {
            font-weight: 700;
            color: #343a40;
        }

        .filter-bar {
            background: #ffffff;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .section-box {
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .section-box h3 {
            background: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 1.2rem;
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
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
            background-color: #f8fbff;
        }

        .circle-img {
            width: 80px;
            height: 80px;
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
            font-size: 0.85rem;
            border-radius: 8px;
            padding: 6px 10px;
            display: inline-block;
            line-height: 1.4;
        }
    </style>

    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h1>🚚 Drivers Performance</h1>
            <p class="text-muted">Manage your fleet and assigned drivers with ease</p>
        </div>

        <!-- Filter bar -->
        <div class="filter-bar">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search vehicles or drivers...">
                </div>
                <div class="col-md-2 mb-2">
                    <select class="form-control" name="country" id="countryFilter">
                        <option value="">Country</option>
                      @foreach ($dispatches as $dispatche)
                        <option value="{{ $dispatche->country }}">
                            {{ $dispatche->country }}
                          </option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <select class="form-control" name="region" id="regionFilter">
                        <option value="">Region</option>
                      @foreach ($dispatches as $dispatche)
                        <option value="{{ $dispatche->region }}">
                            {{ ucwords($dispatche->region) }}
                          </option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <select class="form-control" name="region" id="cityFilter">
                        <option value="">City</option>
                      @foreach ($dispatches as $dispatche)
                        <option value="{{ $dispatche->city }}">
                            {{ ucwords($dispatche->city) }}
                          </option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <select class="form-control" name="region" id="barangayFilter">
                        <option value="">Barangay</option>
                      @foreach ($dispatches as $dispatche)
                        <option value="{{ $dispatche->brgy }}">
                            {{ ucwords($dispatche->brgy) }}
                          </option>
                      @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Drivers Section -->
        <div class="section-box">
            <h3><i class="fa-solid fa-id-badge"></i> Drivers</h3>

            @foreach ($dispatches as $dispatche)
                <div class="item-card"
                 data-country="{{ $dispatche->country ?? '' }}"
        data-region="{{ $dispatche->region ?? '' }}"
        data-city="{{ $dispatche->city ?? '' }}"
        data-barangay="{{ $dispatche->brgy ?? '' }}">
                    <div class="row align-items-center">
                        <div class="col-3 text-center">
                            <img src="us.jpg" class="circle-img" alt="Driver">
                        </div>
                        <div class="col-6">
                            <h5 class="mb-1">{{ $dispatche->driver->full_name }}</h5>
                            <span class="badge-custom d-block mb-1"><i class="fa-solid fa-id-card"></i> License:
                                {{ $dispatche->driver->license_no }}</span>
                            <span class="badge-custom d-block mb-1"><i class="fa-solid fa-phone"></i>
                                {{ $dispatche->driver->phone_number }}</span>
                            <span class="badge-custom d-block"><i class="fa-solid fa-envelope"></i>
                                {{ $dispatche->driver->email ?? 'No Email' }}</span>
                        </div>
                        <div class="col-3 text-center">
                            <button class="btn btn-sm btn-outline-primary"><i class="fa-regular fa-eye"></i> View</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    const searchInput = document.getElementById("searchInput");
    const countryFilter = document.getElementById("countryFilter");
    const regionFilter = document.getElementById("regionFilter");
    const cityFilter = document.getElementById("cityFilter");
    const barangayFilter = document.getElementById("barangayFilter");

    function filterDrivers() {
        let searchText = searchInput.value.toLowerCase();
        let country = countryFilter.value.toLowerCase();
        let region = regionFilter.value.toLowerCase();
        let city = cityFilter.value.toLowerCase();
        let barangay = barangayFilter.value.toLowerCase();

        document.querySelectorAll(".item-card").forEach(function(item) {
            let text = item.innerText.toLowerCase();
            let itemCountry = (item.dataset.country || "").toLowerCase();
            let itemRegion = (item.dataset.region || "").toLowerCase();
            let itemCity = (item.dataset.city || "").toLowerCase();
            let itemBarangay = (item.dataset.barangay || "").toLowerCase();

            let matchesSearch = text.includes(searchText);
            let matchesCountry = !country || itemCountry === country;
            let matchesRegion = !region || itemRegion === region;
            let matchesCity = !city || itemCity === city;
            let matchesBarangay = !barangay || itemBarangay === barangay;

            if (matchesSearch && matchesCountry && matchesRegion && matchesCity && matchesBarangay) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    }

    // Event listeners
    searchInput.addEventListener("keyup", filterDrivers);
    countryFilter.addEventListener("change", filterDrivers);
    regionFilter.addEventListener("change", filterDrivers);
    cityFilter.addEventListener("change", filterDrivers);
    barangayFilter.addEventListener("change", filterDrivers);
</script>

@endsection
