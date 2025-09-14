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
 $notifications = Notification::latest()->take(10)->get();

        // aggregate metrics
        $totalFuel        = CostAnalysis::sum('fuel_cost');
        $totalMaintenance = CostAnalysis::sum('maintenance_cost');
        $totalTrips       = CostAnalysis::sum('trip_expenses');
        $grandTotal       = CostAnalysis::sum('total_cost');

        

        // tamaan mo kung alin yung folder name na ginamit mo sa views
        return view('costanalysis.index', compact(
            'costs',
            'notifications',
            'totalFuel',
            'totalMaintenance',
            'totalTrips',
            'grandTotal'
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
            'status'           => 'required|in:Pending,Closed,Maintenance',
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
            'status'           => 'required|in:Pending,Closed,Maintenance',
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
    $notification = Notification::findOrFail($id);
    $notification->delete();

    return redirect()->back()->with('success', 'Notification deleted successfully!');
}
}


