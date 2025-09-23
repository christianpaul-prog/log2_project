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

        // --- Fleet Usage Data (last 7 days) ---
        $startDate = Carbon::now()->subDays(6)->startOfDay();
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

        for ($i = 0; $i < 7; $i++) {
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

        return view('driver.report', compact('reports'));
    }
}
