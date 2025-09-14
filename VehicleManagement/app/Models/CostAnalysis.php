<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostAnalysis extends Model
{

    //
     use HasFactory;

    protected $fillable = [
        'date',
        'vehicle',
        'fuel_cost',
        'maintenance_cost',
        'trip_expenses',
        'total_cost',
        'status',
    ];

    // Auto-calculate total_cost when saving
    protected static function booted() {
        static::saving(function ($model) {
            $model->total_cost = $model->fuel_cost + $model->maintenance_cost + $model->trip_expenses;
        });
    }
}
