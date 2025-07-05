<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('driver_id')->constrained('drivers');
            $table->foreignId('location_id')->constrained('locations');
            $table->string('purpose');
            $table->string('destination');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->float('fuel_used')->nullable();
            $table->integer('distance')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected, completed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
}; 