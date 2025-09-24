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
    .btn:hover{
        transform: translateY(-5px);
    }

    /* Tables */
    .table {
        border-radius: 12px;
        overflow: hidden;
    }
    .table thead th{
        background: #5c8c9c;
        font-weight: 600;
        color: #fff;
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
 .nav-tabs .nav-link {
    color: #000 !important;   /* black */
}

/* kapag active yung tab */
.nav-tabs .nav-link.active {
    color: #000 !important;   /* black */
    background-color: #f8f9fa; /* light background */
    border-color: #dee2e6 #dee2e6 #fff;
}
</style>

<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 page-header mt-5">
        <div>
            <h2>Budget Forecasting</h2>
            <small>Submit and approve budget forecasts</small>
            <br>
            <small>For Finance Report</small>
        </div>
    </div>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i> 
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> 
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <!-- Add Forecast Form -->
    <div class="card shadow-sm p-4 mb-4">
        <h5 class="mb-3">Add Budget Forecast</h5>
        <form action="{{ route('budget_forecasting.store') }}" method="POST">
            @csrf
          <div class="row">
    <div class="col-md-3 mb-3">
        
        <label class="form-label">Category</label>
        <select name="category" class="form-control" required>
    <option value="">-- Select Category --</option>
    <option value="all">All</option>
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
    <div class="col-md-3 mb-3">
        <label class="form-label">Reason</label>
        <input type="text" name="reason" class="form-control" placeholder="Ex.Need fund for fuel" required>
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100 m-auto">Submit</button>
    </div>
</div>


        </form>
    </div>
<!-- Budget Total -->

    <!-- Forecast Records -->
 <div class="card shadow-sm p-4 mb-4">
    <ul class="nav nav-tabs" id="forecastTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="forecasts-tab" data-bs-toggle="tab" data-bs-target="#forecasts" type="button" role="tab">
                Forecast Records
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="logs-tab" data-bs-toggle="tab" data-bs-target="#logs" type="button" role="tab">
                History Budget Logs
            </button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="forecastTabsContent">
        <!-- Forecast Records -->
        <div class="tab-pane fade show active table-responsive" id="forecasts" role="tabpanel">
            <table class="table table-bordered table-striped ">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Month</th>
                        <th>Status</th>
                        <th>Reason</th>
                        <th>Created At</th>
                        <th>Action</th>
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
                                <span class="badge 
                                    @if($forecast->status == 'approved') bg-success
                                    @elseif($forecast->status == 'rejected') bg-danger
                                    @else bg-warning text-dark
                                    @endif">
                                    {{ ucfirst($forecast->status) }}
                                </span>
                            </td>
                            <td>{{ $forecast->reason ?? '-' }}</td>
                            <td>{{ $forecast->created_at->format('Y-m-d H:i') }}</td>
                          <td>
    @if($forecast->status == 'pending')
        <!-- Approve -->
        <form action="{{ route('budget_forecasting.approve', $forecast->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-success">
                <i class="fa-solid fa-check"></i> Approve
            </button>
        </form>

        <!-- Reject -->
        <form action="{{ route('budget_forecasting.reject', $forecast->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fa-solid fa-xmark"></i> Reject
            </button>
        </form>
    @endif

    <!-- Delete (lagi visible kahit approved/rejected na) -->
    <form action="{{ route('budget_forecasting.destroy', $forecast->id) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this forecast?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger">
            <i class="fa-solid fa-trash"></i> Delete
        </button>
    </form>
</td>


                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted">No forecasts yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Logs -->
        <div class="tab-pane fade" id="logs" role="tabpanel">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Month</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Logged At</th>
                        <th>Manage</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ ucfirst($log->category) }}</td>
                            <td>₱{{ number_format($log->amount, 2) }}</td>
                            <td>{{ $log->month }}</td>
                            <td>{{ $log->reason ?? '-' }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($log->status) }}</span></td>
                            <td><span class="badge bg-danger">{{ ucfirst($log->action) }}</span></td>
                            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>

                             <td>
                <!-- Delete button -->
                <form action="{{ route('budget_logs.destroy', $log->id) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Delete this log? This cannot be undone.');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-outline-danger">
        <i class="fa-solid fa-trash"></i> Delete
    </button>
</form>
            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center text-muted">No logs yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card shadow-sm p-4 mb-4 text-center">
    <h5 class="mb-2">💰 Total Approved Budget</h5>
    <h3 class="fw-bold text-success">
        ₱{{ number_format($totalBudget, 2) }}
    </h3>
</div>
    <!-- Budget vs Actual -->
    <div class="card shadow-sm p-4 mb-4 table-responsive">
        <h5 class="mb-3"> Budget Forecast vs Actual</h5>
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
