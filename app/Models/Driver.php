<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'location_id',
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