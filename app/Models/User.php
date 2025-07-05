<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helper methods untuk backward compatibility
    public function isAdmin()
    {
        return $this->hasRole('admin') || $this->role === 'admin';
    }

    public function isApprover()
    {
        return $this->hasRole('approver') || $this->role === 'approver';
    }

    public function isEmployee()
    {
        return $this->hasRole('employee') || $this->role === 'employee';
    }
}
