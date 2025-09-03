@extends('layouts.app')
@section('title', 'Dispatch Orders')
@section('content')
    <!-- Main Content -->
    <div id="MainContent" class="container">
        <div class="row">
            <div class="col-md-11">
                <h2 class="text-center my-4">VRDS - Vehicle Reservation & Dispatch System</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
                <div class="card mb-4 shadow-sm border-0">

                    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 2000, // auto close after 2 seconds
            showConfirmButton: false,
            timerProgressBar: true
        });
    </script>
@endif

                    <!-- Card Header -->
                    <div class="card-header bg-primary text-white fw-bold">
                        Active Dispatch Order
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row justify-content-center mt-3">
                            <div class="d-flex justify-content-end mb-3">
                                <div class="input-group" style="max-width: 400px;">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" name="search" id="searchInput" class="form-control"
                                        placeholder="Search vehicles...">
                                </div>
                            </div>
                        </div>

                        <!-- Vehicle Table -->
                        <table id="vehicleTable" class="table table-hover table-bordered align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>Drivers</th>
                                    <th>Vehicles</th>
                                    <th>Location</th>
                                    <th>S.Date</th>
                                    <th>S.Time</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dispatches as $dispatch)
                                    <tr>
                                        <td>{{ $dispatch->driver->full_name }}</td>
                                        <td>{{ $dispatch->vehicle->license }} - {{ $dispatch->vehicle->model }}
                                        </td>
                                        <td>{{ $dispatch->country }} <br>
                                            {{ $dispatch->region }} <br>
                                            {{ $dispatch->city }} <br>
                                            {{ $dispatch->brgy }}
                                        </td>
                                        <td>{{ $dispatch->dispatch_date }}</td>
                                        <td>{{ date('h:i A', strtotime($dispatch->dispatch_time)) }}</td>
                                        <td class="text-capitalize">{{ $dispatch->priority_level }}</td>
                                        <td>
                                            @if ($dispatch->status == 'on_work')
                                                <span class="badge bg-warning text-dark">On Work</span>
                                            @elseif ($dispatch->status == 'completed')
                                                <span class="badge bg-success">Delivered</span>
                                            @elseif ($dispatch->status == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        <td>
                                            <a href="" class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                                data-bs-target="#viewModal{{ $dispatch->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <form action="{{ route('dispatch.destroy', $dispatch->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this dispatch order?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    title="Delete Dispatch"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    {{-- View Modal --}}
                                    <div class="modal fade" id="viewModal{{ $dispatch->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewModalLabel">Dispatch details
                                                        @if ($dispatch->status == 'on_work')
                                                            <span class="badge bg-warning text-dark">On Work</span>
                                                        @elseif ($dispatch->status == 'completed')
                                                            <span class="badge bg-success">Delivered</span>
                                                        @elseif ($dispatch->status == 'cancelled')
                                                            <span class="badge bg-danger">Cancelled</span>
                                                        @endif
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" value="{{ $dispatch->id }}" hidden>
                                                    <div>
                                                        <p><strong><i class="fa-solid fa-user"></i> Driver:</strong>
                                                            {{ $dispatch->driver->full_name }}
                                                        </p>
                                                        <p><strong><i class="fa-solid fa-id-card"></i> License No:</strong>
                                                            {{ $dispatch->driver->license_no }}
                                                        </p>
                                                        <p><strong><i class="fa-solid fa-phone"></i> Contact:</strong>
                                                            {{ $dispatch->driver->phone_number }}
                                                        </p>
                                                        <hr>
                                                        <p><strong><i class="fa-solid fa-car"></i> Vehicle:</strong>
                                                            {{ $dispatch->vehicle->license }} -
                                                            {{ $dispatch->vehicle->model }} </p>
                                                        <p style="text-transform: uppercase;"><strong><i
                                                                    class="fa-solid fa-car"></i> Type:</strong>
                                                            {{ $dispatch->vehicle->type }}</p>
                                                        <p><strong><i class="fa-solid fa-location-crosshairs"></i>
                                                                Country:</strong>
                                                             @if ($dispatch->country == 'PH')
                                                                    Phillipines
                                                            @elseif ($dispatch->country == 'US')
                                                                    United States
                                                            @elseif ($dispatch->country == 'CA')
                                                                    Canada
                                                            @elseif ($dispatch->country == 'UK')
                                                                    United Kingdom
                                                            @elseif ($dispatch->country == 'AU')
                                                                    Australia
                                                            @elseif ($dispatch->country == 'JP')
                                                                    Japan
                                                            @elseif ($dispatch->country == 'CN')
                                                                    China
                                                            @elseif ($dispatch->country == 'IN')
                                                                    India
                                                            @elseif ($dispatch->country == 'DE')
                                                                    Germany
                                                            @elseif ($dispatch->country == 'FR')
                                                                    
                                                            @endif
                                                        </p>
                                                        <p><strong><i class="fa-solid fa-location-crosshairs"></i>
                                                                Location:</strong>
                                                            {{ ucwords($dispatch->brgy) }} 
                                                            {{ ucwords($dispatch->city) }}
                                                            {{ ucwords($dispatch->region) }}
                                                            
                                                        </p>
                                                        <p><strong><i class="fa-solid fa-calendar-days"></i> Schedule
                                                                Date:</strong> {{ $dispatch->dispatch_date }} /
                                                            {{ date('h:i A', strtotime($dispatch->dispatch_time)) }}</p>
                                                        <p class="text-capitalize"><strong><i
                                                                    class="fa-solid fa-bars-progress"></i>
                                                                Priority:</strong>
                                                            {{ $dispatch->priority_level }}</p>
                                                        <hr>
                                                        <p><strong>Cargo Details / Special Instruction:</strong></p>
                                                        <p>{{ $dispatch->cargo_details }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVf0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        // Search functionality for the vehicle table
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('vehicleTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    const text = cells[j].textContent.toLowerCase();
                    if (text.includes(filter)) {
                        match = true;
                        break;
                    }
                }

                row.style.display = match ? '' : 'none';
            }
        });
    </script>
@endsection
