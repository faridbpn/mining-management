<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function report(Request $request)
    {
        $query = Booking::with(['user', 'vehicle', 'driver', 'location']);
        if ($request->filled('start')) {
            $query->whereDate('start_time', '>=', $request->start);
        }
        if ($request->filled('end')) {
            $query->whereDate('end_time', '<=', $request->end);
        }
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }
        if ($request->filled('vehicle_type')) {
            $query->whereHas('vehicle', function($q) use ($request) {
                $q->where('type', $request->vehicle_type);
            });
        }
        $bookings = $query->get();
        $response = new StreamedResponse(function () use ($bookings) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'User', 'Vehicle', 'Driver', 'Location', 'Purpose', 'Destination', 'Start', 'End', 'Status']);
            foreach ($bookings as $b) {
                fputcsv($handle, [
                    $b->id,
                    $b->user->name ?? '',
                    $b->vehicle->name ?? '',
                    $b->driver->name ?? '',
                    $b->location->name ?? '',
                    $b->purpose,
                    $b->destination,
                    $b->start_time,
                    $b->end_time,
                    $b->status,
                ]);
            }
            fclose($handle);
        });
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="laporan_pemesanan.csv"');
        return $response;
    }
} 