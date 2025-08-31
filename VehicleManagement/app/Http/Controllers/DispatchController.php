<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use App\Models\Vehicles;
use App\Models\Drivers;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dispatches = Dispatch::with(['vehicle', 'driver'])
            ->latest()
            ->get();

        return view('dispatch.list_dispatch', compact('dispatches'));
    }
    public function activeList()
    {
        $vehicles = Vehicles::whereDoesntHave('maintenances', function ($query) {
            $query->where('status', 'on_progress');
        })
            ->whereDoesntHave('dispatches', function ($query) {
                $query->where('status', 'on_work');
            })
            ->get();

        // Fetch drivers that are NOT already on a dispatch (on_work)
        $drivers = Drivers::whereDoesntHave('dispatches', function ($query) {
            $query->where('status', 'on_work');
        })
            ->get();
        
        return view('dispatch.drivers_vehicles', compact('vehicles', 'drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // Fetch vehicles that are NOT in maintenance (on_progress) 
        // AND NOT already dispatched (on_work)
        $vehicles = Vehicles::whereDoesntHave('maintenances', function ($query) {
            $query->where('status', 'on_progress');
        })
            ->whereDoesntHave('dispatches', function ($query) {
                $query->where('status', 'on_work');
            })
            ->get();

        // Fetch drivers that are NOT already on a dispatch (on_work)
        $drivers = Drivers::whereDoesntHave('dispatches', function ($query) {
            $query->where('status', 'on_work');
        })
            ->get();

        return view('dispatch.create_dispatch', compact('vehicles', 'drivers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'location' => 'required|string|max:255',
            'dispatch_date' => 'required|date',
            'dispatch_time' => 'required|date_format:H:i',
            'priority_level' => 'required|string|in:low,medium,high',
            'cargo_details' => 'nullable|string|max:1000',
        ]);

        // Create a new dispatch record
        $dispatch = new Dispatch();
        $dispatch->vehicle_id = $request->vehicle_id;
        $dispatch->driver_id = $request->driver_id;
        $dispatch->location = $request->location;
        $dispatch->dispatch_date = $request->dispatch_date;
        $dispatch->dispatch_time = $request->dispatch_time;
        $dispatch->priority_level = strtolower($request->priority_level); // Store as lowercase
        $dispatch->cargo_details = $request->cargo_details;
        $dispatch->status = 'on_work'; // Set initial status to on_work
        $dispatch->save();

        return redirect()->route('dispatch.index')->with('success', 'Dispatch order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dispatch $dispatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dispatch $dispatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dispatch $dispatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dispatch = Dispatch::findOrFail($id);
        $dispatch->delete();

        return redirect()->route('dispatch.index')->with('success', 'Dispatch order deleted successfully.'); 
    }
}
