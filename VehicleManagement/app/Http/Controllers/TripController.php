<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\trip;
use App\Models\Reservation;
use App\Models\Drivers;
use Illuminate\Http\Request;


class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Fetch all trips with related vehicle, driver, and reservation
    $trips = Trip::with(['vehicle', 'driver', 'reservation'])
                 ->latest()
                 ->get();
    $drivers = Drivers::all();
    return view('dispatch.list_dispatch', compact('trips', 'drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch drivers that are NOT already on a dispatch (on_work)
        $drivers = Drivers::whereDoesntHave('trips', function ($query) {
            $query->whereIn('status', ['on_work', 'pending']);
        })->get();

         // Reservations without a trip, load the related vehicle
    $reservations = Reservation::with('vehicle')
        ->whereDoesntHave('trip')
        ->get();

    // Get all vehicles tied to those reservations
    $vehicles = $reservations->pluck('vehicle')->filter();

     return view('dispatch.create_dispatch', compact('drivers', 'reservations', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'vehicle_id'     => 'required|exists:vehicles,id',
            'driver_id'      => 'required|exists:drivers,id',
            'trip_cost'      => 'required|numeric|min:0',
            'instruction'    => 'nullable|string|max:1000',
        ]);

        // ✅ Create a new Trip
        $trip = new Trip();
        $trip->reservation_id = $validated['reservation_id'];
        $trip->vehicle_id     = $validated['vehicle_id'];
        $trip->driver_id      = $validated['driver_id'];
        $trip->trip_cost      = $validated['trip_cost'];
        $trip->status         = 'pending'; // initial status
        $trip->instruction    = $validated['instruction'] ?? null;

        $trip->save();

        return redirect()->back()->with('success', 'Trip assigned successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(trip $trip)
    {
        //
    }
}
