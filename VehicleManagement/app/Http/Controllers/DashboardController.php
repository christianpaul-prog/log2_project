<?php
namespace App\Http\Controllers;

use App\Models\Vehicles;
use App\Models\Maintenance;
use App\Models\Report;
use App\Models\Trip;
use App\Models\Reservation;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles    = Vehicles::count();
  $pendingMaint = Maintenance::where('status','in_progress')->count();
    $notifications = Notification::whereIn('type', ['Maintenance', 'Vehicle'])
        ->latest()
        ->take(5)
        ->get();
     
      

        return view('pages.dashboard', compact(
            'totalVehicles',
            'pendingMaint',
              'notifications'
       
           
        ));
    }
public function destroyNotification($id)
{
    
    $notification = Notification::where('id', $id)
        ->whereIn('type', ['Maintenance', 'Vehicle'])
        ->first();

    if (!$notification) {
        return redirect()->back()->with('error', 'This notification cannot be deleted from the dashboard.');
    }

    $notification->delete();

    return redirect()->back()->with('success', 'Notification deleted successfully!');
}

}
