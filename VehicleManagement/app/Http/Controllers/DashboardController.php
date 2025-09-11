<?php
namespace App\Http\Controllers;

use App\Models\Vehicles;
use App\Models\Driver;
use App\Models\Maintenance;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Vehicles
        $totalVehicles     = Vehicles::count();
        $activeVehicles    = Vehicles::where('status', 'active')->count();
        $inactiveVehicles  = Vehicles::where('status', 'inactive')->count();

        // Drivers
        $activeDrivers     = Driver::where('status', 'active')->count();
        $inactiveDrivers   = Driver::where('status', 'inactive')->count();

        // Maintenance
        $pendingMaint      = Maintenance::where('status','pending')->count();
        $completedMaint    = Maintenance::where('status','completed')->count();

        // Reports
        $reportsCount      = Report::count();

        // Latest vehicles
        $latestVehicles    = Vehicles::latest()->take(5)->get();

        return view('pages.dashboard', compact(
            'totalVehicles',
            'activeVehicles',
            'inactiveVehicles',
            'activeDrivers',
            'inactiveDrivers',
            'pendingMaint',
            'completedMaint',
            'reportsCount',
            'latestVehicles'
        ));
    }
}

