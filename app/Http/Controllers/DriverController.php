<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Location;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('location')->get();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('drivers.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'location_id' => 'required|exists:locations,id',
        ]);
        Driver::create($data);
        return redirect()->route('admin.drivers.index')->with('success', 'Driver berhasil ditambahkan.');
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $locations = Location::all();
        return view('drivers.edit', compact('driver', 'locations'));
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'location_id' => 'required|exists:locations,id',
        ]);
        $driver->update($data);
        return redirect()->route('admin.drivers.index')->with('success', 'Driver berhasil diupdate.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Driver berhasil dihapus.');
    }
} 