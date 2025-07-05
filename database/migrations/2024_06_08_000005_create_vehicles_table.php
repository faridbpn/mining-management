<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // passenger, goods
            $table->string('ownership'); // owned, rented
            $table->string('plate_number');
            $table->foreignId('location_id')->constrained('locations');
            $table->integer('fuel_capacity')->nullable();
            $table->integer('service_interval_km')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
}; 