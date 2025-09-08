<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiclesreport extends Model
{
    //
     protected $table = 'vehiclesreports';
      protected $fillable = [
        'plate_number',
        'brand',
        'model',
        'year',
        'color',
        'mileage',
        'description',
        'status',
    ];

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
