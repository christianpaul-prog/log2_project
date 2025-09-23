@extends('layouts.app')
@section('title', 'Driver Reports')
@section('content')
<style>
       .table thead th {
    background-color: #5c8c9c;  /* sample: bootstrap primary */
    color: white;
    font-weight: 600;
         }
</style>
<div class="container-fluid mt-5">

    <!-- Header -->
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-primary mb-1">
            <i class="fa-solid fa-id-card-clip me-2"></i> Driver Activity Report
        </h2>
        <p class="text-muted mb-0">Complete Driver Reports at a Glance</p>
    </div>

    <!-- Reports Card -->
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
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
                                <td class="fw-semibold">{{ $report->driver->information->full_name ?? 'N/A' }}</td>
                                <td>{{ $report->driver->information->license_no ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge 
                                        @if ($report->status_report == 'completed') bg-success
                                        @elseif($report->status_report == 'cancelled') bg-danger
                                        @elseif($report->status_report == 'delayed') bg-warning text-dark
                                        @elseif($report->status_report == 'pending') bg-info text-dark
                                        @else bg-secondary @endif">
                                        {{ ucfirst($report->status_report) }}
                                    </span>
                                </td>
                                <td>{{ $report->title }}</td>
                                <td class="fw-bold text-secondary">₱{{ number_format($report->fuel, 2) }}</td>
                                <td class="fw-bold text-danger">₱{{ number_format($report->dispatch_cost, 2) }}</td>
                                <td class="text-center">
                                    <!-- View Button -->
                                    <button class="btn btn-sm btn-light border me-1" data-bs-toggle="modal"
                                        data-bs-target="#viewModal{{ $report->id }}">
                                        <i class="fa-regular fa-eye text-primary"></i>
                                    </button>
                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-light border">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
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
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
