@extends('layouts.app')
@section('title', 'Available Cars')
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

    /* Stat cards */
    .stat-card {
        border: none;
        border-radius: 16px;
        color: #fff;
        padding: 20px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .stat-icon {
        font-size: 28px;
        opacity: 0.8;
    }
    .stat-title {
        font-size: 14px;
        margin: 0;
    }
    .stat-value {
        font-size: 24px;
        font-weight: 700;
    }

    /* Vehicle card */
      .vehicle-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 25px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .vehicle-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.15);
    }
    .table-custom {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .table-custom thead {
        background: linear-gradient(90deg, #0d6efd, #0a58ca);
        color: #fff;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .table-custom tbody tr:hover {
        background-color: #f1f6ff;
        transition: 0.2s ease-in-out;
    }
    .table-custom td, .table-custom th {
        vertical-align: middle;
        padding: 12px 15px;
        transition: all .3s ease;
    }
     .table-custom td:hover{
        transform: translateY(-5px);
     }
    .badge {
        font-size: 13px;
        padding: 6px 10px;
        border-radius: 30px;
    }
    .action-btns .btn {
        border-radius: 20px;
        font-size: 13px;
        padding: 6px 12px;
        margin: 2px;
        transition: all 0.2s ease;
    }
    .action-btns .btn-warning:hover {
        background-color: #d39e00;
        border-color: #c69500;
        color: #fff;
    }
    .action-btns .btn-danger:hover {
        background-color: #bb2d3b;
        border-color: #b02a37;
        color: #fff;
    }
    .filter-bar {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}
.filter-btn {
  border: 1px solid #dee2e6;
  border-radius: 8px;
  padding: 6px 14px;
  font-size: 14px;
  background: #fff;
  color: #495057;
  transition: all 0.2s ease;
  cursor: pointer;
}
.filter-btn:hover {
  background: #f1f3f5;
}
.filter-btn.active {
  background: #0d6efd;
  color: #fff;
  border-color: #0d6efd;
  font-weight: 600;
}
</style>
<div class="row g-4 mt-3 justify-content-center ">
    <h4 class="mb-2 text-center">Fleet Availability Overview</h4>
    <h6 class=" text-center">(See Which Vehicles Are Ready for Use)</h6>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #0d6efd, #0dcaf0);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="stat-title">Total Vehicles</p>
                    <h3 class="stat-value">{{ $totalVehicles ?? 0 }}</h3>
                </div>
                <i class="fa-solid fa-car stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #198754, #20c997);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="stat-title">Available</p>
                    <h3 class="stat-value">{{ $activeCount ?? 0 }}</h3>
                </div>
                <i class="fa-solid fa-circle-check stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #6c757d, #adb5bd);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="stat-title">Not Available</p>
                    <h3 class="stat-value">{{ $inactiveCount ?? 0 }}</h3>
                </div>
                <i class="fa-solid fa-ban stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card" style="background: linear-gradient(135deg, #ffc107, #fd7e14);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="stat-title">Under Maintenance</p>
                    <h3 class="stat-value">{{ $maintenanceCount ?? 0 }}</h3>
                </div>
                <i class="fa-solid fa-screwdriver-wrench stat-icon"></i>
            </div>
        </div>
    </div>
</div>
<div class="mb-4 filter-bar mt-5">
    <a href="{{ route('reports.vehiclereport.index') }}" 
       class="filter-btn {{ request('status') == null ? 'active' : '' }}">
       All
    </a>
    <a href="{{ route('reports.vehiclereport.index', ['status' => 'Active']) }}" 
       class="filter-btn {{ request('status') == 'Active' ? 'active' : '' }}">
       Available ({{ $activeCount ?? 0 }})
    </a>
    <a href="{{ route('reports.vehiclereport.index', ['status' => 'Inactive']) }}" 
       class="filter-btn {{ request('status') == 'Inactive' ? 'active' : '' }}">
       Not Available ({{ $inactiveCount ?? 0 }})
    </a>
    <a href="{{ route('reports.vehiclereport.index', ['status' => 'Under Maintenance']) }}" 
       class="filter-btn {{ request('status') == 'Under Maintenance' ? 'active' : '' }}">
       Under Maintenance ({{ $maintenanceCount ?? 0 }})
    </a>
</div>
<!-- Vehicle Table -->
<div class="container-fluid mt-5">
    <div class="vehicle-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="page-title"><i class="fa-solid fa-car"></i> Availability</h2>
            <a href="{{ route('reports.vehiclereport.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fa-solid fa-plus"></i> Add Vehicle Reports
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th>Plate Number</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Color</th>
                        <th>Mileage</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                    <tr>
                        <td><strong>{{ $vehicle->plate_number }}</strong></td>
                        <td>{{ $vehicle->brand }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->year }}</td>
                        <td><span class="badge bg-light text-dark">{{ $vehicle->color }}</span></td>
                        <td>{{ $vehicle->mileage }} km</td>
                        <td>{{ $vehicle->description }}</td>
                        <td>
                            @if($vehicle->status == 'Active')
                                <span class="badge bg-success">Available</span>
                            @elseif($vehicle->status == 'Inactive')
                                <span class="badge bg-secondary">Not Available</span>
                            @else
                                <span class="badge bg-warning text-dark">Under Maintenance</span>
                            @endif
                        </td>
                        <td class="text-center action-btns">
                            <a href="{{ route('reports.vehiclereport.edit', $vehicle->id) }}" class="btn btn-sm btn-warning shadow-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form action="{{ route('reports.vehiclereport.destroy', $vehicle->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this vehicle?')" class="btn btn-sm btn-danger shadow-sm">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">🚗 No vehicles found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $vehicles->links() }}
        </div>
    </div>
</div>
@endsection
