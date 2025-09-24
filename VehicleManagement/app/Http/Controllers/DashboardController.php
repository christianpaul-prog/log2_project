<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicles;
use App\Models\Maintenance;
use App\Models\Shift;
use App\Models\DriverReport;
use App\Models\Report;
use App\Models\Trip;
use Carbon\Carbon;
use App\Models\CostAnalysis;
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
        $notifications = Notification::whereIn('type', ['vehicle_service', 'Vehicle', 'driver_report'])
            ->latest()
            ->take(10)
            ->get();

        // --- Fleet Usage Data (last 14 days) ---
        $startDate = Carbon::now()->subDays(13)->startOfDay();
        $endDate   = Carbon::now()->endOfDay();

        // Completed
        $completed = Trip::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->pluck('total', 'date');

        // Cancelled
        $cancelled = Trip::where('status', 'cancelled')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->pluck('total', 'date');

        // Align data for chart
        $labels        = [];
        $completedData = [];
        $cancelledData = [];

        for ($i = 0; $i < 14; $i++) {
            $day = $startDate->copy()->addDays($i)->toDateString();
            $labels[]        = Carbon::parse($day)->format('D'); // Mon, Tue
            $completedData[] = $completed->get($day, 0);
            $cancelledData[] = $cancelled->get($day, 0);
        }

        return view('pages.dashboard', compact(
            'totalVehicles',
            'pendingMaint',
            'reportsCount',
            'notifications',
            'labels',
            'completedData',
            'cancelledData',
        ));
    }

    public function destroyNotification($id)
{
    $notification = Notification::find($id);

    if (!$notification) {
        return redirect()->back()->with('error', 'Notification not found.');
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

        $drivershifts = Shift::with([
            'driver',
            'trip.reservation',
            'trip.vehicle',
            'trip.information'
        ])
            ->whereHas('trip', function ($query) {
                $query->whereIn('status', ['completed', 'cancelled']);
            })
            ->latest()
            ->paginate(10);

        $totalTrips   = Trip::count();
        $completed = Trip::where('status', 'completed')->count();
        $cancelled = Trip::where('status', 'cancelled')->count();
        // Calculate Success Rate safely (avoid division by zero)
        $successRate = $totalTrips > 0 ? round(($completed / $totalTrips) * 100, 2) : 0;
        return view('trips.performance', compact(
            'shifts',
            'drivershifts',
            'totalTrips',
            'completed',
            'cancelled',
            'successRate'
        ));
    }


    public function report()
    {
        // Fetch all reports with their related driver
        $reports = DriverReport::with('driver')->latest()->paginate(10);
foreach ($reports as $report) {
        // check kung wala pang notif para sa report na ito
        if (!Notification::where('type', 'driver_report')->where('message', 'like', "%{$report->id}%")->exists()) {
            Notification::create([
                'type'    => 'driver_report',
                'message' => "Report #{$report->id}: Fuel ₱" . number_format($report->fuel, 2),
            ]);

            CostAnalysis::create([
                'date'             => now(),
                'vehicle'          => $report->driver->vehicle->plate_no ?? 'N/A',
                'fuel_cost'        => $report->fuel,
                'maintenance_cost' => 0,
                'trip_expenses'    => $report->dispatch_cost,
                'status'           => 'Pending',
            ]);
        }
    }
        return view('driver.report', compact('reports'));
    }
    public function destroy(DriverReport $driverReport)
    {
        $driverReport->delete();

        return redirect()->back()->with('success', 'Driver report deleted successfully!');
    }
}
