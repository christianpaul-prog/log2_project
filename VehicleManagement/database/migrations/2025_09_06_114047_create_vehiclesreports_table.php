<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehiclesreports', function (Blueprint $table) {
            $table->id();
             $table->string('plate_number')->unique(); // Plate No. (unique identifier)
        $table->string('brand')->nullable();      // e.g. Toyota, Isuzu
        $table->string('model')->nullable();      // e.g. HiAce, D-Max
        $table->integer('year')->nullable();         // Manufacture year
        $table->string('color')->nullable();      // Vehicle color
        $table->integer('mileage')->default(0); 
        $table->text('description')->nullable(); 
          // Current odometer reading
        $table->enum('status', ['Active','Inactive','Under Maintenance'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiclesreports');
    }
};
