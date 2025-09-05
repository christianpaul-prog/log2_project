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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license')->unique();
            $table->string('model');
            $table->string('owner');
            $table->string('make');
            $table->enum('type', ['sedan', 'suv', 'truck', 'van','motorcycle']);  
            $table->string('color');
            $table->integer('odemeter')->default(0);
            $table->string('plate_no')->unique();
            $table->string('note')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
