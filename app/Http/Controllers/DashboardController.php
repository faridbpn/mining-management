<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $totalVehicles = Vehicle::count();
        $totalDrivers = Driver::count();
        $totalFuel = Booking::sum('fuel_used');
        $totalService = Vehicle::count(); // Dummy, bisa diganti dengan tabel service
        $bookingsPerMonth = Booking::selectRaw('MONTH(start_time) as month, COUNT(*) as total')
            ->groupBy('month')->pluck('total', 'month');
        return view('dashboard.index', compact('totalBookings', 'totalVehicles', 'totalDrivers', 'totalFuel', 'totalService', 'bookingsPerMonth'));
    }

    public function admin()
    {
        $totalVehicles = \App\Models\Vehicle::count();
        $totalBookingsToday = \App\Models\Booking::whereDate('start_time', now()->toDateString())->count();
        $bookingsPerMonth = \App\Models\Booking::selectRaw('MONTH(start_time) as month, COUNT(*) as total')
            ->groupBy('month')->pluck('total', 'month');
        return view('dashboard.admin', compact('totalVehicles', 'totalBookingsToday', 'bookingsPerMonth'));
    }

    public function approver()
    {
        $pendingApprovals = \App\Models\Approval::where('approver_id', Auth::id())->where('status', 'pending')->count();
        $latestBookings = \App\Models\Approval::where('approver_id', Auth::id())->latest()->take(5)->with('booking')->get();
        return view('dashboard.approver', compact('pendingApprovals', 'latestBookings'));
    }

    public function employee()
    {
        $myBookings = \App\Models\Booking::where('user_id', Auth::id())->with(['vehicle', 'driver', 'location'])->latest()->take(10)->get();
        $totalBookings = \App\Models\Booking::where('user_id', Auth::id())->count();
        $approvedBookings = \App\Models\Booking::where('user_id', Auth::id())->where('status', 'approved')->count();
        return view('dashboard.employee', compact('myBookings', 'totalBookings', 'approvedBookings'));
    }
} 