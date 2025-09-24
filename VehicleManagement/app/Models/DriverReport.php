<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DriverReport extends Model
{
    protected $table = 'driver_reports'; 
    protected $fillable = [
        'title',
        'description',
        'fuel',
        'dispatch_cost',
        'status_report',
        'driver_id'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

}
