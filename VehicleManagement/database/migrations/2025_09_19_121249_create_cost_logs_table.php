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
       Schema::create('cost_logs', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('cost_id'); // reference sa costanalysis table
    $table->string('vehicle');
    $table->string('category'); // fuel, maintenance, trip
    $table->decimal('amount', 12, 2);
    $table->string('action'); // e.g. Closed, Updated, Deleted
    $table->timestamps();

    $table->foreign('cost_id')->references('id')->on('cost_analyses')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_logs');
    }
};
