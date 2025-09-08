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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // full name
            $table->string('phone');                 // phone number
            $table->string('company');               // company name
            $table->date('dispatch_date');           // schedule date
            $table->time('dispatch_time');           // schedule time
            $table->enum('priority_level', ['low','medium','high'])->default('low');
            $table->string('pickup');                // pickup location
            $table->string('drop');                  // drop-off location
            $table->text('details');                 // address details
            $table->text('purpose');                 // trip purpose
            $table->timestamps();

            // If you want to link to vehicles table
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
