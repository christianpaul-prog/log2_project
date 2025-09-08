<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'instruction',
        'trip_cost',
        'status',
        'reservation_id',
        'vehicle_id',
        'driver_id',
    ];
    /**
     * Relationship: Trip belongs to a Reservation
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * Relationship: Trip belongs to a Vehicle
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class);
    }

    /**
     * Relationship: Trip belongs to a Driver
     */
    public function driver()
{
    return $this->belongsTo(Drivers::class, 'driver_id');
}
}
