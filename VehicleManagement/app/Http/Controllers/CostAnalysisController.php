<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CostAnalysis;
use App\Models\Notification; 
use App\Models\CostLog; 

class CostAnalysisController extends Controller
{
    public function index()
    {

        // list of records (paginated)
        $costs = CostAnalysis::latest()->paginate(10);
         $logs = CostLog::latest()->paginate(10);

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
        $notifications = Notification::where('type', 'Cost')->latest()->take(10)->get();
        $tripNotifications = Notification::where('type', 'Trip')->latest()->take(10)->get();

        return view('costanalysis.index', compact(
            'totalFuel',
            'totalTrips',
            'totalMaintenance',
            'fuelChange',
            'tripChange',
            'maintenanceChange',
            'costs',
            'notifications',
            'logs',
             'tripNotifications'
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

    $cost = CostAnalysis::create($request->all());

    // Kung agad na Closed ang status, gumawa rin ng log
    if ($cost->status === 'Closed') {
        $category = null;
        $expenseAmount = 0;

        if ($cost->fuel_cost > 0) {
            $category = 'fuel';
            $expenseAmount = $cost->fuel_cost;
        } elseif ($cost->maintenance_cost > 0) {
            $category = 'maintenance';
            $expenseAmount = $cost->maintenance_cost;
        } elseif ($cost->trip_expenses > 0) {
            $category = 'trip';
            $expenseAmount = $cost->trip_expenses;
        }

        if ($category) {
            CostLog::create([
                'cost_id'  => $cost->id,
                'vehicle'  => $cost->vehicle,
                'category' => $category,
                'amount'   => $expenseAmount,
                'action'   => 'Closed',
            ]);

            Notification::create([
                'type'    => ucfirst($category),
                'message' => ucfirst($category) . " cost record created as Closed with ₱" . number_format($expenseAmount, 2),
            ]);
        }
    }

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

public function close($id)
{
    $cost = CostAnalysis::findOrFail($id);

    if ($cost->status === 'Closed') {
        return redirect()->back()->with('error', 'This record is already closed.');
    }

    $category = null;
    $expenseAmount = 0;

    if ($cost->fuel_cost > 0) {
        $category = 'fuel';
        $expenseAmount = $cost->fuel_cost;
    } elseif ($cost->maintenance_cost > 0) {
        $category = 'maintenance';
        $expenseAmount = $cost->maintenance_cost;
    } elseif ($cost->trip_expenses > 0) {
        $category = 'trip';
        $expenseAmount = $cost->trip_expenses;
    }

    
    $forecastAmount = \App\Models\BudgetForecast::where('category', $category)
                        ->where('status', 'approved')
                        ->sum('amount');

    $usedAmount = 0;
    if ($category === 'fuel') {
        $usedAmount = CostAnalysis::where('status', 'Closed')->sum('fuel_cost');
    } elseif ($category === 'maintenance') {
        $usedAmount = CostAnalysis::where('status', 'Closed')->sum('maintenance_cost');
    } elseif ($category === 'trip') {
        $usedAmount = CostAnalysis::where('status', 'Closed')->sum('trip_expenses');
    }

   
    $remaining = $forecastAmount - $usedAmount;

    if ($expenseAmount > $remaining) {
        return redirect()->back()->with('error', 'Not enough balance in budget forecast to close this record.');
    }

   
    $cost->update(['status' => 'Closed']);

    
   Notification::create([
        'type' => ucfirst($category),
        'message' => ucfirst($category) . " cost record closed with ₱" . number_format($expenseAmount, 2),
    ]);
 CostLog::create([
        'cost_id' => $cost->id,
        'vehicle' => $cost->vehicle,
        'category' => $category,
        'amount' => $expenseAmount,
        'action' => 'Closed',
    ]);

  
    return redirect()->back()->with('success', ucfirst($category) . ' cost closed successfully!');
}





    public function destroyNotification($id)
    {
      
        $notification = Notification::where('id', $id)
            ->where('type', 'Maintenance') 
            ->first();

        if (!$notification) {
            return redirect()->back()->with('error', 'Only maintenance notifications can be deleted from the dashboard.');
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Maintenance notification deleted successfully!');
    }

}
