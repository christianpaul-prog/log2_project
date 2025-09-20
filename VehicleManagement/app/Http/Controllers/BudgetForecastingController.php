<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BudgetForecast;
use App\Models\CostAnalysis;

class BudgetForecastingController extends Controller
{
    public function index()
    {
        $forecasts = BudgetForecast::latest()->get();
        $forecastFuel        = BudgetForecast::where('category', 'fuel')->where('status', 'approved')->sum('amount');
        $forecastMaintenance = BudgetForecast::where('category', 'maintenance')->where('status', 'approved')->sum('amount');
        $forecastTrips       = BudgetForecast::where('category', 'trip')->where('status', 'approved')->sum('amount');

        $totalFuel = CostAnalysis::where('status', 'Closed')->sum('fuel_cost');
        $totalTrips = CostAnalysis::where('status', 'Closed')->sum('trip_expenses');
        $totalMaintenance = CostAnalysis::where('status', 'Closed')->sum('maintenance_cost');


        $forecasts = BudgetForecast::orderBy('created_at', 'desc')->paginate(10);


        // tamaan mo kung alin yung folder name na ginamit mo sa views
        return view('budget_forecasting.index', compact(
            'forecasts',
            'forecastFuel',
            'forecastMaintenance',
            'forecastTrips',
            'totalFuel',
            'totalMaintenance',
            'totalTrips',
        ));
    }

 public function store(Request $request)
{
    $request->validate([
        'category' => 'required|string',
        'amount'   => 'required|numeric|min:0',
        'month'    => 'required',
        'reason'   => 'nullable|string|max:255'
    ]);

    if ($request->category === 'all') {
        $categories = ['fuel', 'maintenance', 'trip'];

        foreach ($categories as $cat) {
            BudgetForecast::create([
                'category' => $cat,
                'amount'   => $request->amount,
                'month'    => $request->month,
                'reason'   => $request->reason ?? "Need fund for {$cat}",
                'status'   => 'pending',
            ]);
        }
    } else {
        BudgetForecast::create([
            'category' => $request->category,
            'amount'   => $request->amount,
            'month'    => $request->month,
            'reason'   => $request->reason,
            'status'   => 'pending',
        ]);
    }

    return redirect()->route('budget_forecasting.index')
        ->with('success', 'Forecast submitted for approval.');
}



    // Approve request (Finance role)
    public function approve($id)
    {
        $forecast = BudgetForecast::findOrFail($id);
        $forecast->update(['status' => 'approved']);
        return back()->with('success', 'Forecast approved!');
    }

    // Reject request (Finance role)
    public function reject($id)
    {
        $forecast = BudgetForecast::findOrFail($id);
        $forecast->update(['status' => 'rejected']);
        return back()->with('error', 'Forecast rejected!');
    }

    public function destroy($id)
    {
        $forecast = BudgetForecast::findOrFail($id);
        $forecast->delete();

        return redirect()->route('budget_forecasting.index')
            ->with('success', 'Forecast deleted successfully!');
    }
}
