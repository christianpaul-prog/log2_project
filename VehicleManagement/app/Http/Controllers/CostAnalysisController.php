<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CostAnalysis;
use App\Models\Notification; // <-- import model

class CostAnalysisController extends Controller
{
    public function index()
    {
        
        // list of records (paginated)
        $costs = CostAnalysis::latest()->paginate(10);
 $notifications = Notification::where('type', 'Maintenance')
    ->latest()
    ->take(10)
    ->get();

  // Kunin lahat ng total per category
  $totalFuel = CostAnalysis::where('status', 'Closed')->sum('fuel_cost');
$totalTrips = CostAnalysis::where('status', 'Closed')->sum('trip_expenses');
$totalMaintenance = CostAnalysis::where('status', 'Closed')->sum('maintenance_cost');

// Kunin yung previous na total para may comparison
$prevFuel = CostAnalysis::whereMonth('date', now()->subMonth()->month)->sum('fuel_cost');
$prevTrips = CostAnalysis::whereMonth('date', now()->subMonth()->month)->sum('trip_expenses');
$prevMaintenance = CostAnalysis::whereMonth('date', now()->subMonth()->month)->sum('maintenance_cost');

// Compute percentage change (iwas divide by zero)
$fuelChange = $prevFuel > 0 ? (($totalFuel - $prevFuel) / $prevFuel) * 100 : 0;
$tripChange = $prevTrips > 0 ? (($totalTrips - $prevTrips) / $prevTrips) * 100 : 0;
$maintenanceChange = $prevMaintenance > 0 ? (($totalMaintenance - $prevMaintenance) / $prevMaintenance) * 100 : 0;


    // Notifications
    $notifications = Notification::where('type', 'Maintenance')->latest()->take(10)->get();

return view('costanalysis.index', compact(
    'totalFuel', 'totalTrips', 'totalMaintenance',
    'fuelChange', 'tripChange', 'maintenanceChange',
    'costs', 'notifications'
));

    }

    public function store(Request $request)
    {
        $request->validate([
            'date'             => 'required|date',
            'vehicle'          => 'required|string|max:255',
            'fuel_cost'        => 'required|numeric|min:0',
            'maintenance_cost' => 'required|numeric|min:0',
            'trip_expenses'    => 'required|numeric|min:0',
            'status'           => 'required|in:Pending,Closed',
        ]);

        CostAnalysis::create($request->all());
        return redirect()->route('costanalysis.index')->with('success', 'Cost record added successfully!');
    }

    public function edit(CostAnalysis $costAnalysis)
    {
        return view('costanalysis.edit', compact('costAnalysis'));
    }

    public function update(Request $request, CostAnalysis $costAnalysis)
    {
        $request->validate([
            'date'             => 'required|date',
            'vehicle'          => 'required|string|max:255',
            'fuel_cost'        => 'required|numeric|min:0',
            'maintenance_cost' => 'required|numeric|min:0',
            'trip_expenses'    => 'required|numeric|min:0',
            'status'           => 'required|in:Pending',
        ]);

        $costAnalysis->update($request->all());
        return redirect()->route('costanalysis.index')->with('success', 'Cost record updated successfully!');
    }

   public function destroy($id)
{
    $cost = CostAnalysis::findOrFail($id);
    $cost->delete();

    return redirect()->route('costanalysis.index')->with('success', 'Cost record deleted successfully!');
}


public function destroyNotification($id)
{
    // Hanapin lang kung notification ay maintenance type
    $notification = Notification::where('id', $id)
        ->where('type', 'Maintenance') // filter by type
        ->first();

    if (!$notification) {
        return redirect()->back()->with('error', 'Only maintenance notifications can be deleted from the dashboard.');
    }

    $notification->delete();

    return redirect()->back()->with('success', 'Maintenance notification deleted successfully!');
}


}


