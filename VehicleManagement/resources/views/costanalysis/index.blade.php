 @extends('layouts.app')
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

        .metric-card {
            border-radius: 10px;
            border: 1px solid #e9ecef;
            background: white;
            padding: 1.5rem;
            height: 100%;
            transition: all .3s ease;
        }
        .metric-card:hover{
            transform: translateY(-5px);
        }
        .metric-value {
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0.5rem 0;
        }
        
        .metric-label {
            color: #6c757d;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .chart-placeholder {
            width: 60px;
            height: 30px;
            float: right;
            margin-top: 10px;
        }
        
      
        .chart-down {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            border-radius: 3px;
            position: relative;
        }
        
        .chart-neutral {
            background: linear-gradient(45deg, #ffc107, #fd7e14);
            border-radius: 3px;
            position: relative;
        }
        
        .alert-banner {
            background: #2f5ac7ff;
            border: none;
            color: white;
            border-radius: 10px;
            padding: 1rem 1.5rem;
        }
        
        .btn-filter {
            border: 1px solid #dee2e6;
            background: white;
            color: #6c757d;
            border-radius: 6px;
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            margin-right: 0.5rem;
        }
        
        .btn-filter.active {
            background: #2f5ac7ff;
            color: white;
            border-color: #6f42c1;
        }
        
        .btn-primary-custom {
            background: #2f5ac7ff;
            border-color: #6f42c1;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            font-weight: 500;
        }
        
        .table-container {
            background: white;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            overflow: hidden;
        }
        
        .table th {
            background: #f8f9fa;
            border: none;
            font-weight: 600;
            color: #495057;
            font-size: 0.875rem;
            padding: 1rem;
        }
        
        .table td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
            transition: all .3s ease;
        }
        .table td:hover{
            transform: translateY(-5px);
        }
        .table tbody tr {
            border-bottom: 1px solid #f1f3f4;
        }
        
        .table tbody tr:last-child {
            border-bottom: none;
        }
        
        .client-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            margin-right: 0.75rem;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-open {
            background: #e3f2fd;
            color: #1565c0;
        }
        
        .status-paid {
            background: #e8f5e8;
            color: #2e7d32;
        }
        
        .status-refunded {
            background: #fff3e0;
            color: #f57c00;
        }
        
        .invoice-type {
            font-size: 0.875rem;
            color: #6c757d;
        }
        
        .recurring-info {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid slide-up mt-5 p-4">
        <!-- Alert Banner -->
        <div class="alert alert-banner mb-4">
            <div class="row align-items-center">
                <div class="col">
                    <i class="bi bi-link-45deg me-2"></i>
                    <strong>Get paid without sending an invoice!</strong>
                   
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-light btn-sm me-2">
                        <i class="bi bi-eye me-1"></i> Preview
                    </button>
                    <button class="btn btn-light btn-sm">
                        <i class="bi bi-clipboard me-1"></i> Copy
                    </button>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="row mb-4">
            <div class="col">
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary-custom me-3">
                        <i class="bi bi-plus-lg me-2"></i>New Invoice
                    </button>
                    
                    <button class="btn btn-filter active">All</button>
                    <button class="btn btn-filter">One-time</button>
                    <button class="btn btn-filter">Recurring</button>
                    
                    <div class="dropdown me-2">
                        <button class="btn btn-filter dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Status
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">All Statuses</a></li>
                            <li><a class="dropdown-item" href="#">Open</a></li>
                            <li><a class="dropdown-item" href="#">Paid</a></li>
                            <li><a class="dropdown-item" href="#">Refunded</a></li>
                        </ul>
                    </div>
                    
                    <div class="dropdown me-2">
                        <button class="btn btn-filter dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Clients
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">All Clients</a></li>
                            <li><a class="dropdown-item" href="#">Recent Clients</a></li>
                        </ul>
                    </div>
                    
                    <button class="btn btn-filter">
                        <i class="bi bi-calendar me-1"></i>Due Date
                    </button>
                </div>
            </div>
        </div>

        <!-- Metrics Row -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="metric-card shadow-lg">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="metric-label">Maintenance</div>
                            <div class="metric-value">P13,000</div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="metric-card shadow-lg">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="metric-label">Trip Expenses</div>
                            <div class="metric-value">P2,308</div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="metric-card shadow-lg">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="metric-label">Fuel Consumption</div>
                            <div class="metric-value">P10.000</div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Table -->
        <div class="table-container shadow-lg">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Issue Date</th>
                        <th>Amount</th>
                        <th>Invoice #</th>
                        <th>Client</th>
                        <th>Due Date</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Oct 18, 2023</td>
                        <td><strong>52.00</strong></td>
                        <td>357</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="client-avatar" style="background-color: #ff9800;">W</div>
                                Wade Warren
                            </div>
                        </td>
                        <td>Oct 18, 2023</td>
                        <td>
                            <div class="invoice-type">One-time</div>
                        </td>
                        <td><span class="status-badge status-open">Open</span></td>
                        <td><i class="bi bi-chevron-right text-muted"></i></td>
                    </tr>
                    <tr>
                        <td>Oct 11, 2023</td>
                        <td><strong>32.00</strong></td>
                        <td>185</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="client-avatar" style="background-color: #2196f3;">R</div>
                                Ronald Richards
                            </div>
                        </td>
                        <td>Oct 11, 2023</td>
                        <td>
                            <div class="invoice-type">Recurring</div>
                            <div class="recurring-info">Next Due: Nov 11, 2023</div>
                        </td>
                        <td><span class="status-badge status-open">Open</span></td>
                        <td><i class="bi bi-chevron-right text-muted"></i></td>
                    </tr>
                    <tr>
                        <td>Sep 27, 2023</td>
                        <td><strong>150.00</strong></td>
                        <td>583</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="client-avatar" style="background-color: #9c27b0;">A</div>
                                Annette Black
                            </div>
                        </td>
                        <td>Sep 27, 2023</td>
                        <td>
                            <div class="invoice-type">One-time</div>
                        </td>
                        <td><span class="status-badge status-paid">Paid</span></td>
                        <td><i class="bi bi-chevron-right text-muted"></i></td>
                    </tr>
                    <tr>
                        <td>Sep 20, 2023</td>
                        <td><strong>175.00</strong></td>
                        <td>740</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="client-avatar" style="background-color: #4caf50;">J</div>
                                Jane Cooper
                            </div>
                        </td>
                        <td>Sep 20, 2023</td>
                        <td>
                            <div class="invoice-type">One-time</div>
                        </td>
                        <td><span class="status-badge status-paid">Paid</span></td>
                        <td><i class="bi bi-chevron-right text-muted"></i></td>
                    </tr>
                    <tr>
                        <td>Sep 13, 2023</td>
                        <td><strong>99.00</strong></td>
                        <td>883</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="client-avatar" style="background-color: #cddc39;">D</div>
                                Dianne Russell
                            </div>
                        </td>
                        <td>Sep 13, 2023</td>
                        <td>
                            <div class="invoice-type">One-time</div>
                        </td>
                        <td><span class="status-badge status-refunded">Refunded</span></td>
                        <td><i class="bi bi-chevron-right text-muted"></i></td>
                    </tr>
                    <tr>
                        <td>Sep 10, 2023</td>
                        <td><strong>259.00</strong></td>
                        <td>922</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="client-avatar" style="background-color: #3f51b5;">J</div>
                                Jacob Jones
                            </div>
                        </td>
                        <td>Sep 10, 2023</td>
                        <td>
                            <div class="invoice-type">One-time</div>
                        </td>
                        <td><span class="status-badge status-open">Open</span></td>
                        <td><i class="bi bi-chevron-right text-muted"></i></td>
                    </tr>
                    <tr>
                        <td>Aug 29, 2023</td>
                        <td><strong>599.00</strong></td>
                        <td>423</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="client-avatar" style="background-color: #f44336;">G</div>
                                Guy Hawkins
                            </div>
                        </td>
                        <td>Aug 29, 2023</td>
                        <td>
                            <div class="invoice-type">One-time</div>
                        </td>
                        <td><span class="status-badge status-paid">Paid</span></td>
                        <td><i class="bi bi-chevron-right text-muted"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

   
    <script>
        // Add interactivity for filter buttons
        document.querySelectorAll('.btn-filter:not(.dropdown-toggle)').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.btn-filter:not(.dropdown-toggle)').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Add hover effects for table rows
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8f9fa';
                this.style.cursor = 'pointer';
            });
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });
    </script>
    @endsection('content')