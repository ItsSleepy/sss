<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('manufacturer')->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function show($id)
    {
        $vehicle = Vehicle::with(['manufacturer', 'weapons'])->findOrFail($id);
        return view('vehicles.show', compact('vehicle'));
    }

    public function create()
    {
        $manufacturers = Manufacturer::all();
        return view('vehicles.create', compact('manufacturers'));
    }

    // 4. STORE NEW VEHICLE (Handle the Form Submission)
    public function store(Request $request)
    {
        // A. Validation Rules (Server-Side Protection)
        $validated = $request->validate([
            'model_name'      => 'required|string|max:255|unique:vehicles,model_name',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'vehicle_type'    => 'required|in:MBT,IFV,APC,Artillery',
            'unit_cost'       => 'required|numeric|min:0',
        ]);

        // B. Generate the URL Slug automatically
        $validated['slug'] = Str::slug($validated['model_name']);

        // C. Save to Database
        Vehicle::create($validated);

        // D. Redirect back with a Success Message
        return redirect()->route('vehicles.index')->with('success', 'Vehicle Commissioned Successfully!');
    }
}
