<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Vehicles;
use App\Models\Drivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
            $query->where('status', 'on_progress');
        })
            ->whereDoesntHave('trips', function ($query) {
                $query->where('status', ['on_work', 'pending']);
            })
            ->get();

        // Fetch drivers that are NOT already on a dispatch (on_work)
        $drivers = Drivers::whereDoesntHave('trips', function ($query) {
            $query->where('status', 'on_work');
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
        'type' => 'Maintenance',
        'message' => "Maintenance created for Vehicle ID {$maintenance->vehicle_id} with cost ₱" . number_format($maintenance->cost, 2),
    ]);
        return redirect()->route('maintenance.index')->with('success', 'Maintenance record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $maintenance = Maintenance::findOrFail($id);

    $validated = $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'service_details' => 'required|string|max:1000',
        'cost' => 'required|numeric|min:0',
        'service_type' => 'required|in:oil_change,tire_rotation,brake_service,battery_replacement,engine_service,inspection',
        'notes' => 'nullable|string|max:1000',
    ]);

    // Add auto status
    $validated['status'] = 'completed';

    // Update record
    $maintenance->update($validated);
      Notification::create([
        'type' => 'Maintenance',
        'message' => "Maintenance for Vehicle ID {$maintenance->vehicle_id} completed. Final cost: ₱" . number_format($maintenance->cost, 2),
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
