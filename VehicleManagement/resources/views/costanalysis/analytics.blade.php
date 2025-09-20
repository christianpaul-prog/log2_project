@extends('layouts.app')
@section('title', 'Analytics Reports')
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

</style>
<div class="container-fluid slide-up py-5">
  <h2 class="mb-3">Analytics Reports</h2>

  <!-- Cost Chart -->
  <div class="card shadow-sm mb-5">
    <div class="card-body">
      <h5 class="card-title text-center">Current vs Past Month (Costs)</h5>
      <canvas id="lineChart" height="100"></canvas>
    </div>
  </div>

  <!-- Earnings Chart -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title text-center">Current vs Past Month (Earnings)</h5>
      <canvas id="earningsChart" height="100"></canvas>
    </div>
  </div>
</div>

<script>
  // 🟢 Labels (Weeks or Days)
  const labels = ["Week 1", "Week 2", "Week 3", "Week 4"];

  // 🟢 Costs
  const currentMonthCost = [12000, 15000, 11000, 12000];
  const pastMonthCost = [10000, 9000, 12000, 9000];

  // 🟢 Earnings
  const currentMonthEarnings = [20000, 25000, 23000, 24000];
  const pastMonthEarnings = [18000, 20000, 21000, 22000];

  // Cost Chart
  const costCtx = document.getElementById("lineChart").getContext("2d");
  new Chart(costCtx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: "Current Month Cost",
          data: currentMonthCost,
          borderColor: "#198754",   // Bootstrap green
          backgroundColor: "rgba(25,135,84,0.2)",
          fill: true,
          tension: 0.3
        },
        {
          label: "Past Month Cost",
          data: pastMonthCost,
          borderColor: "#0dcaf0",   // Bootstrap blue
          backgroundColor: "rgba(13,202,240,0.2)",
          fill: true,
          tension: 0.3
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: "top" },
        tooltip: {
          callbacks: {
            label: function(context) {
              return "₱" + context.raw.toLocaleString();
            }
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return "₱" + value.toLocaleString();
            }
          }
        }
      }
    }
  });

  // Earnings Chart
  const earningsCtx = document.getElementById("earningsChart").getContext("2d");
  new Chart(earningsCtx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: "Current Month Earnings",
          data: currentMonthEarnings,
          borderColor: "#ffc107",   // Bootstrap yellow
          backgroundColor: "rgba(255,193,7,0.2)",
          fill: true,
          tension: 0.3
        },
        {
          label: "Past Month Earnings",
          data: pastMonthEarnings,
          borderColor: "#6610f2",   // Bootstrap purple
          backgroundColor: "rgba(102,16,242,0.2)",
          fill: true,
          tension: 0.3
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: "top" },
        tooltip: {
          callbacks: {
            label: function(context) {
              return "₱" + context.raw.toLocaleString();
            }
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return "₱" + value.toLocaleString();
            }
          }
        }
      }
    }
  });
</script>
@endsection
