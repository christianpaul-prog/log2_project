<?php
namespace App\Http\Controllers;

use App\Models\Vehicles;
use App\Models\Maintenance;
use App\Models\Report;
use App\Models\Trip;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles    = Vehicles::count();
        $activeVehicles   = Vehicles::where('status', 'active')->count();
        $pendingMaint     = Maintenance::where('status', 'pending')->count();
        $reportsCount     = Report::count();
        $totalTrips       = Trip::count();
        $totalReservations= Reservation::count();

        return view('dashboard.index', compact(
            'totalVehicles',
            'activeVehicles',
            'pendingMaint',
            'reportsCount',
            'totalTrips',
            'totalReservations'
        ));
    }
}
