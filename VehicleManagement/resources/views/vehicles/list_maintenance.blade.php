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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        thead {
            background: #0d6efd;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.05);
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

        <!-- Main Content -->
        <div id="MainContent" class="container-fluid slide-up ">
            <div class="py-5 mb-4 text-center text-white mt-5"
                style="background: linear-gradient(135deg, #6a11cb, #2575fc); border-radius: 12px;">
                <h2 class="fw-bold mb-1"><i class="fa-solid fa-screwdriver-wrench "></i> List Maintenance</h2>
                <p class="mb-0" style="color: #fff">Manage your fleet vehicles efficiently</p>
            </div>


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
                        <div class="card-body ">
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
                            <table id="vehicleTable" class="table table-hover table-striped align-middle ">
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
                                            <td>{{ \Carbon\Carbon::parse($maintenance->start_date)->format('M d, Y') }}</td>
                                            <td>
                                                @if ($maintenance->end_date)
                                                    {{ \Carbon\Carbon::parse($maintenance->end_date)->format('M d, Y') }}
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>P{{ number_format($maintenance->cost, 2) }}</td>
                                            <td>
                                                @if ($maintenance->status == 'completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">In Progress</span>
                                                @endif
                                            </td>
                                            <td>
    @if ($maintenance->status === 'completed')
        {{-- Show Delete button --}}
        <form action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this maintenance record?')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @else
        {{-- Show Mark as Completed button --}}
        <form action="{{ route('maintenance.complete', $maintenance->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fa fa-check"></i>
            </button>
        </form>
    @endif
</td>
                                        </tr>
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
