@extends('layouts.app')
@section('content')
<style>
    .container{
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
          <div class="container py-5 slide-up">
    <!-- Dashboard Header -->
    <div class="text-center mb-4">
      <h2 class="fw-bold">Dashboard</h2>
      <p class="text-muted">Welcome back, User!</p>
    </div>

    <!-- Cards Row -->
    <div class="row g-4 mb-5 justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <h5 class="card-title">Users</h5>
            <p class="display-6 fw-bold text-primary">120</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <h5 class="card-title">Sales</h5>
            <p class="display-6 fw-bold text-success">₱25,000</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-0">
          <div class="card-body text-center">
            <h5 class="card-title">Orders</h5>
            <p class="display-6 fw-bold text-warning">85</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Section -->
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white">
        <h5 class="mb-0">Recent Transactions</h5>
      </div>
      <div class="card-body">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Customer</th>
              <th>Product</th>
              <th>Status</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Juan Dela Cruz</td>
              <td>Laptop</td>
              <td><span class="badge bg-success">Completed</span></td>
              <td>₱45,000</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Maria Clara</td>
              <td>Phone</td>
              <td><span class="badge bg-warning">Pending</span></td>
              <td>₱15,000</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Jose Rizal</td>
              <td>Tablet</td>
              <td><span class="badge bg-danger">Cancelled</span></td>
              <td>₱10,000</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

@endsection('content')
