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
        Schema::create('cost_analyses', function (Blueprint $table) {
            $table->id();
                 $table->date('date');
            $table->string('vehicle'); // plate number or ID reference
            $table->decimal('fuel_cost', 10, 2)->default(0);
            $table->decimal('maintenance_cost', 10, 2)->default(0);
            $table->decimal('trip_expenses', 10, 2)->default(0);
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->enum('status', ['Pending', 'Closed', 'Maintenance'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_analyses');
    }
    
};
