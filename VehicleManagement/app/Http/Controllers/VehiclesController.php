<?php

namespace App\Http\Controllers;

use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicles::orderBy('created_at', 'desc')->paginate(10); // Fetch all vehicles ordered by creation date
        return view('vehicles.fvm', compact('vehicles')); // Pass the vehicles to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    // Use Validator manually instead of $request->validate()
    $validator = Validator::make($request->all(), [
        'license'  => 'required|unique:vehicles,license',
        'model'    => 'required|string|max:255',
        'make'     => 'required|string|max:255',
        'type'     => 'required|in:sedan,suv,truck,van,motorcycle',
        'color'    => 'required|string|max:255',
        'odemeter' => 'required|numeric',
        'vin'      => 'required|unique:vehicles,vin',
        'note'     => 'nullable|string',
        'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    // 🔴 If validation fails → redirect back with modal session flag
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('modal', 'add');  // 👈 THIS is the key you need
    }

    // ✅ Validation passed → save vehicle
    $vehicle = new Vehicles();
    $vehicle->license   = $request->license;
    $vehicle->model     = $request->model;
    $vehicle->make      = $request->make;
    $vehicle->type      = $request->type;
    $vehicle->color     = $request->color;
    $vehicle->odemeter  = $request->odemeter;
    $vehicle->vin       = $request->vin;
    $vehicle->note      = $request->note;

    // Handle image
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;

        if (file_exists(public_path('uploads/vehicles/' . $imageName))) {
            return back()->withErrors(['image' => 'This image already exists.'])
                         ->withInput()
                         ->with('modal', 'add'); // 👈 keep modal open if image error
        }

        $image->move(public_path('uploads/vehicles'), $imageName);
        $vehicle->image = 'vehicles/' . $imageName;
    }

    $vehicle->save();

    return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(vehicles $vehicles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vehicles $vehicles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

public function update(Request $request, $id)
{
    $vehicle = Vehicles::findOrFail($id);

    // Use Validator instead of $request->validate()
    $validator = Validator::make($request->all(), [
        'license'  => 'required|unique:vehicles,license,' . $vehicle->id,
        'model'    => 'required|string|max:255',
        'make'     => 'required|string|max:255',
        'type'     => 'required|string|max:255',
        'color'    => 'required|string|max:255',
        'odemeter' => 'required|numeric',
        'vin'      => 'required|unique:vehicles,vin,' . $vehicle->id,
        'note'     => 'nullable|string',
        'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    // 🔴 If validation fails → reopen the Edit modal
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('modal', 'edit')  // 👈 set modal type
            ->with('id', $vehicle->id); // 👈 pass which edit modal to reopen
    }

    // ✅ Update fields
    $vehicle->license  = $request->license;
    $vehicle->model    = $request->model;
    $vehicle->make     = $request->make;
    $vehicle->type     = $request->type;
    $vehicle->color    = $request->color;
    $vehicle->odemeter = $request->odemeter;
    $vehicle->vin      = $request->vin;
    $vehicle->note     = $request->note;

    // ✅ Handle image
    if ($request->hasFile('image')) {
        // delete old image if exists
        if ($vehicle->image && file_exists(public_path('uploads/' . $vehicle->image))) {
            File::delete(public_path('uploads/' . $vehicle->image));
        }

        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;

        // If file already exists → show error in edit modal
        if (file_exists(public_path('uploads/vehicles/' . $imageName))) {
            return back()->withErrors(['image' => 'This image already exists.'])
                         ->withInput()
                         ->with('modal', 'edit')
                         ->with('id', $vehicle->id);
        }

        $image->move(public_path('uploads/vehicles'), $imageName);
        $vehicle->image = 'vehicles/' . $imageName;
    }

    $vehicle->save();

    return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicle = Vehicles::findOrFail($id); // Find the vehicle by ID

        // Check if the vehicle has an image and delete it
        if ($vehicle->image && file_exists(public_path('uploads/' . $vehicle->image))) {
            File::delete(public_path('uploads/' . $vehicle->image));
        }

        $vehicle->delete(); // Delete the vehicle record from the database

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
       
    }
   
}
