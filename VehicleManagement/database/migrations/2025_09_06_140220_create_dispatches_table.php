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
    Schema::create('dispatches', function (Blueprint $table) {
    $table->id();
    $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');

    // Fix here: match drivers.id (int(11))
    $table->integer('driver_id');
    $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
    $table->enum('country', ['PH', 'US', 'CA','UK','AU','JP','CN','IN','DE','FR']);
    $table->string('region');
    $table->string('city');
    $table->string('brgy');
    // $table->string('location');
    $table->date('dispatch_date');
    $table->time('dispatch_time');
    $table->string('cargo_details')->nullable();
    $table->enum('status', ['on_work', 'completed', 'cancelled'])->default('on_work');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
