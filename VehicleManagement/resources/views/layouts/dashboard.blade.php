@extends('layouts.apps')
@section('title', 'Dashboard')
@section('content')
<div class="container py-4">

    <!-- Page Title -->
    <h2 class="mb-4">Logistics Dashboard</h2>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Active Shipments</h5>
                    <p class="card-text fs-4">124</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Vehicles Available</h5>
                    <p class="card-text fs-4">56</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Pending Deliveries</h5>
                    <p class="card-text fs-4">32</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Issues Reported</h5>
                    <p class="card-text fs-4">5</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Shipments Table -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            Recent Shipments
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Shipment ID</th>
                        <th>Destination</th>
                        <th>Status</th>
                        <th>Driver</th>
                        <th>ETA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>SH-2025-001</td>
                        <td>Manila</td>
                        <td><span class="badge bg-success">Delivered</span></td>
                        <td>Juan Dela Cruz</td>
                        <td>—</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>SH-2025-002</td>
                        <td>Cebu</td>
                        <td><span class="badge bg-warning text-dark">In Transit</span></td>
                        <td>Maria Santos</td>
                        <td>3h</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>SH-2025-003</td>
                        <td>Davao</td>
                        <td><span class="badge bg-danger">Delayed</span></td>
                        <td>Jose Rizal</td>
                        <td>+5h</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
