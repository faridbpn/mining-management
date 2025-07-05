<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Location;
use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'vehicle', 'driver', 'location', 'approvals'])->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $locations = Location::all();
        return view('bookings.create', compact('vehicles', 'drivers', 'locations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'location_id' => 'required|exists:locations,id',
            'purpose' => 'required',
            'destination' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';
        $booking = Booking::create($data);
        // Buat approval level 1 dan 2 (dummy, bisa dikembangkan)
        Approval::create([
            'booking_id' => $booking->id,
            'approver_id' => 2, // Approver 1 (dummy)
            'level' => 1,
            'status' => 'pending',
        ]);
        Approval::create([
            'booking_id' => $booking->id,
            'approver_id' => 3, // Approver 2 (dummy)
            'level' => 2,
            'status' => 'pending',
        ]);
        return redirect()->route('bookings.index')->with('success', 'Pemesanan berhasil diajukan.');
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'vehicle', 'driver', 'location', 'approvals']);
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();
        $locations = Location::all();
        return view('bookings.edit', compact('booking', 'vehicles', 'drivers', 'locations'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'location_id' => 'required|exists:locations,id',
            'purpose' => 'required',
            'destination' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'fuel_used' => 'nullable|numeric',
            'distance' => 'nullable|integer',
            'status' => 'required',
        ]);
        $booking->update($data);
        return redirect()->route('bookings.index')->with('success', 'Pemesanan berhasil diupdate.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Pemesanan berhasil dihapus.');
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->with(['vehicle', 'driver', 'location', 'approvals'])->get();
        return view('bookings.my_bookings', compact('bookings'));
    }
} 