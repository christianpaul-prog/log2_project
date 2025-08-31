@extends('layouts.apps')
@section('title', 'Completed List')
@section('content')
    <!-- Main Content -->
    <div id="MainContent" class="container">
        <div class="row">
            <div class="col-md-11">
                <h2 class="text-center my-4"><i class="fa-solid fa-screwdriver-wrench"></i> Completed List</h2>
                <p class="text-center my-4">Manage your fleet vehicles eficiently</p>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row justify-content-center mt-4">
                            <div class="d-flex justify-content-end mb-3">
                                <div class="input-group" style="max-width: 400px;">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" name="search" id="searchInput" class="form-control me-2"
                                        placeholder="Search vehicles">
                                </div>
                            </div>
                        </div>
                        <!-- ...existing code... -->
                        <table id="vehicleTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Vin</th>
                                    <th>Vehicle Name</th>
                                    <th>Serivice info</th>
                                    <th>Start date</th>
                                    <th>End Date</th>
                                    <th>Cost</th>
                                    <th>status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maintenances as $maintenance)
                                    <tr>
                                        <td>{{ $maintenance->id }}</td>
                                        <td>{{ $maintenance->vehicle->vin ?? 'N/A' }}</td>
                                        <td>{{ $maintenance->vehicle->model ?? 'Unnamed Vehicle' }}</td>
                                        <td>{{ $maintenance->service_details }}</td>
                                        <td>{{ $maintenance->start_date }}</td>
                                        <td>{{ $maintenance->end_date }}</td>
                                        <td>${{ number_format($maintenance->cost, 2) }}</td>
                                        <td>
                                            @if ($maintenance->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-warning">In Progress</span>
                                            @endif
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('maintenance.destroy', $maintenance->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure you want to delete this maintenance record?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                            </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <script>
        // Search functionality for the vehicle table
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('vehicleTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();

            // Loop through table rows (skip the header row)
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let match = false;

                // Check all cells in the row
                for (let j = 0; j < cells.length; j++) {
                    const text = cells[j].textContent.toLowerCase();
                    if (text.includes(filter)) {
                        match = true;
                        break;
                    }
                }

                // Show or hide the row based on the search input
                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }

            }
        });
    </script>
@endsection
