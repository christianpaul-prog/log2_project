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
        Schema::create('_cost', function (Blueprint $table) {
               $table->id();
    $table->foreignId('trip_id')->constrained()->onDelete('cascade');
    $table->decimal('liters', 8, 2);
    $table->decimal('price_per_liter', 8, 2);
    $table->decimal('total_cost', 10, 2);
    $table->date('date');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_cost');
    }
};
