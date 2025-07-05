<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Approval;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'driver_id',
        'location_id',
        'purpose',
        'destination',
        'start_time',
        'end_time',
        'fuel_used',
        'distance',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }
} 