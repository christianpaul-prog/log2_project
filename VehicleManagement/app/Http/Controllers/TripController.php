<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\trip;
use App\Models\Reservation;
use App\Models\Information;
use Illuminate\Http\Request;


class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all trips with related vehicle, driver, and reservation, paginated
        $trips = Trip::with(['vehicle', 'information', 'reservation'])
            ->latest()
            ->paginate(10); // 👈 change 10 to however many per page you want

        $informations = Information::all();

        return view('dispatch.list_dispatch', compact('trips', 'informations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch drivers that are NOT already on a dispatch (on_work, pending)
        $informations = Information::whereDoesntHave('trips', function ($query) {
            $query->whereIn('status', ['on_work', 'pending']);
        })->get();

        // Reservations without a trip, load the related vehicle (with pagination)
        $reservations = Reservation::with('vehicle')
            ->whereDoesntHave('trip')
            ->latest()
            ->paginate(10); // 👈 add pagination here

        // Get all vehicles tied to those reservations
        $vehicles = $reservations->pluck('vehicle')->filter();

        return view('dispatch.create_dispatch', compact('informations', 'reservations', 'vehicles'));
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
            'information_id' => 'required|exists:drivers,id',
            'trip_cost'      => 'required|numeric|min:0',
            'instruction'    => 'nullable|string|max:1000',
        ]);

        // ✅ Create a new Trip
        $trip = new Trip();
        $trip->reservation_id = $validated['reservation_id'];
        $trip->vehicle_id     = $validated['vehicle_id'];
        $trip->information_id = $validated['information_id'];
        $trip->trip_cost      = $validated['trip_cost'];
        $trip->status         = 'pending'; // initial status
        $trip->instruction    = $validated['instruction'] ?? null;

        $trip->save();

        return redirect()->back()->with('success', 'Trip assigned successfully!');
    }
    public function reject($reservationid)
    {
        $reservation = Reservation::findOrFail($reservationid);

        $trip = new Trip();
        $trip->reservation_id = $reservation->id;
        $trip->vehicle_id     = $reservation->vehicle_id;
        $trip->information_id  = $reservation->information_id;
        $trip->trip_cost      = 0;
        $trip->status         = 'rejected'; // set status to rejected
        $trip->instruction   = 'Trip request rejected';

        $trip->save();
        return redirect()->back()->with('error', 'Reservation request has been rejected!');
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
