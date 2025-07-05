<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'ownership',
        'plate_number',
        'location_id',
        'fuel_capacity',
        'service_interval_km',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
} 