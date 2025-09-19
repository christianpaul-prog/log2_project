<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VehiclesApiController extends Controller
{
    /**
     * GET /api/vehicles
     * Show a paginated list of vehicles.
     */
    public function index()
    {
        $vehicles = Vehicles::latest()->paginate(10);
        return response()->json($vehicles);
    }

    /**
     * POST /api/vehicles
     * Store a new vehicle record.
     */
    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'license'  => 'required|unique:vehicles,license',
            'model'    => 'required|string|max:255',
            'owner'    => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'make'     => 'required|string|max:255',
            'type'     => 'required|in:sedan,suv,truck,van,motorcycle',
            'color'    => 'required|string|max:255',
            'odemeter' => 'required|numeric',
            'plate_no' => 'required|unique:vehicles,plate_no',
            'note'     => 'nullable|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ✅ Create vehicle
        $vehicle = new Vehicles($request->except('image'));

        // ✅ Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/vehicles'), $imageName);
            $vehicle->image = 'vehicles/' . $imageName;
        }

        $vehicle->save();

        return response()->json([
            'message' => 'Vehicle created successfully',
            'data'    => $vehicle
        ], 201);
    }

    /**
     * GET /api/vehicles/{id}
     * Show details of one vehicle.
     */
    public function show($id)
    {
        $vehicle = Vehicles::findOrFail($id);
        return response()->json($vehicle);
    }

    /**
     * PUT /api/vehicles/{id}
     * Update an existing vehicle.
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicles::findOrFail($id);

        // ✅ Validation (ignore current vehicle for unique fields)
        $request->validate([
            'license'  => 'required|unique:vehicles,license,' . $vehicle->id,
            'model'    => 'required|string|max:255',
            'owner'    => ['required', 'regex:/^(?!.*\s{2,})[A-Za-z0-9 ]+$/', 'max:255'],
            'make'     => 'required|string|max:255',
            'type'     => 'required|in:sedan,suv,truck,van,motorcycle',
            'color'    => 'required|string|max:255',
            'odemeter' => 'required|numeric',
            'plate_no' => 'required|unique:vehicles,plate_no,' . $vehicle->id,
            'note'     => 'nullable|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ✅ Update fields
        $vehicle->fill($request->except('image'));

        // ✅ Replace image if new one uploaded
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($vehicle->image && file_exists(public_path('uploads/' . $vehicle->image))) {
                File::delete(public_path('uploads/' . $vehicle->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/vehicles'), $imageName);
            $vehicle->image = 'vehicles/' . $imageName;
        }

        $vehicle->save();

        return response()->json([
            'message' => 'Vehicle updated successfully',
            'data'    => $vehicle
        ]);
    }

    /**
     * DELETE /api/vehicles/{id}
     * Delete a vehicle.
     */
    public function destroy($id)
    {
        $vehicle = Vehicles::findOrFail($id);

        // ✅ Delete old image if exists
        if ($vehicle->image && file_exists(public_path('uploads/' . $vehicle->image))) {
            File::delete(public_path('uploads/' . $vehicle->image));
        }

        $vehicle->delete();

        return response()->json(['message' => 'Vehicle deleted successfully']);
    }
}
