<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\User;

class Approval extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'approver_id',
        'level',
        'status',
        'note',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
} 