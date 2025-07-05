<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Location;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('location')->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('vehicles.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'ownership' => 'required',
            'plate_number' => 'required',
            'location_id' => 'required|exists:locations,id',
            'fuel_capacity' => 'nullable|integer',
            'service_interval_km' => 'nullable|integer',
        ]);
        Vehicle::create($data);
        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        $locations = Location::all();
        return view('vehicles.edit', compact('vehicle', 'locations'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'ownership' => 'required',
            'plate_number' => 'required',
            'location_id' => 'required|exists:locations,id',
            'fuel_capacity' => 'nullable|integer',
            'service_interval_km' => 'nullable|integer',
        ]);
        $vehicle->update($data);
        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil diupdate.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
} 