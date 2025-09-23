<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Models\Notification; 

class TripsApiController extends Controller
{
public function index(Request $request)
{
    $query = Trip::with(['vehicle', 'driver', 'reservation'])
                 ->whereNotIn('status', ['rejected'])
                 ->latest();

    // ✅ If profile_id is passed in query string, filter trips by that
    if ($request->has('profile_id')) {
        $query->whereHas('reservation', function ($q) use ($request) {
            $q->where('profile_id', $request->profile_id);
        });
    }

    // ✅ Get all trips (no pagination)
    $trips = $query->get();

    return response()->json($trips);
}

    /**
     * POST /api/trips
     * Create a new trip.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'vehicle_id'     => 'required|exists:vehicles,id',
            'driver_id'      => 'required|exists:drivers,id',
            'trip_cost'      => 'required|numeric|min:0',
            'instruction'    => 'nullable|string|max:1000',
        ]);

        $trip = Trip::create([
            'reservation_id' => $validated['reservation_id'],
            'vehicle_id'     => $validated['vehicle_id'],
            'driver_id'      => $validated['driver_id'],
            'trip_cost'      => $validated['trip_cost'],
            'instruction'    => $validated['instruction'] ?? null,
            'status'         => 'pending',
        ]);
  Notification::create([
        'type'    => 'Trip',
        'message' => "New trip created with cost ₱" . number_format($trip->trip_cost, 2),
    ]);

    return response()->json([
        'message' => 'Trip created successfully',
        'data'    => $trip->load(['vehicle', 'driver', 'reservation']),
    ], 201);
    
        return response()->json([
            'message' => 'Trip created successfully',
            'data'    => $trip->load(['vehicle', 'driver', 'reservation']),
        ], 201);
    }

    /**
     * GET /api/trips/{id}
     * Show a single trip with relationships.
     */
    public function show($id)
    {
        $trip = Trip::with(['vehicle', 'driver', 'reservation'])->findOrFail($id);

        return response()->json($trip);
    }

    /**
     * PUT /api/trips/{id}
     * Update a trip.
     */
    public function update(Request $request, $id)
    {
         $trip = Trip::findOrFail($id);

    $validated = $request->validate([
        'trip_cost'   => 'nullable|numeric|min:0',
        'instruction' => 'nullable|string|max:1000',
        'status'      => 'required|in:pending,on_work,completed',
    ]);

    $trip->update($validated);

    // 🔔 Gumawa ng Trip status update notification
    Notification::create([
        'type'    => 'Trip',
        'message' => "Trip #{$trip->id} updated to status: " . ucfirst($trip->status),
    ]);

    return response()->json([
        'message' => 'Trip updated successfully',
        'data'    => $trip->load(['vehicle', 'driver', 'reservation']),
    ]);
    }

    /**
     * DELETE /api/trips/{id}
     * Delete a trip.
     */
    public function destroy($id)
    {
        // $trip = Trip::findOrFail($id);
        // $trip->delete();

        // return response()->json(['message' => 'Trip deleted successfully']);
    }
}
