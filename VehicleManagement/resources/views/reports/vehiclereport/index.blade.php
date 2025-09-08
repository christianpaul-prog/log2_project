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
    .vehicle-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 25px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .vehicle-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.2);
    }
    .table {
        border-radius: 12px;
        overflow: hidden;
    }
    .table thead {
        background: #0d6efd;
        color: #fff;
    }
    .table-striped tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }
    .action-btns .btn {
        margin-right: 5px;
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 14px;
    }
    .page-title {
        font-weight: 700;
    }
    .card{
        transition: all .3s ease;
    }
    .card:hover{
           transform: translateY(-5px);
    }
</style>
 <div class="row g-4 mt-5 justify-content-center">
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <h6 class="text-muted">Total Vehicles Active</h6>
                    <h3 class="fw-bold">{{ $totalVehicles ?? 0}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <h6 class="text-muted">Active</h6>
                    <h3 class="fw-bold">{{ $activeCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
         <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <h6 class="text-muted">In active</h6>
                    <h3 class="fw-bold">{{ $inactiveCount ?? 0}}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <h6 class="text-muted">Under Maintenance</h6>
                    <h3 class="fw-bold">{{ $maintenanceCount ?? 0}}</h3>
                </div>
            </div>
        </div>
       
    </div>
<div class="container-fluid slide-up mt-5">
    <div class="vehicle-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="page-title"><i class="fa-solid fa-car"></i> Vehicles</h2>
            <a href="{{ route('reports.vehiclereport.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Add Vehicle Reports
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>Plate Number</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Color</th>
                        <th>Mileage</th>
                        <th>Description Reports</th>
                        <th>Status</th>
                        
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->plate_number }}</td>
                        <td>{{ $vehicle->brand }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->year }}</td>
                        <td>{{ $vehicle->color }}</td>
                        <td>{{ $vehicle->mileage }} km</td>
                          <td>{{ $vehicle->description }} </td>
                        <td>
                            @if($vehicle->status == 'Active')
                                <span class="badge bg-success">{{ $vehicle->status }}</span>
                            @elseif($vehicle->status == 'Inactive')
                                <span class="badge bg-secondary">{{ $vehicle->status }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ $vehicle->status }}</span>
                            @endif
                        </td>
                        <td class="text-center action-btns">
                            <a href="{{ route('reports.vehiclereport.edit', $vehicle->id) }}" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form action="{{ route('reports.vehiclereport.destroy', $vehicle->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this vehicle?')" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">🚗 No vehicles found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $vehicles->links() }}
        </div>
    </div>
</div>

@endsection
