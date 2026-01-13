<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WeaponController extends Controller
{
    public function index(Request $request)
    {
        $query = Weapon::with('manufacturer');

        if ($request->filled('search')) {
            $query->where('weapon_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('weapon_type', $request->type);
        }

        if ($request->filled('manufacturer')) {
            $query->where('manufacturer_id', $request->manufacturer);
        }

        $sortField = $request->get('sort', 'weapon_name');
        $sortDirection = $request->get('direction', 'asc');
        
        if (in_array($sortField, ['weapon_name', 'weapon_type', 'caliber', 'created_at'])) {
            $query->orderBy($sortField, $sortDirection);
        }

        $weapons = $query->get();
        $manufacturers = Manufacturer::all();
        
        return view('weapons.index', compact('weapons', 'manufacturers'));
    }

    public function create()
    {
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
            'weapon_name' => 'required|string|max:255|unique:weapons,weapon_name,'.$id,
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