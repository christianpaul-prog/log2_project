<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'vehicle_id',
        'start_date',
        'end_date',
        'service_details',
        'cost',
        'service_type',
        'notes',
        'status'
    ];


    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the vehicle that owns the maintenance record.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_id');
    }
    
}
