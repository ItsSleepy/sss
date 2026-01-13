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

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $manufacturers = Manufacturer::all();
        
        return view('vehicles.edit', compact('vehicle', 'manufacturers'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $validated = $request->validate([
            'model_name'      => 'required|string|max:255|unique:vehicles,model_name,' . $id,
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'vehicle_type'    => 'required',
            'unit_cost'       => 'required|numeric|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['model_name']);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle Spec Sheet Updated!');
    }
    
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        
        return redirect()->route('vehicles.index')->with('success', 'Vehicle Decommissioned.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'model_name'      => 'required|string|max:255|unique:vehicles,model_name',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'vehicle_type'    => 'required|in:MBT,IFV,APC,Artillery',
            'unit_cost'       => 'required|numeric|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['model_name']);

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle Commissioned Successfully!');
    }
}
