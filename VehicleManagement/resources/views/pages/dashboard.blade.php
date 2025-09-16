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
  .card:hover {
    transform: translateY(-5px);
  }
  .card .body1 {
    background: white;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
    border-radius: 8px;
    margin-bottom: 10px;
  }
  .table-responsive {
    max-height: 250px;
    overflow-y: auto;
  }
  .filter-bar {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
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
  .notification-list {
    max-height: 300px;
    overflow-y: auto;
}

</style>

<div class="container-fluid slide-up mt-4">
 <div class="col-md-11 mt-3">
                <h2 class="text-center my-4">Dashboard</h2>
                <p class="text-center my-4">Manage your fleet vehicles eficiently</p>
            </div>
  <!-- Stats Cards -->
<div class="row g-4">
  <!-- Total Vehicles -->
  <div class="col-md-3">
    <div class="card shadow-lg border-0 rounded-3 text-white"
         style="background: linear-gradient(135deg, #0d6efd, #3a8ef6);">
      <div class="card-body">
        <h6 class="fw-light">Total Vehicles</h6>
        <h3 class="fw-bold">{{ $totalVehicles ?? 0}}</h3>
        <small>↗ includes all vehicles</small>
      </div>
    </div>
  </div>

  <!-- Active Vehicles -->
  <div class="col-md-3">
    <div class="card shadow-lg border-0 rounded-3 text-white"
         style="background: linear-gradient(135deg, #198754, #20c997);">
      <div class="card-body">
        <h6 class="fw-light">Active Vehicles</h6>
        <h3 class="fw-bold">{{ $activeVehicles ?? 0}}</h3>
        <small>↗ currently running</small>
      </div>
    </div>
  </div>

  <!-- Pending Maintenance -->
  <div class="col-md-3">
    <div class="card shadow-lg border-0 rounded-3 text-white"
         style="background: linear-gradient(135deg, #fd7e14, #ffc107);">
      <div class="card-body">
        <h6 class="fw-light">Pending Maintenance</h6>
        <h3 class="fw-bold">{{ $pendingMaint ?? 0}}</h3>
        <small>↗ scheduled repairs</small>
      </div>
    </div>
  </div>

  <!-- Reports -->
  <div class="col-md-3">
    <div class="card shadow-lg border-0 rounded-3 text-white"
         style="background: linear-gradient(135deg, #6f42c1, #9c6ade);">
      <div class="card-body">
        <h6 class="fw-light">Reports</h6>
        <h3 class="fw-bold">{{ $reportsCount ?? 0}}</h3>
        <small>↗ this week</small>
      </div>
    </div>
  </div>
</div>

<div class="row mt-5">
  <div class="col-md-11">
    <h6 class="mb-3">Notification</h6>
    <ul class="list-group list-group-flush notification-list">
      @forelse($notifications as $note)
        <li class="list-group-item notification-item">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <span class="badge bg-primary me-2">{{ $note->type }}</span>
              <span >{{ $note->message }}</span>
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


<div class="row mt-5 container-fluid">
  <div class="col-md-11">
    <h6 class="mb-3">Fuel Consumption (Last 7 Days)</h6>
    <canvas id="fuelChart" height="150"></canvas>
  </div>
</div>
<!-- Chart.js -->

<script>
  const ctx = document.getElementById('fuelChart').getContext('2d');

  const fuelChart = new Chart(ctx, {
    type: 'line', // line chart
    data: {
      labels: ['6d ago', '5d ago', '4d ago', '3d ago', '2d ago', 'Yesterday', 'Today'],
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
          title: { display: true, text: 'Liters' }
        },
        x: {
          title: { display: true, text: 'Day' }
        }
      },
      plugins: {
        legend: { display: true, position: 'top' }
      }
    }
  });
</script>
@endsection
