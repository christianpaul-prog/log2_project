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
        Schema::create('trips', function (Blueprint $table) {
             $table->engine = 'InnoDB'; // ensures foreign keys work
    $table->id();
    $table->string('instruction')->nullable();
    $table->decimal('trip_cost', 8, 2)->nullable();
    $table->enum('status', ['on_work', 'completed', 'pending','cancelled','rejected'])->default('pending');
    
    $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
    $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
    
    $table->unsignedBigInteger('information_id')->nullable()->index();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};