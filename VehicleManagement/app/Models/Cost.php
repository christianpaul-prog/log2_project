<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    // 
       use HasFactory;
       
       protected $fillable = [
        'trip_id',
        'liters',
        'price_per_liter',
        'total_cost',
        'date',
    ];
}
