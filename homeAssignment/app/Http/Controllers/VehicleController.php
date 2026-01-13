<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Manufacturer;
use App\Models\Weapon;
use App\Models\ArmamentConfig;
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

    public function armament($id)
    {
        $vehicle = Vehicle::with(['weapons', 'manufacturer'])->findOrFail($id);
        $availableWeapons = Weapon::all();
        return view('vehicles.armament', compact('vehicle', 'availableWeapons'));
    }

    public function armamentStore(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        $validated = $request->validate([
            'weapon_id' => 'required|exists:weapons,id',
            'location' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1'
        ]);

        $vehicle->weapons()->attach($validated['weapon_id'], [
            'location' => $validated['location'],
            'quantity' => $validated['quantity']
        ]);

        return redirect()->route('vehicles.armament', $id)->with('success', 'Weapon installed successfully!');
    }

    public function armamentDestroy($vehicleId, $configId)
    {
        $config = ArmamentConfig::where('id', $configId)
                                ->where('vehicle_id', $vehicleId)
                                ->firstOrFail();
        
        $config->delete();

        return redirect()->route('vehicles.armament', $vehicleId)->with('success', 'Weapon removed from vehicle.');
    }
}
