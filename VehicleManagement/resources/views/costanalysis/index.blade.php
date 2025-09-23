 @extends('layouts.app')
@section('content')
<style>

  
    /* Form Card */
    .container-fluid{
         animation: fadeIn 0.4s ease-in-out;
    }
        
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem;
        }
        
    
        
        h4 {
         
            font-weight: 600;
            margin-bottom: 2rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 500;
            transition: transform 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .form-section {
            background: rgba(248, 249, 250, 0.5);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #dee2e6;
        }

    /* Metric Cards */
    .metric-card {
        border-radius: 12px;
        padding: 1.5rem;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        text-align: center;
        transition: 0.3s ease;
    
    }
    .metric-card:hover {
        transform: translateY(-5px);
         box-shadow: 0 4px;
    }
    .metric-icon {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        color: #ccccccff;
    }
    .metric-value {
         color: #000000ff;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0.5rem 0;
    }
    .metric-label {
        color: #000000ff;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Table */
    .table-container-fluid {
        margin-top: 1.5rem;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow-x: auto;   /* maglalagay ng horizontal scrollbar kung kulang ang width */
    -webkit-overflow-scrolling: touch;
    }
  .table thead th {
    background-color: #5c8c9c;  
    color: white;
    font-weight: 600;
}

    td{
        transition: all .3s ease;
    }
    td:hover{
        transform: translateY(-5px);
    }
    .table tbody tr:nth-child(even) {
        background: #fdfdfd;
    }
    .table tbody tr:hover {
        background: #f1f5ff;
        transition: 0.3s;
    }

    /* Status badges */
    .status-badge {
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .status-open { background: #e3f2fd; color: #1565c0; }
    .status-paid { background: #e8f5e8; color: #2e7d32; }
    .status-refunded { background: #fff3e0; color: #f57c00; }

    .pagination {
    justify-content: center;  /* center align */
    margin-top: 1rem;
}

.pagination .page-link {
    border-radius: 6px !important;
    padding: 0.35rem 0.75rem; /* mas maliit na padding */
    font-size: 0.85rem;       /* mas maliit na font */
    color: #495057;
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: #667eea;
    color: #fff;
    border-color: #667eea;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
    color: #fff;
    font-weight: 600;
}
  /* Notification List Wrapper */
    .notification-list {
        max-height: 350px; 
        overflow-y: auto;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Notification Item */
    .notification-item {
        border-left: 4px solid transparent;
        transition: all 0.2s ease-in-out;
        padding: 12px 15px;
    }

    /* Hover Effect */
    .notification-item:hover {
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
    }

    /* Scrollbar Styling */
    .notification-list::-webkit-scrollbar {
        width: 6px;
    }
    .notification-list::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

     @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .metric-change.increase { color: #2ecc71; font-weight: 600; margin-top: 5px; }
.metric-change.decrease { color: #e74c3c; font-weight: 600; margin-top: 5px; }
.alert {
    margin-bottom: 1.5rem;
    font-weight: 500;
}
.alert-success {
    background: #e8f9f0;
    color: #2e7d32;
    border: 1px solid #c8e6c9;
}
.alert-danger {
    background: #fdecea;
    color: #c62828;
    border: 1px solid #f5c6cb;
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


<body class="bg-light">
   <div class="container-fluid mt-5 ">
        <h4 class="mb-4 ">Overview of expenses across fuel, maintenance, and trips</h4>
          <small>Cost analysis</small>
            <br>
            <small>Expenses And Cost Reports</small>
       
       
    </div>
<div class="container-fluid mt-5 ">
    <!-- Metrics -->
    <div class="row mb-4">
       <div class="col-md-4">
    <div class="metric-card mb-2 " >
        <div class="metric-icon"><i class="fas fa-tools"></i></div>
        <div class="metric-label">Maintenance Cost</div>
        <div class="metric-value">₱{{ number_format($totalMaintenance ?? 0) }}</div>
        <div class="metric-change {{ $maintenanceChange >= 0 ? 'increase' : 'decrease' }}">
            {{ $maintenanceChange >= 0 ? '+' : '-' }}{{ number_format($maintenanceChange, 1) }}% {{ $maintenanceChange >= 0 ? 'increase' : 'decrease' }}
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="metric-card mb-2" >
        <div class="metric-icon"><i class="fas fa-road"></i></div>
        <div class="metric-label">Trip Expenses</div>
        <div class="metric-value">₱{{ number_format($totalTrips ?? 0) }}</div>
        <div class="metric-change {{ $tripChange >= 0 ? 'increase' : 'decrease' }}">
            {{ $tripChange >= 0 ? '+' : '-' }}{{ number_format($tripChange, 1) }}% {{ $tripChange >= 0 ? 'increase' : 'decrease' }}
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="metric-card mb-2"  >
        <div class="metric-icon"><i class="fas fa-gas-pump"></i></div>
        <div class="metric-label">Fuel Cost</div>
        <div class="metric-value">₱{{ number_format($totalFuel ?? 0) }}</div>
        <div class="metric-change {{ $fuelChange >= 0 ? 'increase' : 'decrease' }}">
            {{ $fuelChange >= 0 ? '+' : '-' }}{{ number_format($fuelChange, 1) }}% {{ $fuelChange >= 0 ? 'increase' : 'decrease' }}
        </div>
    </div>
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



 
<div class="table-container-fluid mt-5">
    <ul class="nav nav-tabs" id="costTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button 
                class="nav-link active" 
                id="records-tab" 
                data-bs-toggle="tab" 
                data-bs-target="#records" 
                type="button" 
                role="tab" 
                aria-controls="records" 
                aria-selected="true">
                <i class="fas fa-list"></i> Cost Records
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button 
                class="nav-link" 
                id="logs-tab" 
                data-bs-toggle="tab" 
                data-bs-target="#logs" 
                type="button" 
                role="tab" 
                aria-controls="logs" 
                aria-selected="false">
                <i class="fas fa-history"></i> Closed Logs
            </button>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content bg-white border border-top-0 rounded-bottom shadow-sm p-3" id="costTabsContent">
        
        <!-- Cost Records Table -->
        <div class="tab-pane fade show active" id="records" role="tabpanel" aria-labelledby="records-tab">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Vehicle</th>
                        <th>Fuel</th>
                        <th>Maintenance</th>
                        <th>Trip</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($costs as $cost)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($cost->date)->format('M d, Y') }}</td>
                            <td><strong>{{ $cost->vehicle }}</strong></td>
                            <td>₱{{ number_format($cost->fuel_cost, 2) }}</td>
                            <td>₱{{ number_format($cost->maintenance_cost, 2) }}</td>
                            <td>₱{{ number_format($cost->trip_expenses, 2) }}</td>
                            <td><strong>₱{{ number_format($cost->total_cost, 2) }}</strong></td>
                            <td>
                                @if($cost->status == 'Pending')
                                    <span class="status-badge status-open">Pending</span>
                                @elseif($cost->status == 'Closed')
                                    <span class="status-badge status-paid">Closed</span>
                                @endif
                            </td>
                            <td>
                                <!-- Delete -->
                                <form action="{{ route('costanalysis.destroy', $cost->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this record?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>

                                <!-- Close -->
                                @if($cost->status == 'Pending')
                                    <form action="{{ route('costanalysis.close', $cost->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Close this record?');">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> Close
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No cost data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3">
                {{ $costs->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Closed Logs Table -->
        <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs-tab">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Vehicle</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ $log->vehicle }}</td>
                            <td>{{ ucfirst($log->category) }}</td>
                            <td>₱{{ number_format($log->amount, 2) }}</td>
                            <td><span class="badge bg-success">{{ $log->action }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No closed transaction logs yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3">
                {{ $logs->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
</div>


<div class="row mt-2">
  <div class="col-md-11">
    <h6 class="mb-3">Notification</h6>
    <ul class="list-group list-group-flush notification-list">
      @forelse($notifications as $note)
        <li class="list-group-item notification-item">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <span class="badge bg-primary me-2">{{ $note->type }}</span>
              <span>{{ $note->message }}</span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
              <form action="{{ route('notifications.destroy', $note->id) }}" method="POST" class="m-0 p-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-light text-danger border-0 p-0 ms-2 delete-btn">
                  ✖
                </button>
              </form>
            </div>
          </div>
        </li>
      @empty
        <li class="list-group-item text-muted text-center">No notifications yet.</li>
      @endforelse
    </ul>
  </div>
</div>

 <div class="form-card mt-5">
            <form action="{{ route('costanalysis.store') }}" method="POST">
                @csrf
                
                <!-- Vehicle & Date Section -->
                <div class="form-section">
                    <h6 class="section-title"><i class="fas fa-car"></i> Vehicle Information</h6>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <label class="form-label"><i class="fas fa-calendar-alt"></i> Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label class="form-label"><i class="fas fa-truck"></i> Vehicle</label>
                            <input type="text" name="vehicle" class="form-control" placeholder="Enter vehicle details" required>
                        </div>
                    </div>
                </div>
                
                <!-- Cost Information Section -->
                <div class="form-section">
    <h6 class="section-title"><i class="fas fa-dollar-sign"></i> Cost Information</h6>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <label class="form-label"><i class="fas fa-gas-pump"></i> Fuel Cost</label>
            <input type="number" step="0.01" name="fuel_cost" id="fuel_cost" class="form-control" placeholder="0.00" required>
        </div>
        <div class="col-lg-3 col-md-6">
            <label class="form-label"><i class="fas fa-wrench"></i> Maintenance Cost</label>
            <input type="number" step="0.01" name="maintenance_cost" id="maintenance_cost" class="form-control" placeholder="0.00" required>
        </div>
        <div class="col-lg-3 col-md-6">
            <label class="form-label"><i class="fas fa-road"></i> Trip Expenses</label>
            <input type="number" step="0.01" name="trip_expenses" id="trip_expenses" class="form-control" placeholder="0.00" required>
        </div>
        <div class="col-lg-3 col-md-6">
            <label class="form-label"><i class="fas fa-calculator"></i> Total</label>
            <input type="number" step="0.01" name="total_cost" id="total_cost" class="form-control" placeholder="0.00" readonly>
        </div>
    </div>
</div>
                
                <!-- Status & Actions Section -->
                <div class="form-section">
                    <div class="row align-items-end">
                        <div class="col-lg-6 col-md-6">
                            <label class="form-label"><i class="fas fa-info-circle"></i> Status</label>
                           <select name="status" class="form-select" required>
                                  <option value="">Select Status</option>
                                 <option value="Pending">Pending</option>
                                  <option value="Closed">Closed</option>
                                     </select>

                        </div>
                        <div class="col-lg-6 col-md-6 text-end">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Save Record
                            </button>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>

   

    <script>
    function calculateTotal() {
        let fuel = parseFloat(document.getElementById("fuel_cost").value) || 0;
        let maintenance = parseFloat(document.getElementById("maintenance_cost").value) || 0;
        let trip = parseFloat(document.getElementById("trip_expenses").value) || 0;

        let total = fuel + maintenance + trip;
        document.getElementById("total_cost").value = total.toFixed(2);
    }

    document.getElementById("fuel_cost").addEventListener("input", calculateTotal);
    document.getElementById("maintenance_cost").addEventListener("input", calculateTotal);
    document.getElementById("trip_expenses").addEventListener("input", calculateTotal);
</script>

    @endsection