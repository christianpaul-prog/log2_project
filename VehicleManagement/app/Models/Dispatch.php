<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        // 'location',
        'country',
        'region',
        'city',
        'brgy',
        'dispatch_date',
        'dispatch_time',
        // 'priority_level',
        'cargo_details'
    ];

    /**
     * Get the vehicle associated with the dispatch.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_id');
    }
    /**
     * Get the driver associated with the dispatch.
     */
    public function driver()
    {
        return $this->belongsTo(Drivers::class, 'driver_id');
    }
}
