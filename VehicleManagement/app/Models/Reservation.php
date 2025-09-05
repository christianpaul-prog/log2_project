<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'company',
        'vehicle_id',
        'dispatch_date',
        'dispatch_time',
        'priority_level',
        'pickup',
        'drop',
        'details',
        'purpose',
    ];

     public function vehicle()
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_id');
    }
    public function trip()
{
    return $this->hasOne(Trip::class);
}

}
