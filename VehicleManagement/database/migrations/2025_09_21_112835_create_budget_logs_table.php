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
        Schema::create('budget_logs', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('forecast_id')->nullable();
            $table->string('category');
            $table->decimal('amount', 12, 2);
            $table->string('month');
            $table->string('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('action'); // e.g. deleted, updated
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('budget_logs');
    }
};
