<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $table = 'shifts';
    protected $fillable = [
        'shift_date',
        'start_time',
        'end_time',
        'details',
        'dispatch_cost',    
        'driver_id',
        'trip_id',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }
}
