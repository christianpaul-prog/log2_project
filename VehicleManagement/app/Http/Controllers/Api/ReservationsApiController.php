<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Vehicles;
use Illuminate\Http\Request;

class ReservationsApiController extends Controller
{
    /**
     * GET /api/reservations
     * Show all reservations (paginated).
     */
    public function index()
    {
        $reservations = Reservation::with('vehicle')->latest()->paginate(10);
        return response()->json($reservations);
    }

    /**
     * POST /api/reservations
     * Create a new reservation.
     */
    public function store(Request $request)
    {
        // ✅ Validate request
        $validated = $request->validate([
            'name'           => ['required', 'regex:/^[A-Za-z]+(?: [A-Za-z]+)*$/', 'max:255'],
            'vehicle_id'     => 'required|exists:vehicles,id',
            'phone'          => 'required|digits_between:10,15',
            'company'        => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'dispatch_date'  => 'required|date|after_or_equal:today',
            'dispatch_time'  => 'required|date_format:H:i',
            'priority_level' => 'required|in:low,medium,high',
            'pickup'         => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'drop'           => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'details'        => 'required|string|max:500',
            'purpose'        => 'required|string|max:500',
        ]);

        $reservation = Reservation::create($validated);

        return response()->json([
            'message' => 'Reservation created successfully',
            'data'    => $reservation
        ], 201);
    }

    /**
     * GET /api/reservations/{id}
     * Show a single reservation.
     */
    public function show($id)
    {
        $reservation = Reservation::with('vehicle')->findOrFail($id);
        return response()->json($reservation);
    }

    /**
     * PUT /api/reservations/{id}
     * Update an existing reservation.
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->trip && in_array($reservation->trip->status, [
            'on_work',
            'completed',
            'cancelled',
            'rejected'
        ])) {
            return response()->json([
                'message' => 'This reservation cannot be updated anymore.'
            ], 403); // Forbidden
        }
        // else validate and update
        $validated = $request->validate([
            'name'           => ['required', 'regex:/^[A-Za-z]+(?: [A-Za-z]+)*$/', 'max:255'],
            'vehicle_id'     => 'required|exists:vehicles,id',
            'phone'          => 'required|digits_between:10,15',
            'company'        => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'dispatch_date'  => 'required|date|after_or_equal:today',
            'dispatch_time'  => 'required|date_format:H:i',
            'priority_level' => 'required|in:low,medium,high',
            'pickup'         => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'drop'           => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'details'        => 'required|string|max:500',
            'purpose'        => 'required|string|max:500',
        ]);

        $reservation->update($validated);

        return response()->json([
            'message' => 'Reservation updated successfully',
            'data'    => $reservation
        ]);
    }

    /**
     * DELETE /api/reservations/{id}
     * Delete a reservation.
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted successfully']);
    }
}
