<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiclesreport;

class VehiclesreportController extends Controller
{
public function index(Request $request)
{
    // Start query
    $query = Vehiclesreport::query();

    // If may status filter, apply it
    if ($request->has('status') && $request->status != null) {
        $query->where('status', $request->status);
    }

    // Vehicles for the table (filtered kung may request)
    $vehicles = $query->latest()->paginate(10);

    // Counts for the dashboard boxes
    $totalVehicles    = Vehiclesreport::count();
    $activeCount      = Vehiclesreport::where('status', 'Active')->count();
    $inactiveCount    = Vehiclesreport::where('status', 'Inactive')->count();
    $maintenanceCount = Vehiclesreport::where('status', 'Under Maintenance')->count();

    return view('reports.vehiclereport.index', compact(
        'vehicles',
        'totalVehicles',
        'activeCount',
        'inactiveCount',
        'maintenanceCount'
    ));
}
    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        return view('reports.vehiclereport.create');
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'plate_number' => 'required|unique:vehiclesreports,plate_number', // ✅ fixed table
            'brand'        => 'nullable|string|max:100',
            'model'        => 'nullable|string|max:100',
            'year' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'color'        => 'nullable|string|max:50',
            'mileage'      => 'nullable|integer|min:0',
            'description' => 'nullable|string|max:100',
            'status'       => 'required|in:Active,Inactive,Under Maintenance',
        ]);

        Vehiclesreport::create($request->all()); // ✅ fixed model

        return redirect()->route('reports.vehiclereport.index')
            ->with('success', 'Vehicle added successfully.');
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehiclesreport $vehicle)
    {
        return view('reports.vehiclereport.edit', compact('vehicle'));
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, Vehiclesreport $vehicle)
    {
        $request->validate([
            'plate_number' => 'required|unique:vehiclesreports,plate_number,' . $vehicle->id, // ✅ fixed
            'brand'        => 'nullable|string|max:100',
            'model'        => 'nullable|string|max:100',
            'year'         => 'nullable|integer|min:1900|max:' . date('Y'),
            'color'        => 'nullable|string|max:50',
            'mileage'      => 'nullable|integer|min:0',
             'description' => 'nullable|string|max:100',
            'status'       => 'required|in:Active,Inactive,Under Maintenance',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('reports.vehiclereport.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehiclesreport $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('reports.vehiclereport.index')
            ->with('success', 'Vehicle deleted successfully.');
    }
}
