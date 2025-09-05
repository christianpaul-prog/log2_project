<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicles extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'license',
        'model',
        'make',
        'owner',
        'type',
        'color',
        'odemeter',
        'plate_no',
        'note',
        'image'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    /**
     * Get the maintenance records associated with the vehicle.
     */
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'vehicle_id');
    }
    public function trips()
    {
        return $this->hasMany(Trip::class, 'vehicle_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'vehicle_id');
    }
}
