@extends('layouts.app')
@section('title', 'List Maintenance')
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

    h2 {
        font-weight: 700;
        color: #2c3e50;
    }

    p {
        color: #6c757d;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    thead {
        background: #0d6efd;
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(13,110,253,0.05);
        transition: 0.3s;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.4em 0.7em;
        border-radius: 10px;
    }

    .input-group-text {
        background-color: #0d6efd;
        color: #fff;
        border: none;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: none;
    }

    .modal-content {
        border-radius: 12px;
        animation: slideUp 0.4s ease;
    }
</style>

<!-- Main Content -->
<div id="MainContent" class="container-fluid slide-up">
    <div class="row">
        <div class="col-md-11">
            <h2 class="text-center my-4">
                <i class="fa-solid fa-screwdriver-wrench text-primary"></i> List Maintenance
            </h2>
            <p class="text-center">Manage your fleet vehicles efficiently</p>
        </div>
    </div>

    <!-- Main Content -->
    <div id="MainContent" class="container-fluid slide-up">
            <div class="py-5 mb-4 text-center text-white mt-5" 
         style="background: linear-gradient(135deg, #4e73df, #3751c1); border-radius: 12px;">
        <h2 class="fw-bold mb-1"><i class="fa-solid fa-screwdriver-wrench"></i> List Maintenance</h2>
        <p class="mb-0">Manage your fleet vehicles efficiently</p>
    </div>
       @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 2000, // auto close after 2 seconds
            showConfirmButton: false,
            timerProgressBar: true,
            width: '350px', // 👈 smaller width (default is ~500px)
            customClass: {
                popup: 'swal-small-box'
            }
        });
    </script>
@endif


    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
            });
        </script>
    @endif

    <div class="row d-flex justify-content-center">
        <div class="col-md-11">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Search -->
                    <div class="d-flex justify-content-end mb-3">
                        <div class="input-group" style="max-width: 400px;">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control"
                                placeholder="Search vehicles...">
                        </div>
                    </div>

                    <!-- Table -->
                    <table id="vehicleTable" class="table table-hover table-striped align-middle">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Plate No.</th>
                                <th>Vehicle Name</th>
                                <th>Service Info</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maintenances as $maintenance)
                                <tr>
                                    <td>{{ $maintenance->id }}</td>
                                    <td>{{ $maintenance->vehicle->plate_no ?? 'N/A' }}</td>
                                    <td>{{ $maintenance->vehicle->model ?? 'Unnamed Vehicle' }}</td>
                                    <td>{{ $maintenance->service_details }}</td>
                                    <td>{{ $maintenance->start_date }}</td>
                                    <td>{{ $maintenance->end_date }}</td>
                                    <td>P{{ number_format($maintenance->cost, 2) }}</td>
                                    <td>
                                        @if ($maintenance->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <span class="badge bg-warning text-dark">In Progress</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $maintenance->id }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{ $maintenance->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('maintenances.update', $maintenance->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" value="{{ $maintenance->id }}">

                                                    <!-- Fields (same as before) -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Select Vehicle</label>
                                                        <select class="form-select" disabled>
                                                            <option value="">Select Vehicle</option>
                                                            @foreach ($vehicles as $vehicle)
                                                                <option value="{{ $vehicle->id }}"
                                                                    {{ $maintenance->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                                                    {{ $vehicle->plate_no ?? $vehicle->model }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="vehicle_id"
                                                            value="{{ $maintenance->vehicle_id }}">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Start Date</label>
                                                            <input type="date" name="start_date" class="form-control"
                                                                value="{{ $maintenance->start_date?->format('Y-m-d') }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">End Date</label>
                                                            <input type="date" name="end_date" class="form-control"
                                                                value="{{ $maintenance->end_date?->format('Y-m-d') }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Service Details</label>
                                                        <textarea class="form-control" rows="3" readonly>{{ $maintenance->service_details }}</textarea>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Total Cost</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $maintenance->cost }}" readonly>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Service Type</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ ucfirst(str_replace('_',' ', $maintenance->service_type)) }}" readonly>
                                                        </div>
                                                 

                                                    <div class="mb-3">
                                                        <label class="form-label">Notes</label>
                                                        <textarea class="form-control" rows="3" readonly>{{ $maintenance->notes }}</textarea>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Completed</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </tbody>
                    </table>

                                    <!-- End View Edit Modal -->
                           
                            </tbody>
                        </table>
                         {!! $maintenances->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('vehicleTable');
    const rows = table.getElementsByTagName('tr');

    searchInput.addEventListener('input', function () {
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
