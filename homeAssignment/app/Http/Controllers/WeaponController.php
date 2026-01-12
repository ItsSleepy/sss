<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WeaponController extends Controller
{
    public function index()
    {
        $weapons = Weapon::with('manufacturer')->get();
        return view('weapons.index', compact('weapons'));
    }

    public function create()
    {
        // We need manufacturers to populate the dropdown
        $manufacturers = Manufacturer::all();
        return view('weapons.create', compact('manufacturers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'weapon_name'     => 'required|string|max:255|unique:weapons,weapon_name',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'weapon_type'     => 'required|string',
            'caliber'         => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['weapon_name']);

        Weapon::create($validated);

        return redirect()->route('weapons.index')->with('success', 'Weapon System Added to Armory.');
    }

    public function show($id)
    {
        // Load the weapon AND the vehicles that use it
        $weapon = Weapon::with(['manufacturer', 'vehicles'])->findOrFail($id);
        return view('weapons.show', compact('weapon'));
    }

    public function edit($id)
    {
        $weapon = Weapon::findOrFail($id);
        $manufacturers = Manufacturer::all();
        return view('weapons.edit', compact('weapon', 'manufacturers'));
    }

    public function update(Request $request, $id)
    {
        $weapon = Weapon::findOrFail($id);
        
        $validated = $request->validate([
            'weapon_name' => 'required|string|max:255|unique:weapons,weapon_name,'.$id, // Ignore current ID
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'weapon_type' => 'required',
            'caliber' => 'required',
        ]);
        
        $validated['slug'] = Str::slug($validated['weapon_name']);
        
        $weapon->update($validated);
        return redirect()->route('weapons.index')->with('success', 'Weapon updated.');
    }

    public function destroy($id)
    {
        Weapon::destroy($id);
        return redirect()->route('weapons.index')->with('success', 'Weapon decommissioned.');
    }
}