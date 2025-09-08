<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicles;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicles::whereDoesntHave('maintenances', function ($query) {
            $query->where('status', 'on_progress');
        })
            ->whereDoesntHave('trips', function ($query) {
                $query->where('status', 'on_work');
            })
            ->get();
        // Fetch all reservations with latest first
        $reservations = Reservation::with('vehicle')->latest()->get();

        return view('reservation.list_reservation', compact('reservations', 'vehicles'));
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
    ->whereDoesntHave('reservations') // 🚀 exclude vehicles with reservations
    ->get();

        return view('reservation.create-reservation', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'name'            => ['required', 'regex:/^[A-Za-z]+(?: [A-Za-z]+)*$/', 'max:255'],
            'vehicle_id'      => 'required|exists:vehicles,id',
            'phone'           => 'required|digits_between:10,15',
            'company'         => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'dispatch_date'   => 'required|date|after_or_equal:today',
            'dispatch_time'   => 'required|date_format:H:i',
            'priority_level'  => 'required|in:low,medium,high',
            'pickup'          => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'drop'            => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'details'         => 'required|string|max:500',
            'purpose'         => 'required|string|max:500',
        ]);

        // ✅ Create reservation in one line
        Reservation::create($validated);

        // ✅ Redirect back with success message
        return redirect()->route('reservation.index')
            ->with('success', 'Reservation created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $validated = $request->validate([
            'name'     => ['required', 'regex:/^[A-Za-z]+(?: [A-Za-z]+)*$/', 'max:255'],
            'vehicle_id'      => 'required|exists:vehicles,id',
            'phone'           => 'required|digits_between:10,15',
            'company'  => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'dispatch_date'   => 'required|date|after_or_equal:today',
            'dispatch_time' => 'required',
            'priority_level'  => 'required|in:low,medium,high',
            'pickup'          => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'drop'            => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'details'         => 'required|string|max:500',
            'purpose'         => 'required|string|max:500',
        ]);
        $validated['dispatch_time'] = date('H:i', strtotime($request->dispatch_time));
        $reservation->update($validated);

        return redirect()->route('reservation.index')
            ->with('success', 'Reservation updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reservation.index')
            ->with('success', 'Reservation deleted successfully!');
    }
}
