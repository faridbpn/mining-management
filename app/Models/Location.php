<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
use App\Models\Driver;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
} 