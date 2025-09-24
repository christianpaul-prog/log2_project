@extends('layouts.app')
@section('title', 'Driver Reports')
@section('content')
<style>
     .container-fluid{
         animation: fadeIn 0.4s ease-in-out;
    }
       @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
       .table thead th {
    background-color: #5c8c9c;  /* sample: bootstrap primary */
    color: white;
    font-weight: 600;
         }
         .page-header {
      background: #fff;
        color: #000;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.page-header:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.page-header h2 {
    font-size: 1.8rem;
    margin: 0;
}

.page-header p {
    margin-top: 8px;
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.85);
}
</style>
<div class="container-fluid mt-5">

    <!-- Header -->
   <div class="page-header text-center mb-4 mt-5 p-4">
    <h2 class="fw-bold mb-1">
        <i class="fa-solid fa-truck-fast me-2"></i> Dispatch Orders Overview
    </h2>
    <p class="mb-0 text-muted">Manage, track, and monitor all active dispatch orders efficiently</p>
</div>


<div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 text-center p-3">
                <h6 class="text-muted mb-1">Total Reports</h6>
                <h4 class="fw-bold text-primary">{{ $reports->total() }}</h4>
                 <small class="text-muted">All generated reports</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 text-center p-3">
                <h6 class="text-muted mb-1">Completed</h6>
                <h4 class="fw-bold text-success">
                    {{ $reports->where('status_report', 'completed')->count() }}
                </h4>
                 <small class="text-muted">Successfully closed trips</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 text-center p-3">
                <h6 class="text-muted mb-1">Pending</h6>
                <h4 class="fw-bold text-info">
                    {{ $reports->where('status_report', 'pending')->count() }}
                </h4>
                  <small class="text-muted">Awaiting confirmation</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 text-center p-3">
                <h6 class="text-muted mb-1">Cancelled</h6>
                <h4 class="fw-bold text-danger">
                    {{ $reports->where('status_report', 'cancelled')->count() }}
                </h4>
                     <small class="text-muted">Trips that were aborted</small>
            </div>
        </div>
    </div>
<div class="card-container p-4 bg-white shadow-sm rounded-4 mb-4">
    <div class="filter-box mb-3">
    <div class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label fw-semibold">Driver Name</label>
            <input type="text" id="filterDriver" class="form-control" placeholder="Search driver...">
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Status</label>
            <select id="filterStatus" class="form-select">
                <option value="">All</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
                <option value="cancelled">Cancelled</option>
                <option value="delayed">Delayed</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-semibold">Date</label>
            <input type="date" id="filterDate" class="form-control">
        </div>
        <div class="col-md-2 d-grid">
            <button type="button" class="btn btn-primary" id="applyFilter">
                <i class="fa-solid fa-filter me-1"></i> Filter
            </button>
        </div>
    </div>
</div>
</div>

    <!-- Reports Card -->
    <div class="card shadow border-0 rounded-4 mt-5">
        <div class="card-body p-4">
            
            <div class="table-responsive">
                <table id="reportsTable" class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th><i class="fa-solid fa-user me-1"></i> Driver</th>
                            <th><i class="fa-solid fa-id-card me-1"></i> License</th>
                            <th><i class="fa-solid fa-circle me-1"></i> Status</th>
                            <th><i class="fa-solid fa-road me-1"></i> Report</th>
                            <th><i class="fa-solid fa-peso-sign me-1"></i> Fuel</th>
                            <th><i class="fa-solid fa-coins me-1"></i> Dispatch Cost</th>
                            <th class="text-center"><i class="fa-solid fa-gear me-1"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
    <td class="driver fw-semibold">{{ $report->driver->information->full_name ?? 'N/A' }}</td>
    <td>{{ $report->driver->information->license_no ?? 'N/A' }}</td>
    <td class="status">
        <span class="badge 
            @if ($report->status_report == 'completed') bg-success
            @elseif($report->status_report == 'cancelled') bg-danger
            @elseif($report->status_report == 'delayed') bg-warning text-dark
            @elseif($report->status_report == 'pending') bg-info text-dark
            @else bg-secondary @endif">
            {{ ucfirst($report->status_report) }}
        </span>
    </td>
    <td class="report-date">{{ $report->created_at->format('Y-m-d') }}</td>
    <td class="fw-bold text-secondary">₱{{ number_format($report->fuel, 2) }}</td>
    <td class="fw-bold text-danger">₱{{ number_format($report->dispatch_cost, 2) }}</td>
    <td class="text-center">
        <!-- View Button -->
        <button class="btn btn-sm btn-light border me-1" data-bs-toggle="modal"
            data-bs-target="#viewModal{{ $report->id }}">
            <i class="fa-regular fa-eye text-primary"></i>
        </button>
        <!-- Delete Button -->
       <form action="{{ route('driver.destroy', $report->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border"
                                            onclick="return confirm('Are you sure you want to delete this report?');">
                                            <i class="fa-regular fa-trash-can text-danger"></i>
                                        </button>
                                    </form>
    </td>
</tr>


                            <!-- View Report Modal -->
                            <div class="modal fade" id="viewModal{{ $report->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content rounded-4 shadow">
                                        <div class="modal-header bg-primary text-white rounded-top-4">
                                            <h5 class="modal-title">
                                                <i class="fa-solid fa-file-alt me-2"></i> Report Details
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="fw-bold">{{ $report->title }}</h5>
                                            <p class="text-muted">{{ $report->description ?? 'No additional details.' }}</p>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Driver:</strong> {{ $report->driver->information->full_name ?? 'N/A' }}</p>
                                                    <p><strong>License No.:</strong> {{ $report->driver->information->license_no ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Status:</strong> 
                                                        <span class="badge bg-info">{{ ucfirst($report->status_report) }}</span>
                                                    </p>
                                                    <p><strong>Fuel Cost:</strong> ₱{{ number_format($report->fuel, 2) }}</p>
                                                    <p><strong>Dispatch Cost:</strong> ₱{{ number_format($report->dispatch_cost, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fa-solid fa-xmark me-1"></i> Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No reports available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {!! $reports->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('applyFilter').addEventListener('click', function() {
    let driverFilter = document.getElementById('filterDriver').value.toLowerCase().trim();
    let statusFilter = document.getElementById('filterStatus').value.toLowerCase().trim();
    let dateFilter = document.getElementById('filterDate').value; // YYYY-MM-DD

    let rows = document.querySelectorAll('#reportsTable tbody tr');

    rows.forEach(row => {
        let driver = row.querySelector('.driver')?.textContent.toLowerCase().trim() || '';
        let status = row.querySelector('.status')?.textContent.toLowerCase().trim() || '';
        let date = row.querySelector('.report-date')?.textContent.trim() || '';

        let show = true;

        if (driverFilter && !driver.includes(driverFilter)) {
            show = false;
        }
        if (statusFilter && !status.includes(statusFilter)) {
            show = false;
        }
        if (dateFilter && date !== dateFilter) { 
            show = false;
        }

        row.style.display = show ? '' : 'none';
    });
});
</script>


@endsection
