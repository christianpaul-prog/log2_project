@extends('layouts.app')
@section('title', 'Driver Reports')
@section('content')
    <div class="container-fluid mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">
                <i class="fa-solid fa-id-card-clip me-2"></i> Driver Reports
            </h2>
        </div>

        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th><i class="fa-solid fa-user me-1"></i> Name</th>
                                <th><i class="fa-solid fa-id-card me-1"></i> License No.</th>
                                <th><i class="fa-solid fa-phone me-1"></i> Status</th>
                                <th><i class="fa-solid fa-road me-1"></i> Report Title</th>
                                <th><i class="fa-solid fa-peso-sign me-1"></i> Earn</th>
                                <th><i class="fa-solid fa-coins me-1"></i> Dispatch Cost</th>
                                <th><i class="fa-solid fa-gear me-1"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $report->driver->information->full_name ?? 'N/A' }}</td>
                                    <td>{{ $report->driver->information->license_no ?? 'N/A' }}</td>
                                    <td>
                                        <span
                                            class="badge 
    @if ($report->status_report == 'completed') bg-success
    @elseif($report->status_report == 'cancelled') bg-danger
    @elseif($report->status_report == 'delayed') bg-warning text-dark
    @elseif($report->status_report == 'pending') bg-info text-dark
    @else bg-secondary @endif">
                                            {{ ucfirst($report->status_report) }}
                                        </span>
                                    </td>
                                    <td>{{ $report->title }}</td>
                                    <td>₱{{ number_format($report->earn, 2) }}</td>
                                    <td>₱{{ number_format($report->dispatch_cost, 2) }}</td>
                                    <td>
                                        <!-- View Modal Trigger -->
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#viewModal{{ $report->id }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- View Report Modal -->
                                <div class="modal fade" id="viewModal{{ $report->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content rounded-4 shadow">
                                            <div class="modal-header bg-primary text-white rounded-top-4">
                                                <h5 class="modal-title"><i class="fa-solid fa-file-alt me-2"></i> Report
                                                    Details</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                        
                                                <h5 class="fw-bold">{{ $report->title }}</h5>
                                                <p class="text-muted">{{ $report->description ?? 'No additional details.' }}
                                                </p>
                                                <hr>
                                                <p><strong>Driver:</strong>
                                                    {{ $report->driver->information->full_name ?? 'N/A' }}</p>
                                                <p><strong>License No.:</strong>
                                                    {{ $report->driver->information->license_no ?? 'N/A' }}</p>
                                                <p><strong>Status:</strong>
                                                    <span
                                                        class="badge bg-info">{{ ucfirst($report->status_report) }}</span>
                                                </p>
                                                <p><strong>Earn:</strong> ₱{{ number_format($report->earn, 2) }}</p>
                                                <p><strong>Dispatch Cost:</strong>
                                                    ₱{{ number_format($report->dispatch_cost, 2) }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fa-solid fa-xmark me-1"></i> Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
