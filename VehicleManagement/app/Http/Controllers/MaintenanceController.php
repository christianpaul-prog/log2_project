<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use App\Models\Notification;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all maintenances with related vehicle, ordered by latest, paginated
        $maintenances = Maintenance::with('vehicle')
            ->latest()
            ->paginate(10); // 👈 10 items per page (adjust as needed)

        $vehicles = Vehicles::all(); // still fetch all vehicles for the view

        return view('vehicles.list_maintenance', compact('maintenances', 'vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicles::whereDoesntHave('maintenances', function ($query) {
            $query->where('status', 'in_progress');
        })
        ->whereDoesntHave('trips', function ($query) {
            $query->whereIn('status', ['on_work', 'pending']);
        })
        ->get();
        return view('vehicles.maintenance', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $maintenance = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'service_details' => 'required|string|max:1000',
            'cost' => 'required|numeric|min:0',
            'service_type' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);
        

        // Create a new maintenance record
        $maintenance = new Maintenance();
        $maintenance->vehicle_id = $request->vehicle_id;
        $maintenance->start_date = $request->start_date;
        $maintenance->end_date = $request->end_date;
        $maintenance->service_details = $request->service_details;
        $maintenance->cost = $request->cost;
        $maintenance->service_type = $request->service_type;
        $maintenance->notes = $request->notes;
        $maintenance->status = 'in_progress'; // Set initial status to in_progress

        $maintenance->save(); // Save the maintenance record to the database

        Notification::create([
            'type' => 'Cost',
            'message' => "Maintenance created for Vehicle ID {$maintenance->vehicle_id} with cost ₱" . number_format($maintenance->cost, 2),
        ]);
      Notification::create([
    'type' => 'vehicle_service', // 👈 para sa dashboard
    'message' => "New Maintenance Service created for Vehicle ID {$maintenance->vehicle_id}: {$maintenance->service_type}",
]);
        return redirect()->route('maintenance.index')->with('success', 'Maintenance record created successfully.');
    }
    /**
     * Update the specified resource in storage.
     */
public function complete($id)
{
    $maintenance = Maintenance::findOrFail($id);

    $maintenance->status = 'completed';
    $maintenance->save();

    Notification::create([
        'type' => 'Cost',
        'message' => "Maintenance for Vehicle ID {$maintenance->vehicle_id} completed. Final cost: ₱" . number_format($maintenance->cost, 2),
    ]);
    Notification::create([
    'type' => 'vehicle_service',
    'message' => "Maintenance for Vehicle ID {$maintenance->vehicle_id} completed. Service: {$maintenance->service_type}",
]);

    return redirect()->route('maintenance.index')
        ->with('success', 'Maintenance record updated and marked as completed.');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete(); // Delete the maintenance record
        return redirect()->route('maintenances.completed')->with('success', 'Maintenance record deleted successfully.');
    }
}
