 @extends('layouts.app')
@section('content')
<style>

  
    /* Form Card */
    
        
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
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        text-align: center;
        transition: 0.3s ease;
    
    }
    .metric-card:hover {
        transform: translateY(-5px);
    }
    .metric-icon {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
        color: #000000;
    }
    .metric-value {
         color: #000000;
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0.5rem 0;
    }
    .metric-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Table */
    .table-container {
        margin-top: 1.5rem;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow-x: auto;   /* maglalagay ng horizontal scrollbar kung kulang ang width */
    -webkit-overflow-scrolling: touch;
    }
    .table thead td{
        background: #f8f9fc;
       
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
</style>

<body class="bg-light">
   <div class="container mt-5 ">
        <h4 class="mb-4 text-center">Overview of expenses across fuel, maintenance, and trips</h4>
        <h6></h6>
       
    </div>
<div class="container mt-5 ">
    <!-- Metrics -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="metric-card">
                <div class="metric-icon"><i class="fas fa-tools"></i></div>
                <div class="metric-label">Maintenance Cost</div>
                <div class="metric-value">₱{{ number_format($totalMaintenance ?? 0) }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="metric-card">
                <div class="metric-icon"><i class="fas fa-road"></i></div>
                <div class="metric-label">Trip Expenses</div>
                <div class="metric-value">₱{{ number_format($totalTrips ?? 0) }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="metric-card">
                <div class="metric-icon"><i class="fas fa-gas-pump"></i></div>
                <div class="metric-label">Fuel Cost</div>
                <div class="metric-value">₱{{ number_format($totalFuel ?? 0) }}</div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-container mt-5">
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
                        @else
                            <span class="status-badge status-refunded">Maintenance</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No cost data available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-3">
            {{ $costs->links() }}
        </div>
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
                                <option value="Maintenance">Maintenance</option>
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

    @endsection('content')