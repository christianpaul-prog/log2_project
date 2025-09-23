<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 
use App\Models\Vehicles;
use App\Models\Maintenance;
use App\Models\Shift;
use App\Models\DriverReport;
use App\Models\Report;
use App\Models\Trip;
use App\Models\Reservation;
use App\Models\Notification;
use App\Http\Middleware\SessionTimeout;
use Illuminate\Http\Request;


class DashboardController extends Controller
{


    public function index()
    {
        $totalVehicles    = Vehicles::count();
        $pendingMaint = Maintenance::where('status', 'in_progress')->count();
         $reportsCount    = DriverReport::count();
        $notifications = Notification::whereIn('type', ['vehicle_service', 'Vehicle','driver_report'])
        
            ->latest()
            ->take(10)
            ->get();




        return view('pages.dashboard', compact(
            'totalVehicles',
            'pendingMaint',
            'reportsCount',
            'notifications'


        ));
    }

    public function destroyNotification($id)
    {
        // hanapin lang yung notification na pasok sa dashboard types
        $notification = Notification::where('id', $id)
            ->whereIn('type', ['vehicle_service', 'Vehicle'])
            ->first();


        if (!$notification) {
            return redirect()->back()->with('error', 'This notification cannot be deleted from the dashboard.');
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully!');
    }
        public function performance()
    {
       // Fetch shifts only if their related trip has allowed statuses
    $shifts = Shift::with([
            'driver',
            'trip.reservation',
            'trip.vehicle',
            'trip.information'
        ])
        ->whereHas('trip', function ($query) {
            $query->whereIn('status', ['completed', 'on_work', 'cancelled']);
        })
        ->latest()
        ->paginate(10);

        return view('trips.performance', compact('shifts'));
    }
    
    public function report()
    {
        // Fetch all reports with their related driver
        $reports = DriverReport::with('driver')->latest()->paginate(10);

        return view('driver.report', compact('reports'));
    }



}
