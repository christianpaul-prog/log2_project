@extends('layouts.app')
@section('content')
<style>
      body {
      background-color: #f8f9fa;
    }
    .card {
      margin-bottom: 1.5rem;
      margin-top: 1.5rem;
      transition: all .5s ease;
    }
    .card:hover{
      transform: translateY(-5px);
    }
    .map-placeholder {
      background-color: #e9ecef;
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #6c757d;
      font-size: 1.25rem;
      border-radius: 0.375rem;
    }
    .table-responsive {
      max-height: 300px;
      overflow-y: auto;
    }
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


  </style>

  <main class="container-fluid slide-up">
    <div class="row g-5">
      <!-- Fleet Overview Cards -->
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card text-white bg-primary h-100">
          <div class="card-body">
            <h5 class="card-title">Total Vehicles</h5>
            <h2>0</h2>
            <p class="card-text">All vehicles in fleet</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4 ">
        <div class="card text-white bg-success h-100">
          <div class="card-body">
            <h5 class="card-title">Active Vehicles</h5>
            <h2>0</h2>
            <p class="card-text">Currently in operation</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card text-white bg-danger h-100">
          <div class="card-body">
            <h5 class="card-title">Inactive Vehicles</h5>
            <h2>0</h2>
            <p class="card-text">Under maintenance or idle</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card text-white bg-warning h-100">
          <div class="card-body">
            <h5 class="card-title">Issue Report</h5>
            <h2>0</h2>
            <p class="card-text">Issues to address</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3">
      <!-- Recent Trips -->
      <div class="col-lg-6">
        <div class="card h-100">
          <div class="card-header">
            Recent Trips
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Trip ID</th>
                    <th>Vehicle</th>
                    <th>Driver</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>TR-1001</td>
                    <td>Truck 12</td>
                    <td>John Doe</td>
                    <td>2024-06-01 08:00</td>
                    <td>2024-06-01 12:30</td>
                    <td><span class="badge bg-success">Completed</span></td>
                  </tr>
                  <tr>
                    <td>TR-1002</td>
                    <td>Van 7</td>
                    <td>Jane Smith</td>
                    <td>2024-06-01 09:15</td>
                    <td>2024-06-01 11:00</td>
                    <td><span class="badge bg-warning text-dark">In Progress</span></td>
                  </tr>
                  <tr>
                    <td>TR-1003</td>
                    <td>Truck 3</td>
                    <td>Mike Johnson</td>
                    <td>2024-05-31 14:00</td>
                    <td>2024-05-31 18:00</td>
                    <td><span class="badge bg-danger">Delayed</span></td>
                  </tr>
                  <tr>
                    <td>TR-1004</td>
                    <td>Van 2</td>
                    <td>Emily Davis</td>
                    <td>2024-06-01 07:30</td>
                    <td>2024-06-01 10:00</td>
                    <td><span class="badge bg-success">Completed</span></td>
                  </tr>
                  <tr>
                    <td>TR-1005</td>
                    <td>Truck 8</td>
                    <td>Chris Lee</td>
                    <td>2024-06-01 10:00</td>
                    <td>2024-06-01 15:00</td>
                    <td><span class="badge bg-warning text-dark">In Progress</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Vehicle Status -->
      <div class="col-lg-6">
        <div class="card h-100">
          <div class="card-header">
            Vehicle Status
          </div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Truck 12
                <span class="badge bg-success rounded-pill">Active</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Van 7
                <span class="badge bg-warning text-dark rounded-pill">In Transit</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Truck 3
                <span class="badge bg-danger rounded-pill">Maintenance</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Van 2
                <span class="badge bg-success rounded-pill">Active</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Truck 8
                <span class="badge bg-warning text-dark rounded-pill">In Transit</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3">
      <!-- Fuel Consumption -->
      <div class="col-lg-6">
        <div class="card h-100">
          <div class="card-header">
            Fuel Consumption (Last 7 days)
          </div>
          <div class="card-body">
            <canvas id="fuelChart" height="200"></canvas>
          </div>
        </div>
      </div>

      <!-- Map Placeholder -->
      <div class="col-lg-6">
        <div class="card h-100">
          <div class="card-header">
            Fleet Map
          </div>
          <div class="card-body">
            <div class="map-placeholder">
              Map integration here
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3 mt-3">
      <!-- Notifications -->
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            Notifications
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <strong>Truck 3:</strong> Scheduled maintenance due in 2 days.
              </li>
              <li class="list-group-item">
                <strong>Van 7:</strong> Trip delayed due to traffic.
              </li>
              <li class="list-group-item">
                <strong>Truck 8:</strong> Low fuel warning.
              </li>
              <li class="list-group-item">
                <strong>New Driver Assigned:</strong> Emily Davis to Van 2.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Bootstrap JS Bundle (includes Popper) -->

  <!-- Chart.js for Fuel Consumption Chart -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('fuelChart').getContext('2d');
    const fuelChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago', 'Yesterday', 'Today'],
        datasets: [{
          label: 'Fuel (Liters)',
          data: [120, 115, 130, 125, 110, 105, 100],
          fill: true,
          backgroundColor: 'rgba(13, 110, 253, 0.2)',
          borderColor: 'rgba(13, 110, 253, 1)',
          tension: 0.3,
          pointRadius: 4,
          pointHoverRadius: 6,
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Liters'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Day'
            }
          }
        },
        plugins: {
          legend: {
            display: true,
            position: 'top',
          }
        }
      }
    });
  </script>

  

@endsection('content')
