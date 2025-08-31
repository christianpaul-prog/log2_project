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
        'type',
        'color',
        'odemeter',
        'vin',
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
    public function dispatches()
    {
        return $this->hasMany(Dispatch::class, 'vehicle_id');
    }
}
