<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetLog extends Model
{
    //
     protected $fillable = [
        'forecast_id', 'category', 'amount', 'month',
        'reason', 'status', 'action'
    ];
}
