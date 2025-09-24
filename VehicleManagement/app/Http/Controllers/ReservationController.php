<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Vehicles not in maintenance or trip
        $vehicles = Vehicles::where(function($query) {
        $query->whereHas('maintenances', fn($q) => $q->where('status', 'completed'));
    })
    ->whereDoesntHave('trips', fn($q) => $q->whereIn('status', ['on_work', 'pending']))
    ->get();

        // Fetch reservations with latest first, paginated
        $reservations = Reservation::with('vehicle','trip')
            ->latest()
            ->paginate(10); // 👈 show 10 per page

        return view('reservation.list_reservation', compact('reservations', 'vehicles'));
    }


    /**
     * Show the form for creating a new resource.
     */
// public function create()
// {
//     $vehicles = Vehicles::where(function($query) {
//         $query->whereHas('maintenances', fn($q) => $q->where('status', 'completed'));
//     })
//     ->whereDoesntHave('trips', fn($q) => $q->whereIn('status', ['on_work', 'pending']))
//     ->get();

//     return view('reservation.create-reservation', compact('vehicles'));
// }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validate input
         $validator = Validator::make($request->all(), [
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

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('modal', 'add'); // 👈 tells frontend to reopen Add modal
    }

    Reservation::create($validator->validated());

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
