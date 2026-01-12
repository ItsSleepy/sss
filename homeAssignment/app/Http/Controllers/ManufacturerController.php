<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('manufacturers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_of_origin' => 'required|string',
            'website_url' => 'nullable|url',
            'is_prime_contractor' => 'boolean'
        ]);

        $validated['is_prime_contractor'] = $request->has('is_prime_contractor');

        Manufacturer::create($validated);

        return redirect()->route('vehicles.index')->with('success', 'Manufacturer Partner Added!');
    }

    public function show($id)
    {
        $manufacturer = Manufacturer::with(['vehicles', 'weapons'])->findOrFail($id);
        return view('manufacturers.show', compact('manufacturer'));
    }

    public function edit($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        return view('manufacturers.edit', compact('manufacturer'));
    }

    public function update(Request $request, $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'country_of_origin' => 'required|string',
            'website_url' => 'nullable|url',
        ]);
        
        $validated['is_prime_contractor'] = $request->has('is_prime_contractor');

        $manufacturer->update($validated);

        return redirect()->route('manufacturers.index')->with('success', 'Manufacturer updated.');
    }

    public function destroy($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->delete();
        return redirect()->route('manufacturers.index')->with('success', 'Manufacturer deleted.');
    }
}