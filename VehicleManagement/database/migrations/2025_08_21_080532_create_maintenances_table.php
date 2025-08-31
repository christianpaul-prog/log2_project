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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade'); // Foreign key to vehicles table
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('service_details')->nullable();
            $table->enum('service_type', [
                'oil_change',
                'tire_rotation',
                'brake_service',
                'battery_replacement',
                'engine_service',
                'inspection'
            ]);
            $table->decimal('cost', 8, 2)->nullable(); // Cost of the maintenance service
            $table->string('notes')->nullable(); // Additional notes about the maintenance
            $table->string('status')->default('in_progress');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
