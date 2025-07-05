<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckRoleMiddleware;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->isApprover()) {
            return redirect()->route('approver.dashboard');
        } else {
            return redirect()->route('employee.dashboard');
        }
    }
    return view('auth.login');
})->name('home');

Route::get('login', function() { 
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->isApprover()) {
            return redirect()->route('approver.dashboard');
        } else {
            return redirect()->route('employee.dashboard');
        }
    }
    return view('auth.login'); 
})->name('login');

Route::post('login', function() {
    $credentials = request(['email', 'password']);
    if (Auth::attempt($credentials)) {
        request()->session()->regenerate();
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->isApprover()) {
            return redirect()->route('approver.dashboard');
        } else {
            return redirect()->route('employee.dashboard');
        }
    }
    return back()->withErrors(['email' => 'Email atau password salah']);
});

Route::post('logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// GANTI MENGGUNAKAN CLASS MIDDLEWARE LANGSUNG
Route::middleware(['auth', CheckRoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('bookings', BookingController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('drivers', DriverController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
});

Route::middleware(['auth', CheckRoleMiddleware::class . ':approver'])->prefix('approver')->name('approver.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'approver'])->name('dashboard');
    Route::get('approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::get('approvals/{approval}', [ApprovalController::class, 'show'])->name('approvals.show');
    Route::put('approvals/{approval}', [ApprovalController::class, 'update'])->name('approvals.update');
    Route::get('history', [ApprovalController::class, 'history'])->name('history');
});

Route::middleware(['auth', CheckRoleMiddleware::class . ':employee'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'employee'])->name('dashboard');
    Route::get('bookings', [BookingController::class, 'myBookings'])->name('bookings.index');
    Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});
