@extends('layouts.app')
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            padding: 2rem 0;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 1rem 1.5rem;
            border: none;
        }

        .stats-card {
            background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card.warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stats-card.success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stats-card.info {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .trip-item {
            background: rgba(248, 249, 250, 0.8);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }

        .trip-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            font-size: 0.8rem;
            padding: 0.3rem 0.7rem;
            border-radius: 15px;
            text-align: center
        }

        .status-completed {
            background: #28a745;
        }

        .status-ongoing {
            background: #ffc107;
            color: #212529;
        }

        .status-cancelled {
            background: #dc3545;
        }

        .status-pending {
            background: #6c757d;
        }

        .performance-meter {
            background: #e9ecef;
            border-radius: 10px;
            height: 20px;
            margin: 0.5rem 0;
            overflow: hidden;
        }

        .performance-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.8s ease;
        }

        .excellent {
            background: linear-gradient(90deg, #28a745, #20c997);
        }

        .good {
            background: linear-gradient(90deg, #20c997, #17a2b8);
        }

        .average {
            background: linear-gradient(90deg, #ffc107, #fd7e14);
        }

        .poor {
            background: linear-gradient(90deg, #fd7e14, #dc3545);
        }

        .btn-action {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin: 0.2rem;
            transition: transform 0.3s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            color: white;
        }

        .filter-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .driver-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 1rem;
        }

        .slide-up {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-pills .nav-link {
            border-radius: 25px;
            margin: 0 0.2rem;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1rem;
        }

        .table td {
            padding: 0.8rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }
    </style>
    </head>

    <body>
        <div class="container-fluid main-container">
            <div class="container-xl">

                <!-- Header Section -->
                <div class="row mb-4 slide-up">
                    <div class="col-12">
                        <h2 class=" mb-3">
                            <i class="fas fa-route"></i> Trips & Driver Performance
                        </h2>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4 slide-up">
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-1">847</h3>
                                    <p class="mb-0">Total Trips</p>
                                </div>
                                <i class="fas fa-road fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card success">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-1">758</h3>
                                    <p class="mb-0">Completed</p>
                                </div>
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card warning">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-1">23</h3>
                                    <p class="mb-0">Ongoing</p>
                                </div>
                                <i class="fas fa-clock fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-card info">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="mb-1">89.5%</h3>
                                    <p class="mb-0">Success Rate</p>
                                </div>
                                <i class="fas fa-chart-line fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                {{-- <div class="row mb-4">
                <div class="col-12">
                    <ul class="nav nav-pills justify-content-center" id="mainTabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="trips-tab" data-bs-toggle="pill" href="#trips">
                                <i class="fas fa-list"></i> Trip Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="performance-tab" data-bs-toggle="pill" href="#performance">
                                <i class="fas fa-tachometer-alt"></i> Driver Performance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="analytics-tab" data-bs-toggle="pill" href="#analytics">
                                <i class="fas fa-chart-bar"></i> Analytics
                            </a>
                        </li>
                    </ul>
                </div>
            </div> --}}

                <!-- Tab Content -->
                <div class="tab-content" id="mainTabsContent">

                    <!-- Trips Management Tab -->
                    <div class="tab-pane fade show active" id="trips">
                        <div class="row">

                            <!-- Filters -->
                            <div class="col-12">
                                <div class="filter-section">
                                    <div class="row align-items-center">
                                        <div class="col-lg-3 col-md-6 mb-2">
                                            <select class="form-select">
                                                <option>All Drivers</option>
                                                <option>John Smith</option>
                                                <option>Maria Garcia</option>
                                                <option>David Lee</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-2">
                                            <select class="form-select">
                                                <option>All Status</option>
                                                <option>Completed</option>
                                                <option>Ongoing</option>
                                                <option>Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-2">
                                            <input type="date" class="form-control" value="2024-09-01">
                                        </div>
                                        <div class="col-lg-3 col-md-6 mb-2">
                                            <button class="btn btn-action w-100">
                                                <i class="fas fa-filter"></i> Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Trips List -->
                            <div class="col-12">
                                <div class="dashboard-card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="fas fa-route"></i> Recent Trips</h5>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($shifts as $shift)
                                            <!-- Trip Item 1 -->
                                            <div class="trip-item">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-2 col-md-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="driver-avatar">
                                                                {{ $shift->driver->information->initials }}</div>
                                                            <div>
                                                                <strong>{{ $shift->driver->information->full_name }}</strong>
                                                                <br><small
                                                                    class="text-muted">{{ $shift->trip->vehicle->type }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-4">
                                                        <div>
                                                            <i class="fas fa-map-marker-alt text-success"></i>
                                                            {{ $shift->trip->reservation->pickup }}
                                                            <i class="fas fa-arrow-right mx-2"></i>
                                                            <i class="fas fa-map-marker-alt text-danger"></i>
                                                            {{ $shift->trip->reservation->drop }}
                                                        </div>
                                                        <small class="text-muted">
                                                            {{ $shift->trip && $shift->trip->reservation && $shift->trip->reservation->dispatch_date
                                                                ? \Carbon\Carbon::parse($shift->trip->reservation->dispatch_date)->format('M d, Y - h:i A')
                                                                : 'N/A' }}
                                                        </small>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2">
                                                        <div
                                                            class="status-badge 
                                                            @if ($shift->trip->status == 'completed') status-completed
                                                            @elseif($shift->trip->status == 'on_work') status-ongoing
                                                            @elseif($shift->trip->status == 'cancelled') status-cancelled
                                                            @else bg-secondary text-white @endif">
                                                            {{ ucfirst($shift->trip->status) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2">
                                                        <strong>₱{{ number_format($shift->trip->trip_cost) }}</strong>
                                                        <br><small class="text-muted">Revenue</small>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2">
                                                        <small class="text-muted">
                                                            {{ $shift->shift_date ? \Carbon\Carbon::parse($shift->shift_date)->format('M d, Y') : 'N/A' }}
                                                        </small>
                                                        <br>
                                                        <small>
                                                            {{ $shift->start_time ? \Carbon\Carbon::parse($shift->start_time)->format('h:i A') : 'N/A' }}
                                                        </small>
                                                        <br>
                                                        <small>
                                                            {{ $shift->end_time ? \Carbon\Carbon::parse($shift->end_time)->format('h:i A') : 'N/A' }}
                                                        </small>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1">
                                                        <button class="btn btn-action btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            {{ $shifts->links() }}
                        </div>
                    </div>

                    <!-- Driver Performance Tab -->
                    <div class="tab-pane fade" id="performance">
                        <div class="row">

                            <!-- Driver Performance Cards -->
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="dashboard-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="driver-avatar">JS</div>
                                            <div>
                                                <h6 class="mb-1">John Smith</h6>
                                                <small class="text-muted">Driver ID: D001</small>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Safety Score</span>
                                                <span><strong>92%</strong></span>
                                            </div>
                                            <div class="performance-meter">
                                                <div class="performance-fill excellent" style="width: 92%"></div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>On-Time Delivery</span>
                                                <span><strong>88%</strong></span>
                                            </div>
                                            <div class="performance-meter">
                                                <div class="performance-fill good" style="width: 88%"></div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Fuel Efficiency</span>
                                                <span><strong>85%</strong></span>
                                            </div>
                                            <div class="performance-meter">
                                                <div class="performance-fill good" style="width: 85%"></div>
                                            </div>
                                        </div>

                                        <div class="row text-center mt-3">
                                            <div class="col-4">
                                                <strong>143</strong>
                                                <br><small>Trips</small>
                                            </div>
                                            <div class="col-4">
                                                <strong>12,450</strong>
                                                <br><small>KM</small>
                                            </div>
                                            <div class="col-4">
                                                <strong>4.8★</strong>
                                                <br><small>Rating</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="dashboard-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="driver-avatar">MG</div>
                                            <div>
                                                <h6 class="mb-1">Maria Garcia</h6>
                                                <small class="text-muted">Driver ID: D007</small>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Safety Score</span>
                                                <span><strong>96%</strong></span>
                                            </div>
                                            <div class="performance-meter">
                                                <div class="performance-fill excellent" style="width: 96%"></div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>On-Time Delivery</span>
                                                <span><strong>94%</strong></span>
                                            </div>
                                            <div class="performance-meter">
                                                <div class="performance-fill excellent" style="width: 94%"></div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Fuel Efficiency</span>
                                                <span><strong>91%</strong></span>
                                            </div>
                                            <div class="performance-meter">
                                                <div class="performance-fill excellent" style="width: 91%"></div>
                                            </div>
                                        </div>

                                        <div class="row text-center mt-3">
                                            <div class="col-4">
                                                <strong>167</strong>
                                                <br><small>Trips</small>
                                            </div>
                                            <div class="col-4">
                                                <strong>15,680</strong>
                                                <br><small>KM</small>
                                            </div>
                                            <div class="col-4">
                                                <strong>4.9★</strong>
                                                <br><small>Rating</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="dashboard-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="driver-avatar">DL</div>
                                            <div>
                                                <h6 class="mb-1">David Lee</h6>
                                                <small class="text-muted">Driver ID: D003</small>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Safety Score</span>
                                                <span><strong>78%</strong></span>
                                            </div>
                                            <div class="performance-meter">
                                                <div class="performance-fill average" style="width: 78%"></div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>On-Time Delivery</span>
                                                <span><strong>82%</strong></span>
                                            </div>
                                            <div class="performance-meter">
                                                <div class="performance-fill good" style="width: 82%"></div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <span>Fuel Efficiency</span>
                                                <span><strong>75%</strong></span>
                                            </div>
                                            <div class="performance-meter">
                                                <div class="performance-fill average" style="width: 75%"></div>
                                            </div>
                                        </div>

                                        <div class="row text-center mt-3">
                                            <div class="col-4">
                                                <strong>89</strong>
                                                <br><small>Trips</small>
                                            </div>
                                            <div class="col-4">
                                                <strong>8,920</strong>
                                                <br><small>KM</small>
                                            </div>
                                            <div class="col-4">
                                                <strong>4.2★</strong>
                                                <br><small>Rating</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Analytics Tab -->
                    <div class="tab-pane fade" id="analytics">
                        <div class="row">

                            <!-- Performance Leaderboard -->
                            <div class="col-lg-6 col-md-12 mb-4">
                                <div class="dashboard-card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="fas fa-trophy"></i> Performance Leaderboard</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Rank</th>
                                                        <th>Driver</th>
                                                        <th>Score</th>
                                                        <th>Trips</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><span class="badge bg-warning">1</span></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="driver-avatar"
                                                                    style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                                    MG</div>
                                                                <span class="ms-2">Maria Garcia</span>
                                                            </div>
                                                        </td>
                                                        <td><strong>94%</strong></td>
                                                        <td>167</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-secondary">2</span></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="driver-avatar"
                                                                    style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                                    JS</div>
                                                                <span class="ms-2">John Smith</span>
                                                            </div>
                                                        </td>
                                                        <td><strong>88%</strong></td>
                                                        <td>143</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-dark">3</span></td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="driver-avatar"
                                                                    style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                                    DL</div>
                                                                <span class="ms-2">David Lee</span>
                                                            </div>
                                                        </td>
                                                        <td><strong>78%</strong></td>
                                                        <td>89</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Monthly Statistics -->
                            <div class="col-lg-6 col-md-12 mb-4">
                                <div class="dashboard-card">
                                    <div class="card-header">
                                        <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Monthly Statistics</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <div class="text-center">
                                                    <h4 class="text-primary">2,345</h4>
                                                    <small class="text-muted">Total Kilometers</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center">
                                                    <h4 class="text-success">1,234</h4>
                                                    <small class="text-muted
">Total Trips</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="text-center">
                                                    <h4 class="text-warning">89.5%</h4>
                                                    <small class="text-muted">On-Time Rate</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center">
                                                    <h4 class="text-info">4.7★</h4>        
                                                    <small class="text-muted">Average Rating</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection
