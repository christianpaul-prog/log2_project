@extends('layouts.app')
@section('content')

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
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
        .hero-image {
            background: linear-gradient(to right, #007bff, #28a745);
            padding: 50px 0;
            color: white;
        }
        .dashboard-card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .chart-container {
            height: 300px;
        }
        .input-group-label {
            font-weight: bold;
        }
        h6 {
            color: #495057;
        }
        .badge-custom {
            background-color: #ffc107;
            color: #000;
        }
        /* Custom styles for uniqueness */
        .glow-on-hover:hover {
            box-shadow: 0 0 10px #007bff;
            transition: box-shadow 0.3s ease;
        }
        .cost-breakdown {
            background-color: #e9ecef;
            border-left: 5px solid #007bff;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-image h1 {
                font-size: 1.5rem;
            }
        }
    </style>

    <!-- Hero Section with Image -->


    <!-- Main Dashboard Container (Assuming Sidebar/Navbar is separate) -->
    <div class="container-fluid slide-up my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <!-- Input Section -->
                <div class="card dashboard-card mb-4 glow-on-hover">
                    <div class="card-header bg-primary text-white">
                        <h5><i class="fas fa-calculator me-2"></i>Fuel Cost Calculator</h5>
                    </div>
                    <div class="card-body">
                        <form id="fuelForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="distance" class="form-label input-group-label">
                                        <i class="fas fa-route"></i> Distance Traveled
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="distance" placeholder="e.g., 100" required>
                                        <span class="input-group-text" id="unitToggle">km</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="efficiency" class="form-label input-group-label">
                                        <i class="fas fa-gas-pump"></i> Fuel Efficiency
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="efficiency" placeholder="e.g., 15" required>
                                        <span class="input-group-text" id="effUnit">L/100km</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label input-group-label">
                                        <i class="fas fa-dollar-sign"></i> Fuel Price per Liter/Gallon
                                    </label>
                                    <input type="number" step="0.01" class="form-control" id="price" placeholder="e.g., 1.50" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="vehicle" class="form-label input-group-label">
                                        <i class="fas fa-car"></i> Vehicle Type
                                    </label>
                                    <select class="form-select" id="vehicle">
                                        <option>Standard Car</option>
                                        <option>SUV</option>
                                        <option>Truck</option>
                                        <option>Motorcycle</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-success me-2" id="calculateBtn">
                                    <i class="fas fa-play"></i> Calculate Cost
                                </button>
                                <button type="button" class="btn btn-secondary" id="unitSwitchBtn">
                                    Switch to Miles/Gallons
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Results Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card dashboard-card text-center bg-info text-white">
                            <div class="card-body">
                                <h6>Total Fuel Cost</h6>
                                <h3 id="totalCost">$0.00</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card dashboard-card text-center bg-warning text-dark">
                            <div class="card-body">
                                <h6>Cost per km/mile</h6>
                                <h3 id="costPerUnit">$0.00</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card dashboard-card text-center bg-success text-white">
                            <div class="card-body">
                                <h6>Fuel Liters/Gallons Needed</h6>
                                <h3 id="fuelNeeded">0.00</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card dashboard-card text-center bg-danger text-white">
                            <div class="card-body">
                                <h6>Estimated CO2 Emissions</h6>
                                <h3 id="co2Emissions">0.00 kg</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="card dashboard-card mb-4 glow-on-hover">
                    <div class="card-header bg-secondary text-white">
                        <h5><i class="fas fa-chart-line me-2"></i>Fuel Cost vs. Distance Insights</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="costChart" class="chart-container"></canvas>
                    </div>
                </div>

                <!-- Breakdown Table -->
                <div class="card dashboard-card mb-4">
                    <div class="card-header bg-light">
                        <h5><i class="fas fa-table me-2"></i>Cost Breakdown and Alternatives</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Scenario</th>
                                        <th>Estimated Cost</th>
                                        <th>Fuel Needed</th>
                                        <th>Savings Potential</th>
                                    </tr>
                                </thead>
                                <tbody id="breakdownBody">
                                    <!-- Rows will be populated by JS -->
                                </tbody>
                            </table>
                        </div>
                        <div class="alert cost-breakdown mt-3" role="alert">
                            <i class="fas fa-lightbulb me-2"></i>
                            <strong>Tip:</strong> Consider electric vehicles or carpooling for potential savings of up to 50% on fuel costs!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->

    <script>
        // Global variables
        let isMetric = true; // true for km/L, false for miles/gallon
        const ipsumVehicleFactors = { 'Standard Car': 1, 'SUV': 0.8, 'Truck': 0.7, 'Motorcycle': 1.2 }; // Efficiency adjustment
        let chart;

        // DOM elements
        const distanceInput = document.getElementById('distance');
        const efficiencyInput = document.getElementById('efficiency');
        const priceInput = document.getElementById('price');
        const vehicleSelect = document.getElementById('vehicle');
        const calculateBtn = document.getElementById('calculateBtn');
        const unitSwitchBtn = document.getElementById('unitSwitchBtn');
        const totalCostEl = document.getElementById('totalCost');
        const costPerUnitEl = document.getElementById('costPerUnit');
        const fuelNeededEl = document.getElementById('fuelNeeded');
        const co2EmissionsEl = document.getElementById('co2Emissions');
        const breakdownBody = document.getElementById('breakdownBody');
        const unitToggle = document.getElementById('unitToggle');
        const effUnit = document.getElementById('effUnit');

        // Function to calculate fuel cost
        function calculateFuelCost(distance, efficiency, price, vehicleFactor) {
            let fuelNeeded, costPerUnit, totalCost, co2;
            if (isMetric) {
                fuelNeeded = (distance * efficiency) / 100; // L
                totalCost = fuelNeeded * price;
                costPerUnit = totalCost / distance;
                co2 = fuelNeeded * 2.3; // Rough kg CO2 per liter
            } else {
                fuelNeeded = distance / efficiency; // gallons
                totalCost = fuelNeeded * price;
                costPerUnit = totalCost / distance;
                co2 = fuelNeeded * 8.8; // Rough kg CO2 per gallon
            }
            return { fuelNeeded: fuelNeeded.toFixed(2), totalCost: totalCost.toFixed(2), costPerUnit: costPerUnit.toFixed(2), co2: co2.toFixed(2) };
        }

        // Switch units
        unitSwitchBtn.addEventListener('click', () => {
            isMetric = !isMetric;
            if (isMetric) {
                unitToggle.textContent = 'km';
                effUnit.textContent = 'L/100km';
                unitSwitchBtn.textContent = 'Switch to Miles/Gallons';
            } else {
                unitToggle.textContent = 'miles';
                effUnit.textContent = 'mpg';
                unitSwitchBtn.textContent = 'Switch to km/Liters';
            }
            calculateBtn.click(); // Recalculate
        });

        // Calculate on button click
        calculateBtn.addEventListener('click', () => {
            const distance = parseFloat(distanceInput.value);
            const efficiency = parseFloat(efficiencyInput.value);
            const price = parseFloat(priceInput.value);
            const vehicle = vehicleSelect.value;
            const factor = ipsumVehicleFactors[vehicle];

            if (isNaN(distance) || isNaN(efficiency) || isNaN(price)) {
                alert('Please fill in all fields with valid numbers.');
                return;
            }

            const adjustedEfficiency = isMetric ? efficiency * factor : efficiency / factor; // Adjust for vehicle
            const results = calculateFuelCost(distance, adjustedEfficiency, price, factor);

            totalCostEl.textContent = `$${results.totalCost}`;
            costPerUnitEl.textContent = `$${results.costPerUnit}`;
            fuelNeededEl.textContent = results.fuelNeeded;
            co2EmissionsEl.textContent = `${results.co2} kg`;

            // Update chart
            updateChart(distance, efficiency, price, factor);

            // Update table
            const altEfficiency = adjustedEfficiency * 1.1; // Hypothetical alternative
            const altResults = calculateFuelCost(distance, altEfficiency, price, factor);
            const savings = (parseFloat(results.totalCost) - parseFloat(altResults.totalCost)).toFixed(2);
            breakdownBody.innerHTML = `
                <tr>
                    <td>Current Scenario</td>
                    <td>$${results.totalCost}</td>
                    <td>${results.fuelNeeded} ${isMetric ? 'L' : 'gal'}</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Hypothetical Efficient Vehicle</td>
                    <td>$${altResults.totalCost}</td>
                    <td>${altResults.fuelNeeded} ${isMetric ? 'L' : 'gal'}</td>
                    <td class="text-success">${savings > 0 ? 'Save $' + savings : 'N/A'}</td>
                </tr>
            `;
        });

        // Initialize Chart
        function updateChart(maxDistance, efficiency, price, factor) {
            const labels = [];
            const data = [];
            const adjustedEff = isMetric ? efficiency * factor : efficiency / factor;
            for (let dist = 10; dist <= maxDistance; dist += 10) {
                const cost = calculateFuelCost(dist, adjustedEff, price, factor).totalCost;
                labels.push(dist);
                data.push(cost);
            }
            if (chart) chart.destroy();
            const ctx = document.getElementById('costChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Fuel Cost ($)',
                        data: data,
                        borderColor: 'rgba(0, 123, 255, 1)',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: { display: true, text: 'Distance' }
                        },
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Cost ($)' }
                        }
                    }
                }
            });
        }
    </script>


@endsection('content')
