@extends('layouts.app')

@section('content')
<style>
    /* Global Container */
    .container-fluid {
        animation: fadeIn 0.4s ease-in-out;
    }

    /* Header */
    .page-header h2 {
        font-weight: 600;
        color: #2c3e50;
    }
    .page-header small {
        font-size: 14px;
        color: #7f8c8d;
    }

    /* Card Styling */
    .card {
        border-radius: 15px;
        border: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.08);
    }

    /* Form */
    .form-label {
        font-weight: 500;
        color: #34495e;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #dee2e6;
        padding: 10px 12px;
    }
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52,152,219,.25);
    }

    /* Buttons */
    .btn {
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-primary {
        background: linear-gradient(135deg, #3498db, #2980b9);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #2980b9, #1f6391);
    }
    .btn-success {
        background: linear-gradient(135deg, #27ae60, #1e8449);
        border: none;
    }
    .btn-danger {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        border: none;
    }

    /* Tables */
    .table {
        border-radius: 12px;
        overflow: hidden;
    }
    .table thead {
        background: #f8f9fa;
        font-weight: 600;
    }
    .table tbody tr:hover {
        background: #f2f6fa;
    }
    .table td, .table th {
        vertical-align: middle;
    }

    /* Status Badges */
    .badge {
        font-size: 12px;
        padding: 6px 10px;
        border-radius: 8px;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    /* Pagination Custom Styling */
.pagination {
    justify-content: center; /* center align */
    margin-top: 20px;
}

.page-link {
    border-radius: 8px !important;
    padding: 8px 14px;
    font-weight: 500;
    color: #3498db; /* default text color */
    border: 1px solid #dee2e6;
    transition: all 0.2s ease;
}

.page-link:hover {
    background-color: #3498db;
    color: #fff;
    border-color: #3498db;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #3498db, #2980b9);
    border-color: #2980b9;
    color: #fff;
    font-weight: 600;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
}

.page-item.disabled .page-link {
    color: #aaa;
    background-color: #f8f9fa;
}

</style>

<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header mt-5">
        <div>
            <h2>Budget Forecasting</h2>
            <small>Submit and approve budget forecasts</small>
        </div>
    </div>

    <!-- Add Forecast Form -->
    <div class="card shadow-sm p-4 mb-4">
        <h5 class="mb-3">➕ Add Budget Forecast</h5>
        <form action="{{ route('budget_forecasting.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        <option value="fuel">Fuel</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="trip">Trip</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Amount (₱)</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Month</label>
                    <input type="month" name="month" class="form-control" required>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 m-auto">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Forecast Records -->
    <div class="card shadow-sm p-4 mb-4 table-responsive">
        <h5 class="mb-3">📑 Forecast Records</h5>
        <table class="table table-bordered table-striped ">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Month</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Actions (Finance)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($forecasts as $forecast)
                    <tr>
                        <td>{{ $forecast->id }}</td>
                        <td>{{ ucfirst($forecast->category) }}</td>
                        <td>₱{{ number_format($forecast->amount, 2) }}</td>
                        <td>{{ $forecast->month }}</td>
                        <td>
                            @if($forecast->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($forecast->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $forecast->created_at->format('Y-m-d') }}</td>
                        <td>
    <div class="d-flex gap-2">
    @if($forecast->status == 'pending')
        <form action="{{ route('budget_forecasting.approve', $forecast->id) }}" method="POST">
            @csrf
            <button class="btn btn-success btn-sm">Approve</button>
        </form>
        <form action="{{ route('budget_forecasting.reject', $forecast->id) }}" method="POST">
            @csrf
            <button class="btn btn-warning btn-sm">Reject</button>
        </form>
    @else
        <em class="text-muted">No actions</em>
    @endif

    <form action="{{ route('budget_forecasting.destroy', $forecast->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this forecast?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
</div>


</td>

                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted">No forecasts yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
    {{ $forecasts->withQueryString()->links('pagination::bootstrap-5') }}
</div>
    </div>

    <!-- Budget vs Actual -->
    <div class="card shadow-sm p-4 mb-4 table-responsive">
        <h5 class="mb-3">📊 Budget Forecast vs Actual</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Category</th>
                    <th>Forecast (₱)</th>
                    <th>Actual (₱)</th>
                    <th>Variance (₱)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $categories = [
                        'Fuel' => [$forecastFuel, $totalFuel],
                        'Maintenance' => [$forecastMaintenance, $totalMaintenance],
                        'Trip' => [$forecastTrips, $totalTrips],
                    ];
                @endphp

                @foreach($categories as $cat => [$forecast, $actual])
                    @php $variance = $forecast - $actual; @endphp
                    <tr>
                        <td>{{ $cat }}</td>
                        <td>₱{{ number_format($forecast, 2) }}</td>
                        <td>₱{{ number_format($actual, 2) }}</td>
                        <td class="{{ $variance < 0 ? 'text-danger' : 'text-success' }}">
                            ₱{{ number_format($variance, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
